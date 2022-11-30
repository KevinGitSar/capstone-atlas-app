<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Creates and stores comments in the database
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

    /**
     * Displays a comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $newPost = "posts/" . $post;
        $data = Comment::where('post', $newPost)->get();
        
        return $data;
    }

    /**
     * Deletes a comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $comment = comment::find($id);
        
        // Force delete or it will just softDelete
        $comment->forceDelete();

        return redirect()->back();
    }
}
