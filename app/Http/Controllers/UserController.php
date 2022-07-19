<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;


class UserController extends Controller
{
    // show the registration form
    public function showRegistrationForm(){
        return view('user_pages/register', [
            'pageTitle' => 'Register With YSO'
        ]);
    }

    // register a new user 
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
        // return $user->id;
        // auto log in if successfully created
        // auth()->login($user);
        // return redirect('/login')->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have registered and are now logged in.');
        return redirect(route('login.showVerifyForm',$user->id))->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have successfully registered, kindly verify to continue.');
    }

    // show the log in form
    public function showLoginForm(){
        return view('user_pages/login', [
            'pageTitle' => 'Log In'
        ]);
    }

    // show the verify form
    public function showVerifyForm($id){
        $user = User::find($id);
        // return $user;
        return view('user_pages/verify',compact('user'), ['pageTitle' => 'Verify User']);
    }

    // verifies user
    public function verifyForm(Request $request,$id){
        $user = User::find($id);
        $email = str_contains($request->verify_by ,'@');
        if($email){
            if($user->email_code !==null && $user->email_code == $request->verification_code){
                $user->email_verified = 1;
                $user->save();
                return redirect('/login')->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have successfully verified your email.');
            }else{
                return redirect()->back()->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', Incorrect Verification Code.');
            }
        }
        $phone = str_contains($request->verify_by ,'-');
        if($phone){
            if($user->phone_code !==null && $user->phone_code == $request->verification_code){
                $user->phone_verified = 1;
                $user->save();
                return redirect('/login')->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have successfully verified your phone #.');
            }else{
                return redirect()->back()->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', Incorrect Verification Code.');
            }
        }
        return redirect()->back()->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', Incorrect Verification Code.');
    
    }

    // show the forgot password form
    public function showForgotForm(){
        return view('user_pages/forgot', ['pageTitle' => 'Forgot Password']);
    }

    // send reset password code
    public function forgotForm(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user!=null && $user->email_code == $request->verification_code){
            $user_id = $user->id;
            return view('user_pages/password',compact('user_id'));
        }else{
            return redirect()->back()->with('flash-message-user','Hello ' . ucfirst($user->firstName) . ' Verification Code Not matched.');
        }
    }

    // update new password
    public function savePasswrod(Request $request){
        $user = User::find($request->user_id);
        if($request->password != null){
            if($request->password == $request->password_confirmation){
                // $user = User::find($request->user_id);
                $user->password = bcrypt($request->password);
                $user->update();
                return redirect('/login')->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have successfully reset your password.');
            }else{
                return redirect()->back()->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', passwords do not match. Type carefully!.');
            }
        }else{
            return redirect()->back()->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', kindly type a new password.');    
        }
        return $request;
    }

    // send verification code to either email or phone
    public function sendCode(Request $request){
        $code = rand(100000,999999);
        $user = User::find($request->userid);
        $email = str_contains($request->id ,'@');
        if($email){
            $user->email_code = $code;
            $user->save();
            $data = array(
                'subject' => 'Email Verifiction Code',
                'code' => $code
            );
            // $mail = 'shahzadanouman@hotmail.com';
            Mail::to($request->id)->send(new VerifyMail($data));
            return response()->json([
                'success' =>'Verification Code Emailed '.$request->id,
            ]);
        }
        $phone = str_contains($request->id ,'-');
        if($phone){
            $user->phone_code = $code;
            $user->save();
            $recipient = '+1'.str_replace('-','',$request->id);
            // return $recipient;
            // $recipient = '+18135012075';
            $message_to_send = "Your Phone Verification Code is : ".$code;
            $this->sendSms($recipient,$message_to_send);
            return response()->json([
                'success' =>'Verification Code Texted '.$recipient,
            ]);
        } 
    }

    // send forgot password code
    public function sendResetCode(Request $request){
        $code = rand(100000,999999);
        // $user = User::find($request->userid);
        // $email = str_contains($request->id ,'@');
            $user = User::where('email',$request->email)->first();
            // if($user==null)
            // {
            //     $t = 'true';
            // }
            // return response()->json([
            //     'success' =>'Verification Code Sended on '.$user->count(),
            // ]);
            if($user!=null){
                $user->email_code = $code;
                $user->update();
                $data = array(
                    'subject' => 'Reset Password Code',
                    'code' => $code
                );
                // $request->id
                // $mail = 'shahzadanouman@hotmail.com';
                Mail::to($request->email)->send(new VerifyMail($data));
                return response()->json([
                    'success' =>'Verification Code Emailed To '.$request->email,
                ]);
            }else{
                return response()->json([
                    'error' =>'Email'.$request->value.' Not Found.',
                ]);
            }
        // $phone = str_contains($request->id ,'-');
        // if($phone)
        // {
        //     $user->phone_code = $code;
        //     $user->save();
        //     $recipient = '+1'.str_replace('-','',$request->id);
        //     // return $recipient;
        //     // $recipient = '+18135012075';
        //     $message_to_send = "Your Phone Verification Code is : ".$code;
        //     $this->sendSms($recipient,$message_to_send);

        //     return response()->json([
        //         'success' =>'Verification Code Texted on '.$recipient,
        //     ]);
        // }
    }

    // SEND TO TEXT
    public function sendSms($recipient,$message_to_send)
    {
        //text ams starts here
        $service_plan_id = env('SERVICE_PLAN_ID');
        $bearer_token = env('BEARER_TOCKEN');

        //Any phone number assigned to your API
        $send_from = env('SEND_FROM');
        //May be several, separate with a comma ,
        // +18135012075 
        $recipient_phone_numbers = $recipient;
        // $message = "Click on the link bellow to Find You Coupon Details  {$recipient_phone_numbers} from {$send_from}";
        $message = $message_to_send;
        
        // Check recipient_phone_numbers for multiple numbers and make it an array.
        if(stristr($recipient_phone_numbers, ',')){
        $recipient_phone_numbers = explode(',', $recipient_phone_numbers);
        }else{
        $recipient_phone_numbers = [$recipient_phone_numbers];
        }

        // Set necessary fields to be JSON encoded
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
        
        // if(curl_errno($ch)) {
        //     echo 'Curl error: ' . curl_error($ch);
        // } else {
        //     echo $result;
        // }
        curl_close($ch);
    }

    // log user in
    public function loginUser(Request $request, User $user)
    {
        $formInputs = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $check = User::where('email',$request->email)->first();
        if($check)
        {
            if($check->email_verified ==1 || $check->phone_verified==1)
            {
                // attempt is the log in method for Laravel
                if(auth()->attempt($formInputs)){
                    // generates a session token
                    $request->session()->regenerate();
                    // redirects home with a message
                    return redirect('/')->with('flash-message-user', 'Greetings ' . ucfirst(auth()->user()->firstName) . ', you are now logged in.');
                }
            }
            else
            {
                return redirect(route('login.showVerifyForm',$check->id))->with('flash-message-user', 'Hello ' . ucfirst($check->firstName) . ', kindly verify your email or phone # to log in.');
            }
        }
        // if log in fails stay on same page and show one error
        // don't specify if the email is correct or not for security reasons
        // email states where to put the solo message
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    // log user in
    // public function loginUser(Request $request, User $user){
    //     $formInputs = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required']
    //     ]);
    //     // attempt is the log in method for Laravel
    //     if(auth()->attempt($formInputs)){
    //         // generates a session token
    //         $request->session()->regenerate();
    //         // redirects home with a message
    //         return redirect('/')->with('flash-message-user', 'Greetings ' . ucfirst(auth()->user()->firstName) . ', you are now logged in.');
    //     }else{
    //         return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    //     }
    // }

    // log user out
    public function logoutUser(Request $request){
        // removes authentication from the users session
        auth()->logout();
        // recomended to invalidate the users session
        // and regen their @csrf token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('flash-message-user', 'You have now logged out.');
    }

}
