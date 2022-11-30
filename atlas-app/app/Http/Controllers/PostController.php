<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
        if(User::where('username', $username)->exists()){
            
            $post = Post::all()->where('username', $username);
            return view('/userpage', compact('post'))->with('username', $username);
        } else{
            //User not found
            return view('/errorpage');
        }
    }

    public function getAll()
    {   
        $post = Post::latest()->filter(request(['tag']))->get();
        return view('app', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'username' => ['required'],
            'image' => ['required'],
            'location' => ['required'],
            'description' => ['required'],
            'tags' =>['required']
        ]);

        $post = new Post();
        
        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->username = $formFields['username'];
        $post->image = $formFields['image'];
        $post->location = $formFields['location'];
        $post->description = $formFields['description'];
        $post->tags = $formFields['tags'];
        $post->dateCreated = Carbon::parse(Carbon::now())->format('Y-m-d');

        $post->save();
        
        return redirect('/profile/' . auth()->user()->username);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $path = str_replace("/", "\\", $post->image);
        if(File::exists(public_path('storage\\'.$path))){    //Delete might not work on server
            @unlink(public_path('storage\\'.$path));
            $post->delete();
        }

        return redirect('/profile/' . auth()->user()->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($username, $postid)
    {

        $post = Post::where('username', $username)->where('id', $postid)->first();
        
        $data = Comment::where('post', $post->image)->get();
        

        $previousPost = Post::where('username', $username)->where('id', '<', $post->max('id'))->first();
        if($previousPost === null){
            $previousPost = $post;
        }

        $nextPost = Post::where('username', $username)->where('id', '>', $post->min('id'))->first();
        if($nextPost === null){
            $nextPost = $post;
        }
        if($post){
            return view('/userpost', compact('post'))->with('previousPost', $previousPost)->with('nextPost', $nextPost)->with('username', $username)->with('comments', $data);
        }
    }
}
