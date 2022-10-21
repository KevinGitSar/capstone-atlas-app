<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create(){
        return view('/register');
    }

    // Creates new User
    public function store(Request $request){
        $formFields = $request->validate([
            'first_name' => ['required', 'min:2'],
            'last_name' => ['required', 'min:2'],
            'birthdate' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'username' =>['required', Rule::unique('users', 'username')],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $formFields['birthdate'] = Carbon::parse($formFields['birthdate'])->format('Y-m-d');

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        //Login
        // auth()->login($user);

        return redirect('/login');
    }

    // Update User
    public function update(Request $request, $userid){
        $formFields = $request->validate([
            'first_name' => ['required', 'min:2'],
            'last_name' => ['required', 'min:2'],
            'birthdate' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userid)],
            'username' =>['required', Rule::unique('users', 'username')->ignore($userid)],
        ]);

        $formFields['birthdate'] = Carbon::parse($formFields['birthdate'])->format('Y-m-d');

        User::where('id', $userid)->update($formFields);

        return redirect('/settings')->with('message', 'New Changes Saved Successfully!');
    }

    //update password
    public function updatePassword(Request $request, $userid){
        $formFields = $request->validate([
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        
        User::where('id', $userid)->update($formFields);

        return redirect('/settings')->with('message', 'New Password Saved Successfully!');
    }

    public function login(){
        return view('/login');
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'username' =>['required'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Login Successful!');
        }

        return back()->withErrors(['username' => 'Invalid Credentials'])->onlyInput('username');
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function postpage(){
        if(auth()->check()){
            return view('/postpage');
        } else{
            //Later add "Oops you're not logged in page"
            return view('/login');
        }
    }

    public function settings(){
        return view('/settings');
    }
    
    public function password(){
        return view('/password');
    }
}