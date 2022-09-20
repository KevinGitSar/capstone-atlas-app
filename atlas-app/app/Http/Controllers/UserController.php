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

        $formFields['birthdate'] = Carbon::createFromFormat('Y-m-d', $formFields['birthdate']);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        //Login
        // auth()->login($user);

        return redirect('/');
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
}
