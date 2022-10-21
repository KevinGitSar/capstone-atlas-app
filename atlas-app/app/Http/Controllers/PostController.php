<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Symfony\Component\String\ByteString;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $username = Auth::username();
        $post = Post::all()->where('username', auth()->user()->username);
        return view('userpage', compact('post'));
    }

    public function getAll()
    {
        // $username = Auth::username();
        $post = Post::all();
        return view('app', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // $imagePost = $request->file('image');
        // $extension = $imagePost->getClientOriginalExtension();
        // Storage::disk('images')->put($imagePost->getFilename().'.'. $extension, File::get($imagePost));

        $post->username = $formFields['username'];
        $post->image = $formFields['image'];
        $post->location = $formFields['location'];
        $post->description = $formFields['description'];
        $post->tags = $formFields['tags'];
        $post->dateCreated = Carbon::now();

        $post->save();
        
        return redirect('/userpage');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
