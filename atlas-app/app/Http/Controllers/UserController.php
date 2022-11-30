<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return redirect('/home');
    }

    /**
     * Display the register form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('/register');
    }

    /**
     * Display searched users.
     *
     * @return \Illuminate\Http\Response
     */
    public function userSearch(){
        $users = User::latest()->filter(request(['profile']))->get();
        return view('userslist', compact('users'));
    }

    /**
     * Creates and stores a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $formFields = $request->validate([
            'first_name' => ['required', 'min:2'],
            'last_name' => ['required', 'min:2'],
            'birthdate' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'username' =>['required', Rule::unique('users', 'username')],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $formFields['role'] = 'user';
        
        $formFields['suspended'] = false;
        $formFields['birthdate'] = Carbon::parse($formFields['birthdate'])->format('Y-m-d');

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        return redirect('/login');
    }

    /**
     * Updates a user.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Updates a users password.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $userid){
        $formFields = $request->validate([
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        
        User::where('id', $userid)->update($formFields);

        return redirect('/settings')->with('message', 'New Password Saved Successfully!');
    }

    /**
     * Display the login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        return view('/login');
    }

    /**
     * Authenticate the user.
     *
     * @return \Illuminate\Http\Request
     */
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'username' =>['required'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formFields)){
            if(auth()->user()->role == "admin"){
                $request->session()->regenerate();

                return redirect('/admin');
            }else{
                
                $request->session()->regenerate();

                return redirect('/home');
                
            }
        }

        return back()->withErrors(['username' => 'Invalid Credentials'])->onlyInput('username');
    }

    /**
     * Logs out the user.
     *
     * @return \Illuminate\Http\Request
     */
    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Display the post page to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function postpage($username){
        if(auth()->check()){
            return view('/postpage')->with('username', $username);
        } else{
            
            return redirect('/login')->with('message', 'Log in before viewing the post page!');
        }
    }

    /**
     * Display the settings page to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings(){
        return view('/settings');
    }
    
    /**
     * Display the password change page.
     *
     * @return \Illuminate\Http\Response
     */
    public function password(){
        return view('/password');
    }

    /**
     * Suspend/Ban a user.
     * Softdeleting a user.
     * 
     */
    public function suspend($name){
        User::where('username', $name)->delete();
        Comment::where('userUsername', $name)->delete();
        Post::where('username', $name)->delete();
    }

    /**
     * Restore a user who is suspended/banned.
     *
     */
    public function unsuspend($name){
        User::onlyTrashed()->where('username', $name)->restore();
        Comment::onlyTrashed()->where('userUsername', $name)->restore();
        Post::onlyTrashed()->where('username', $name)->restore();
    }
}