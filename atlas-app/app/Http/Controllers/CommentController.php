<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'userUsername' => ['required'],
            'post' => ['required'],
            'comment' => ['required']
        ]);

        $comment = new Comment();
        $comment->userUsername = $formFields['userUsername'];
        $comment->post = $formFields['post'];
        $comment->comment = $formFields['comment'];

        $comment->save();

        return $comment;
    }

    public function show($post)
    {
        $newPost = "posts/" . $post;
        $data = Comment::where('post', $newPost)->get();
        
        return $data;
    }

    public function delete($id)
    {
        $comment = comment::find($id);
        
        $comment->delete();

        return redirect()->back();
    }
}
