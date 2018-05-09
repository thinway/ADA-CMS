<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store($id)
    {
        if( ! Auth::user()){
            $this->validate(request(), [
                'name' => 'required|min:5',
                'email' => 'required|email',
                'message' => 'required|min:2'
            ]);
            $name = \request('name');
            $email = \request('email');
        }else{
            $this->validate(request(), [
                'message' => 'required|min:2'
            ]);
            $name = Auth::user()->name;
            $email = Auth::user()->email;
        }

        $post = Post::findOrFail($id);

        $post->addComment(request('message'), $name, $email);

        return back();
    }
}
