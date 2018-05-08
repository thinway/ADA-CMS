<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store($id)
    {
        $this->validate(request(), [
            'body' => 'required|min:2'
        ]);
        $post = Post::findOrFail($id);

        $post->addComment(request('body'));

        return back();
    }
}
