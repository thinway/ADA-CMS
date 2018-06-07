<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    /**
     * List of posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->paginate(10);

        // Here we send the data through the PHP function 'compact'
        // See Documentation: http://php.net/manual/es/function.compact.php
        return view('public.posts.index', compact('posts'));
    }

    public function adminIndex(Request $request)
    {
        return view('admin.posts.index', [ 'posts' => $request->user()->adminPosts() ]);
    }

    /**
     * Single post page.
     * Route binding
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('public.posts.show', ['post' => $post]);
    }

    /**
     * Create a new post - Form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        $tags = explode(", ",\request('tags'));

        $post = Post::create([
            'user_id' => $request->user()->id,
            'title' => \request('title'),
            'slug' => str_slug(\request('title')),
            'excerpt' => \request('excerpt'),
            'content' => \request('content')
        ]);

        foreach ($tags as $tag){
            $tag = Tag::firstOrCreate([
                'name' => $tag,
                'slug' => str_slug($tag)
            ]);
            $post->tags()->attach($tag);
        }

        return redirect('/');
    }

    public function edit(Post $post) {

        if( Gate::allows('canEdit', $post) ) {
            return view('admin.posts.edit', [
                'post' => $post,
                'tags' => $post->tags->pluck('name')->implode(', ')
            ]);
        }

        return "Not allowed";
    }

    public function patch(CreatePostRequest $request, Post $post) {

        $post->fill([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
        ]);

        $tags = explode(", ",\request('tags'));
        //dd($tags);
        $newTags = [];
        foreach ($tags as $tag){
            $tag = Tag::firstOrCreate([
                'name' => $tag,
                'slug' => str_slug($tag)
            ]);
            array_push($newTags, $tag);
        }

        //dd(collect($newTags)->pluck('id')->toArray());

        $post->tags()->sync(collect($newTags)->pluck('id')->toArray());

        $post->update();

        return redirect('admin/posts');
    }
}
