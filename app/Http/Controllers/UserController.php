<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\VerifyMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\SocialLoginProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;


class UserController extends Controller
{
    // SHOW THE REGISTRATION FORM
    public function showRegistrationForm(){
        return view('user_pages/register', ['pageTitle' => 'Register With YSO']);
    }

    // REGISTER A NEW USER
    public function registerUser(Request $request){
        $formInputs = $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['required'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);
        // hash password
        $formInputs['password'] = bcrypt($formInputs['password']);
        // create new user
        $user = User::create($formInputs);
        return redirect(route('login.showVerifyForm', $user->id))->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have successfully registered. Choose a verification method to continue.');
    }

    // SHOW THE LOG IN FORM
    public function showLoginForm(){
        return view('user_pages/login', ['pageTitle' => 'Log In']);
    }

    // LOG A USER IN
    public function loginUser(Request $request, User $user){
        $formInputs = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $check = User::where('email', $request->email)->first();
        if($check){
            if($check->email_verified == 1 || $check->phone_verified== 1){
                // attempt is the log in method for Laravel
                if(auth()->attempt($formInputs)){
                    // generates a session token
                    $request->session()->regenerate();
                    return redirect('/')->with('flash-message-user', 'Greetings ' . ucfirst(auth()->user()->firstName) . ', you are now logged in.');
                }
            }else{
                return redirect(route('login.showVerifyForm', $check->id))->with('flash-message-user', 'Hello ' . ucfirst($check->firstName) . ', please verify with your Email or Phone to log in.');
            }
        }
        // don't specify if the email is correct or not for security reasons
        // email states where to put the solo message
        return back()->withErrors(['email' => 'Incorrect Credentials'])->onlyInput('email');
    }

    // SHOW THE VERIFY FORM
    public function showVerifyForm($id){
        $user = User::find($id);
        return view('user_pages/verify', compact('user'), ['pageTitle' => 'Verify User']);
    }

    // SEND VERIFICATION CODE TO EMAIL OR PHONE, SENT BY OTP BUTTON
    public function sendVerifyCode(Request $request){
        $code = rand(100000,999999);
        $user = User::find($request->userid);
        // sent to email
        $email = str_contains($request->id ,'@');
        if($email){
            $user->email_code = $code;
            $user->save();
            $data = array(
                'subject' => 'Email Verifiction Code',
                'code' => $code
            );
            Mail::to($request->id)->send(new VerifyMail($data));
            return response()->json([
                'success' => 'Verification Code Emailed To '.$request->id,
            ]);
        }
        // sent to phone
        $phone = str_contains($request->id ,'-');
        if($phone){
            $user->phone_code = $code;
            $user->save();
            $recipient = '+1'.str_replace('-','',$request->id);
            $message_to_send = "Your Phone Verification Code Is : ".$code;
            $this->sendSms($recipient,$message_to_send);
            return response()->json([
                'success' => 'Verification Code Texted To '.$recipient,
            ]);
        }
        if($email == null || $phone == null){
            return response()->json([
                'error' => 'No Method Was Selected.',
            ]);
        }
    }

    // VERIFY USER VIA EMAIL OR PHONE, CLICKING THE VERIFY USER BUTTON
    public function verifyUser(Request $request,$id){
        $user = User::find($id);
        // verify by email
        $email = str_contains($request->verify_by ,'@');
        if($email){
            if($user->email_code != null && $user->email_code == $request->verification_code){
                $user->email_verified = 1;
                $user->save();
                return redirect(route('login.showLoginForm'))->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have successfully verified your email. Log in to continue.');
            }else{
                return back()->withErrors(['verification_code' => 'Incorrect Verification Code.']);
            }
        }
        // verify by phone
        $phone = str_contains($request->verify_by ,'-');
        if($phone){
            if($user->phone_code != null && $user->phone_code == $request->verification_code){
                $user->phone_verified = 1;
                $user->save();
                return redirect(route('login.showLoginForm'))->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have successfully verified your phone. Log in to continue.');
            }else{
                return back()->withErrors(['verification_code' => 'Incorrect Verification Code.']);
            }
        }
        return back()->withErrors([
            'verify_by' => 'No Method Was Selected.',
            'verification_code' => 'Verification Code Was Left Empty.'
        ]);
    }

    // SHOW THE FOGOT PASSWORD FORM
    public function showForgotForm(){
        return view('user_pages/forgot', ['pageTitle' => 'Forgot Password']);
    }

    // SEND PASSWORD RESET CODE VIA EMAIL
    public function sendResetCode(Request $request){
        $code = rand(100000,999999);
        $user = User::where('email',$request->email)->first();
        if($user != null){
            $user->email_code = $code;
            $user->update();
            $data = array(
                'subject' => 'Reset Password Code',
                'code' => $code
            );
            Mail::to($request->email)->send(new VerifyMail($data));
            return response()->json([
                'success' => 'Verification Code Emailed To '.$request->email,
            ]);
        }else{
            return response()->json([
                'error' => 'Email ' .$request->email.' Not Found.',
            ]);
        }
    }

    // CHECK OTP CODE AND REDIRECT TO CHANGE PASSWORD
    public function showResetForm(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user != null && $user->email_code == $request->verification_code){
            $user_id = $user->id;
            return view('user_pages/password', compact('user_id'), ['pageTitle' => 'Change Password']);
        }if($request->email == null){
            return back()->withErrors(['email' => 'Email Not Provided.']);
        }else{
            return back()->withErrors(['verification_code' => 'Incorrect Verification Code.']);
        }
    }

    // UPDATE NEW PASSWORD
    public function savePassword(Request $request){
        $user = User::find($request->user_id);
        if($request->password != null && $request->password_confirmation != null){
            if(strlen($request->password) > 7){
                if($request->password == $request->password_confirmation){
                    $user->password = bcrypt($request->password);
                    $user->update();
                    return redirect(route('login.showLoginForm'))->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have successfully reset your password.');
                }else{
                    return back()->withErrors([
                        'password' => 'Passwords Do Not Match.',
                        'password_confirmation' => 'Passwords Do Not Match.'
                    ]);
                }
            }else{
                return back()->withErrors(['password' => 'Must Be At Least 8 Characters Long.']);
            }
        }else{
            return back()->withErrors([
                'password' => 'Input Was Left Empty.',
                'password_confirmation' => 'Input Was Left Empty.'
            ]);   
        }
        return $request;
    }

    // CONNECTION TO SEND OTP VIA PHONE
    public function sendSms($recipient,$message_to_send){
        // text sms starts here
        $service_plan_id = env('SERVICE_PLAN_ID');
        $bearer_token = env('BEARER_TOCKEN');
        // any phone number assigned to your API
        $send_from = env('SEND_FROM');
        // may be several, separate with a comma ,
        // +18135012075 
        $recipient_phone_numbers = $recipient;
        $message = $message_to_send;
        // check recipient_phone_numbers for multiple numbers and make it an array.
        if(stristr($recipient_phone_numbers, ',')){
        $recipient_phone_numbers = explode(',', $recipient_phone_numbers);
        }else{
        $recipient_phone_numbers = [$recipient_phone_numbers];
        }
        // set necessary fields to be JSON encoded
        $content = [
        'to' => array_values($recipient_phone_numbers),
        'from' => $send_from,
        'body' => $message
        ];
        $data = json_encode($content);
        $ch = curl_init("https://us.sms.api.sinch.com/xms/v1/{$service_plan_id}/batches");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
        curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $bearer_token);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    // log user out
    public function logoutUser(Request $request){
        // removes authentication from the users session
        auth()->logout();
        // recomended to invalidate the users session
        $request->session()->invalidate();
        // and regen their @csrf token
        $request->session()->regenerateToken();
        return redirect('/')->with('flash-message-user', 'You have now logged out.');
    }

    // SOCIAL MEDIA LOG INS
    public function facebookRedirect() {
		return Socialite::driver('facebook')->redirect();
	}
    
    public function googleRedirect() {
		return Socialite::driver('google')->redirect();
	}

    public function appleRedirect() {
		return Socialite::driver('apple')->redirect();
	}

    public function facebookCallback(){
        try{
            $facebookUser = Socialite::driver('facebook')->user();
            // dd($facebookUser);
            $names = explode(' ', $facebookUser->name);
            $firstName = $names[0];
            $lastName = $names[count($names) - 1];
            $user = User::firstOrCreate([
                'email' => $facebookUser->email
            ], [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'phone' => 'None Provided',
                'password' => Hash::make(Str::random(20))
            ]);
            Auth::login($user);
            if(($user->phone_verified || $user->email_verified)){
                return redirect(route('deals.index'))->with('update-password-message', 'Hello ' . ucfirst(auth()->user()->firstName) .', you have used Facebook to log in.');
              }else{
                  return redirect(route('login.showVerifyForm',['id' => $user->id]))->with('flash-message-user', 'Please verify your account once to continue.');
              }
        }catch(Exception $e){
            return redirect(route('login.showLoginForm'))->with('flash-message-user', 'An error has occurred, try signing again.');
        }
    }

    public function googleCallback(){
        try{
            $googleUser = Socialite::driver('google')->user();
            // dd($googleUser);
            $firstName = $googleUser->user['given_name'];
            $lastName = $googleUser->user['family_name'];
            $user = User::firstOrCreate([
                'email' => $googleUser->email
            ], [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'phone' => 'None Provided',
                'password' => Hash::make(Str::random(20))
            ]);
            Auth::login($user);
            if(($user->phone_verified || $user->email_verified)){
              return redirect(route('deals.index'))->with('update-password-message', 'Hello ' . ucfirst(auth()->user()->firstName) .', you have used Google to log in.');
            }else{
                return redirect(route('login.showVerifyForm',['id' => $user->id]))->with('flash-message-user', 'Please verify your account to continue.');
            }
        }catch(Exception $e){
            return redirect(route('login.showLoginForm'))->with('flash-message-user', 'An error has occurred, try signing again.');
        }
    }

	// public function appleRedirect() {
	// 	return Socialite::driver('apple')->stateless()->scopes(["name", "email"])->redirect();
	// }

    // public function facebookCallback() {
	// 	try {
	// 		$user = Socialite::driver('facebook')->user();
	// 		$check = User::where('email', $user->getEmail())->first();

	// 		$names = explode(' ', $user->getName());
	// 		$firstName = $names[0];
	// 		$lastName = $names[count($names) - 1];

	// 		$dbUser = User::where('email', $user->getEmail())->first();
	// 		$persistedUser = User::firstOrCreate(
	// 			['email' => $user->getEmail()],
	// 			['firstName' => $firstName,
    //             'lastName' => $lastName,
	// 			'email' => $user->getEmail(),
    //             'phone' => 'SSO_PHONE_NULL',
    //             'password' => 'SSO_PASSWORD_NULL',
	// 			]
	// 		);
	// 		$user_id = DB::table('users')->where('email', $user->getEmail())->first()->id;
	// 		// $social_login_provider = SocialLoginProvider::firstOrCreate(
	// 		// 	['provider_name' => 'facebook',
	// 		// 	'provider_id' => $user->getId()
	// 		// 	],
	// 		// 	['provider_name' => 'facebook',
	// 		// 	'provider_id' => $user->getId(),
	// 		// 	'user_id' => $user_id
	// 		// 	]
	// 		// );
    //         Log::info($user_id);
    //         Auth::loginUsingId($user_id);
    //         // if(!($dbUser->phone_verified || $dbUser->email_verified))
    //         //   return redirect(route('deals.index'));
    //         // else
    //         //   return redirect(route('login.showVerifyForm',['id' => $persistedUser->id]));
	// 		return redirect("/");
	// 	} catch(Exception $e) {
	// 		// dd($e->getMessage());
    //         return redirect("/");
	// 	}
	// }

    // public function googleCallback() {
	// 	try {
	// 		$user = Socialite::driver('google')->user();
    //         dd($user);
	// 		$check = User::where('email', $user->getEmail())->first();

	// 		$names = explode(' ', $user->getName());
	// 		$firstName = $user->user['given_name'];
	// 		$lastName = $user->user['family_name'];

	// 		$dbUser = User::where('email', $user->getEmail())->first();
    //         $persistedUser = User::firstOrCreate(
	// 			['email' => $user->getEmail()],
	// 			['firstName' => $firstName,
    //             'lastName' => $lastName,
	// 			'email' => $user->getEmail(),
    //             'phone' => 'SSO_PHONE_NULL',
    //             'password' => 'SSO_PASSWORD_NULL',
	// 			]
	// 		);
	// 		$user_id = DB::table('users')->where('email', $user->getEmail())->first()->id;
	// 		// $social_login_provider = SocialLoginProvider::firstOrCreate(
	// 		// 	['provider_name' => 'google',
	// 		// 		'provider_id' => $user->getId()
	// 		// 	],
	// 		// 	['provider_name' => 'google',
	// 		// 		'provider_id' => $user->getId(),
	// 		// 		'user_id' => $user_id
	// 		// 	]
	// 		// );
	// 		Log::info($user_id);
	// 		Auth::loginUsingId($user_id);
	//         // if(!($dbUser->phone_verified || $dbUser->email_verified))
	//         //   return redirect(route('deals.index'));
	//         // else
	//         //   return redirect(route('login.showVerifyForm',['id' => $persistedUser->id]));
	// 		return redirect("/");
	// 	} catch(Exception $e) {
	// 		// Log::error($e->getMessage());
	// 		return redirect("/");
	// 	}
	// }

    // public function appleCallback(AppleToken $appleToken) {
	// 	config()->set('services.apple.client_secret', $appleToken->generate());
	// 	$socialUser = Socialite::driver('apple')->stateless()->user();
	// 	$dbUser = User::where('email', $socialUser->getEmail())->first();
	// 	try {
    //         $persistedUser = User::firstOrCreate(
	// 			['email' => $socialUser->getEmail()],
	// 			['firstName' => 'SSO_NAME_NULL',
    //             'lastName' => 'SSO_NAME_NULL',
	// 			'email' => $socialUser->getEmail(),
    //             'phone' => 'SSO_PHONE_NULL',
    //             'password' => 'SSO_PASSWORD_NULL',
	// 			]
	// 		);
	// 		$user_id = DB::table('users')->where('email', $socialUser->getEmail())->first()->id;
	// 		// $social_login_provider = SocialLoginProvider::firstOrCreate(
	// 		// 	['provider_name' => 'apple',
	// 		// 	'provider_id' => $socialUser->getId()
	// 		// 	],
	// 		// 	['provider_name' => 'apple',
	// 		// 	'provider_id' => $socialUser->getId(),
	// 		// 	'user_id' => User::where('email', $socialUser->getEmail())->first()->id
	// 		// 	]
	// 		// );
	// 		Log::info($user_id);
	// 		Auth::loginUsingId($user_id);
	// 		return redirect("/");
	// 	} catch(Exception $e) {
	// 		dd($e->getMessage());
	// 	}
	// }

}
