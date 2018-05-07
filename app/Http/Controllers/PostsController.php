<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * List of posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Latest is only a query scope of 'orderBy':
        // $posts = Post::orderBy('created_at','asc')->paginate(10);
        // On the contrary you would use 'oldest'
        $posts = Post::orderBy('created_at','asc')->paginate(10);

        // Here we send the data through the PHP function 'compact'
        // See Documentation: http://php.net/manual/es/function.compact.php
        return view('posts.index', compact('posts'));
    }

    /**
     * Single post page.
     * Route binding
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Create a new post - Form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        Post::create([
            'title' => \request('title'),
            'slug' => str_slug(\request('title')),
            'excerpt' => \request('excerpt'),
            'content' => \request('content')
        ]);

        return redirect('/');
    }
}
