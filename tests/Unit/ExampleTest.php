<?php

namespace Tests\Unit;

use App\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testArchives()
    {
        // Given I have more than one record in the database that are posts,
        // and each one is posted a month apart.

        $first = factory(Post::class)->create([
            'user_id' => 1
        ]);
        $second = factory(Post::class)->create([
            'user_id' => 1,
            'created_at' => Carbon::now()->subMonth()
        ]);

        // When I fetch the archives
        $archives = Post::archives()->toArray();

        // Then the response should be in proper format
        //$this->assertCount(2, $posts);
        $this->assertEquals([
            [
                'year' => $first->created_at->format('Y'),
                'month'=> $first->created_at->format('F'),
                'numberOfPosts' => 2
            ],
            [
                'year' => $second->created_at->format('Y'),
                'month'=> $second->created_at->format('F'),
                'numberOfPosts' => 1
            ]
        ], $archives);
    }
}
