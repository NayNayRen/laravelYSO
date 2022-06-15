<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show the registration form
    public function showRegistrationForm(){
        return view('user_pages/register');
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
        // auto log in if successfully created
        // auth()->login($user);
        return redirect('/login')->with('flash-message-user', 'Hello ' . ucfirst($user->firstName) . ', you have successfully registered.');
    }

    // show the log in form
    public function showLoginForm(){
        return view('user_pages/login');
    }

    // log user in
    public function loginUser(Request $request, User $user){
        $formInputs = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        // attempt is the log in method for Laravel
        if(auth()->attempt($formInputs)){
            // generates a session token
            $request->session()->regenerate();
            // redirects home with a message
            return redirect('/')->with('flash-message-user', 'Greetings ' . ucfirst(auth()->user()->firstName) . ', you are now logged in.');
        }
        // if log in fails stay on same page and show one error
        // don't specify if the email is correct or not for security reasons
        // email states where to put the solo message
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

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
