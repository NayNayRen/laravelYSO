<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\VerifyMail;
use App\Mail\PasswordMail;
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
    public function showRegistrationForm()
    {
        return view('user_pages/register', ['pageTitle' => 'Register With YSO']);
    }

    // REGISTER A NEW USER
    public function registerUser(Request $request)
    {
        $formInputs = $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['required'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);
        // capitalize first and last name
        $formInputs['firstName'] = ucfirst($formInputs['firstName']);
        $formInputs['lastName'] = ucfirst($formInputs['lastName']);
        // hash password
        $formInputs['password'] = bcrypt($formInputs['password']);
        // create new user
        $user = User::create($formInputs);
        return redirect(route('login.showVerifyForm', $user->id))->with(
            'flash-message-user',
            '<h3>- Hello ' . ucfirst($user->firstName) . ' -</h3>
            <p>You have successfully registered. Verify your account once to continue.</p>'
        );
    }

    // SHOW THE LOG IN FORM
    public function showLoginForm()
    {
        return view('user_pages/login', ['pageTitle' => 'Log In']);
    }

    // LOG A USER IN
    public function loginUser(Request $request, User $user)
    {
        $formInputs = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $check = User::where('email', $request->email)->first();
        if ($check) {
            if ($check->email_verified == 1 || $check->phone_verified == 1) {
                // attempt is the log in method for Laravel
                if (auth()->attempt($formInputs)) {
                    // generates a session token
                    $request->session()->regenerate();
                    return redirect('/')->with(
                        'flash-message-user',
                        '<h3>- Welcome ' . ucfirst(auth()->user()->firstName) . ' -</h3>
                        <p>You are now logged in.</p>'
                    );
                }
            } else {
                return redirect(route('login.showVerifyForm', $check->id))->with(
                    'flash-message-user',
                    '<h3>- Hello ' . ucfirst($check->firstName) . ' -</h3>
                    <p>Please verify with your Email or Phone to log in.</p>'
                );
            }
        }
        // don't specify if the email is correct or not for security reasons
        // email states where to put the solo message
        return back()->withErrors(['email' => 'Incorrect Credentials'])->onlyInput('email');
    }

    // SHOW THE VERIFY FORM
    public function showVerifyForm($id)
    {
        $user = User::find($id);
        return view('user_pages/verify', compact('user'), ['pageTitle' => 'Verify User']);
    }

    // SEND VERIFICATION CODE TO EMAIL OR PHONE, SENT BY OTP BUTTON
    public function sendVerifyCode(Request $request)
    {
        $code = rand(100000, 999999);
        $user = User::find($request->userid);
        // sent to email
        $email = str_contains($request->id, '@');
        if ($email) {
            $user->email_code = $code;
            $user->save();
            $data = array(
                'subject' => 'Your YSO Email Verifiction Code',
                'code' => $code
            );
            Mail::to($request->id)->send(new VerifyMail($data));
            return response()->json([
                'success' => 'Verification Code Emailed To : ' . $request->id,
            ]);
        }
        // sent to phone
        $phone = str_contains($request->id, '-');
        if ($phone) {
            $user->phone_code = $code;
            $user->save();
            $recipient = '+1' . str_replace('-', '', $request->id);
            $message_to_send = "Your YSO Phone Verification Code Is :\n" . $code;
            $this->sendSms($recipient, $message_to_send);
            return response()->json([
                'success' => 'Verification Code Texted To : ' . $request->id,
            ]);
        }
        if ($email == null || $phone == null) {
            return response()->json([
                'error' => 'No Method Was Selected.',
            ]);
        }
    }

    // VERIFY USER VIA EMAIL OR PHONE, CLICKING THE VERIFY USER BUTTON
    public function verifyUser(Request $request, $id)
    {
        $user = User::find($id);
        // verify by email
        $email = str_contains($request->verify_by, '@');
        if ($email) {
            if ($user->email_code != null && $user->email_code == $request->verification_code) {
                $user->email_verified = 1;
                $user->save();
                return redirect(route('login.showLoginForm'))->with(
                    'verification-message',
                    '<h3>- Hello ' . ucfirst($user->firstName) . ' -</h3>
                    <p>You were successfully verified by email. Please read the disclaimer below to continue.</p>'
                );
            } else {
                return back()->withErrors(['verification_code' => 'Incorrect Verification Code.']);
            }
        }
        // verify by phone
        $phone = str_contains($request->verify_by, '-');
        if ($phone) {
            if ($user->phone_code != null && $user->phone_code == $request->verification_code) {
                $user->phone_verified = 1;
                $user->save();
                return redirect(route('login.showLoginForm'))->with(
                    'verification-message',
                    '<h3>- Hello ' . ucfirst($user->firstName) . ' -</h3>
                    <p>You were successfully verified by phone. Please read the disclaimer below to continue.</p>'
                );
            } else {
                return back()->withErrors(['verification_code' => 'Incorrect Verification Code.']);
            }
        }
        return back()->withErrors([
            'verify_by' => 'No Method Was Selected.',
            'verification_code' => 'Verification Code Was Left Empty.'
        ]);
    }

    // SHOW THE FOGOT PASSWORD FORM
    public function showForgotForm()
    {
        return view('user_pages/forgot', ['pageTitle' => 'Forgot Password']);
    }

    // SEND PASSWORD RESET CODE VIA EMAIL
    public function sendResetCode(Request $request)
    {
        $code = rand(100000, 999999);
        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            $user->email_code = $code;
            $user->update();
            $data = array(
                'subject' => 'Your YSO Password Change Code',
                'code' => $code
            );
            // Mail::to($request->email)->send(new VerifyMail($data));
            Mail::to($request->email)->send(new PasswordMail($data));
            return response()->json([
                'success' => 'Password Code Emailed To ' . $request->email,
            ]);
        } else {
            return response()->json([
                'error' => 'Email ' . $request->email . ' Not Found.',
            ]);
        }
    }

    // CHECK OTP CODE AND REDIRECT TO CHANGE PASSWORD
    public function showResetForm(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user != null && $user->email_code == $request->verification_code) {
            $user_id = $user->id;
            return view('user_pages/password', compact('user_id'), ['pageTitle' => 'Change Password']);
        }
        if ($request->email == null) {
            return back()->withErrors(['email' => 'Email Not Provided.']);
        } else {
            return back()->withErrors(['verification_code' => 'Incorrect Verification Code.']);
        }
    }

    // UPDATE NEW PASSWORD
    public function savePassword(Request $request)
    {
        $user = User::find($request->user_id);
        if ($request->password != null && $request->password_confirmation != null) {
            if (strlen($request->password) > 7) {
                if ($request->password == $request->password_confirmation) {
                    $user->password = bcrypt($request->password);
                    $user->update();
                    return redirect(route('login.showLoginForm'))->with(
                        'flash-message-user',
                        '<h3>- Hello ' . ucfirst($user->firstName) . ' -</h3>
                        <p>You have successfully reset your password.</p>'
                    );
                } else {
                    return back()->withErrors([
                        'password' => 'Passwords Do Not Match.',
                        'password_confirmation' => 'Passwords Do Not Match.'
                    ]);
                }
            } else {
                return back()->withErrors(['password' => 'Must Be At Least 8 Characters Long.']);
            }
        } else {
            return back()->withErrors([
                'password' => 'Input Was Left Empty.',
                'password_confirmation' => 'Input Was Left Empty.'
            ]);
        }
        return $request;
    }

    // CONNECTION TO SEND OTP VIA PHONE
    public function sendSms($recipient, $message_to_send)
    {
        //text ams starts here
        // Set necessary fields to be JSON encoded
        $content = [
            'from' => '19512637122',
            'to' => [$recipient],
            'body' => $message_to_send
        ];

        $data = json_encode($content);
        $ch = curl_init("https://sms.api.sinch.com/xms/v1/a6c7726640314b1eb8dcf92fed42ccd7/batches");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // Set HTTP Header for POST request 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer a13611040543430ca425709b7ed64048',
            'Content-Length: ' . strlen($data)
        ));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    // SHOW UPDATE FORM
    public function showUpdateForm()
    {
        return view('user_pages/update', ['pageTitle' => 'Update']);
    }

    // UPDATE USER DETAILS
    public function updateUser(Request $request, User $user)
    {
        // if password and confirmation are left empty, password stays current
        if ($request->password === null && $request->password_confirmation === null) {
            $formInputs = $request->validate([
                'firstName' => ['required'],
                'lastName' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required']
            ]);
        }
        // if password is not empty, confirmation must match, password is updated
        if ($request->password != null || $request->password_confirmation != null) {
            $formInputs = $request->validate([
                'firstName' => ['required'],
                'lastName' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required'],
                'password' => ['required', 'confirmed', 'min:8']
            ]);
            // hash password
            $formInputs['password'] = bcrypt($formInputs['password']);
        }
        // capitalize first and last name
        $formInputs['firstName'] = ucfirst($formInputs['firstName']);
        $formInputs['lastName'] = ucfirst($formInputs['lastName']);
        // update user
        $user->update($formInputs);
        return redirect(route('deals.index'))->with(
            'flash-message-user',
            '<h3>- Hello ' . ucfirst($user->firstName) . ' -</h3>
            <p>You have successfully updated your information.</p>'
        );
    }

    // DELETE USER
    public function deleteUser(Request $request, User $user)
    {
        $deletionEmail = $request->deletion_email;
        if ($deletionEmail === auth()->user()->email) {
            // delete user after correct email supplied
            $user->delete();
            return redirect(route('deals.index'))->with(
                'flash-message-user',
                '<h3>- User -</h3>
                <p>Was deleted successfully.</p>'
            );
        } else {
            return back()->withErrors(['deletion_email' => 'Incorrect Email Provided']);
        }
    }

    // LOG USER OUT
    public function logoutUser(Request $request)
    {
        // removes authentication from the users session
        auth()->logout();
        // recomended to invalidate the users session
        $request->session()->invalidate();
        // and regen their @csrf token
        $request->session()->regenerateToken();
        return redirect('/')->with(
            'flash-message-user',
            '<h3>- Goodbye -</h3>
            <p>You have now logged out.</p>'
        );
    }

    // SOCIAL MEDIA LOG INS
    // redirects go to medias auth page
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function appleRedirect()
    {
        return Socialite::driver('apple')->scopes(["email"])->redirect();
        // return Socialite::driver('apple')->redirect();
    }

    // callbacks come back from the auth page with user data
    public function facebookCallback()
    {
        try {
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
                'phone' => '123-456-7890',
                'password' => Hash::make(Str::random(20))
            ]);
            Auth::login($user);
            if (($user->phone_verified || $user->email_verified)) {
                return redirect(route('deals.index'))->with(
                    'update-password-message',
                    '<h3>- Hello ' . ucfirst(auth()->user()->firstName) . ' -</h3>
                    <p>You have used Facebook to log in.</p>'
                )->with('mediaName', 'facebook');
            } else {
                return redirect(route('login.showVerifyForm', ['id' => $user->id]))->with(
                    'flash-message-user',
                    '<p>Please verify your account once to continue.</p>'
                );
            }
        } catch (Exception $e) {
            return redirect(route('login.showLoginForm'))->with(
                'flash-message-user',
                '<p>An error has occurred, try signing again.</p>'
            );
        }
    }

    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            // dd($googleUser);
            $firstName = $googleUser->user['given_name'];
            $lastName = $googleUser->user['family_name'];
            $user = User::firstOrCreate([
                'email' => $googleUser->email
            ], [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'phone' => '123-456-7890',
                'password' => Hash::make(Str::random(20))
            ]);
            Auth::login($user);
            if (($user->phone_verified || $user->email_verified)) {
                return redirect(route('deals.index'))->with(
                    'update-password-message',
                    '<h3>- Hello ' . ucfirst(auth()->user()->firstName) . ' -</h3>
                    <p>You have used Google to log in.</p>'
                )->with('mediaName', 'google');
            } else {
                return redirect(route('login.showVerifyForm', ['id' => $user->id]))->with(
                    'flash-message-user',
                    '<p>Please verify your account once to continue.</p>'
                );
            }
        } catch (Exception $e) {
            return redirect(route('login.showLoginForm'))->with(
                'flash-message-user',
                '<p>An error has occurred, try signing again.</p>'
            );
        }
    }

    public function appleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->user();
            dd($appleUser);
            // $token = $appleUser->token;
            // $appleUserWithToken = Socialite::with('apple')->userFromToken($token);
            // dd($appleUserWithToken);
            if ($appleUser->name === null) {
                $previousUser = User::where('email', $appleUser->user['email'])->first();
                $firstName = $previousUser->firstName;
                $lastName = $previousUser->lastName;
            } else {
                $firstName = $appleUser->user['name']['firstName'];
                $lastName = $appleUser->user['name']['lastName'];
            }
            $user = User::firstOrCreate([
                'email' => $appleUser->user['email']
            ], [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'phone' => '123-456-7890',
                'password' => Hash::make(Str::random(20))
            ]);
            Auth::login($user);
            if (($user->phone_verified || $user->email_verified)) {
                return redirect(route('deals.index'))->with(
                    'update-password-message',
                    '<h3>- Hello ' . ucfirst(auth()->user()->firstName) . ' -</h3>
                    <p>You have used Apple to log in.</p>'
                )->with('mediaName', 'apple');
            } else {
                return redirect(route('login.showVerifyForm', ['id' => $user->id]))->with(
                    'flash-message-user',
                    '<p>Please verify your account once to continue.</p>'
                );
            }
        } catch (Exception $e) {
            return redirect(route('login.showLoginForm'))->with(
                'flash-message-user',
                '<p>An error has occurred, try signing again.</p>'
            );
        }
    }

    // public function appleRedirect() {
    // 	return Socialite::driver('apple')->stateless()->scopes(["name", "email"])->redirect();
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
