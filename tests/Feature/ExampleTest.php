<?php

namespace Tests\Feature;

use App\PostModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // use RefreshDatabase;
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // $this->withoutExceptionHandling();
        $post = PostModel::first();
        $response = $this->get('/post/'.$post->slug.'/edit');

        $response->assertStatus(200);
    }
}
