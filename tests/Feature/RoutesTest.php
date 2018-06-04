<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoutesTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Testing the single post page.
     */
    public function testSinglePost()
    {
        $post = factory(Post::class)->create([
            'user_id' => 1
        ]);

        $response = $this->get('/posts/'.$post->slug);
        $response->assertStatus(200);
    }

    /**
     * Testing new post route: /posts/create
     */
    public function testNewPost()
    {
            $user = User::find(1);

        // The user is not logged in
        $response = $this->get('/posts/create');
        $response->assertStatus(302);

        // The user is logged in
        $response = $this->actingAs($user)->get('/posts/create');
        $response->assertStatus(200);
    }

    /**
     * Testing admin panel route: /admin
     */
    public function testAdminPanel()
    {
        $user = User::find(1);

        $response = $this->get('/admin');
        $response->assertStatus(302);

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
    }

    /**
     * Testing posts admin panel route: /admin/posts
     */
    public function testAdminPanelPosts()
    {
        $user = User::find(1);

        $response = $this->get('/admin/posts');
        $response->assertStatus(302);

        $response = $this->actingAs($user)->get('/admin/posts');
        $response->assertStatus(200);
    }

    /**
     * Testing edit post route: /admin/posts/{slug}/edit
     */
    public function testEditPost() {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id' => $user->id
        ]);

        // Check that the url doesn't load if the user is not logged in.
        $response = $this->get('/admin/posts/'.$post->slug.'/edit');
        $response->assertStatus(302);

        // Check that the url loads if the user is logged in.
        $response = $this->actingAs($user)->get('/admin/posts/'.$post->slug.'/edit');
        $response->assertStatus(200);
    }
}
