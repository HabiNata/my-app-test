<?php

namespace Tests\Unit;

use App\PostModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;

class PostTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_add_post()
    {
        $this->withoutExceptionHandling();

        $data = factory(PostModel::class)->make();

        $response = $this->post('post/store', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category'=> $data->category_id,

            'tag'=> [rand(1, 5)],
        ]);

        // $response->assertStatus(302);
        // $this->assertCount(1, PostModel::all());
        $this->assertDatabaseHas('post', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category_id'=> $data->category_id,
        ]);
    }

    public function test_title_validate_require()
    {
        // $this->withoutExceptionHandling();

        $data = factory(PostModel::class)->make([
            'title' => '',
        ]);

        $response = $this->post('post/store', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category'=> $data->category_id,

            'tag'=> [rand(1, 5)],
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_title_validate_min_3()
    {
        // $this->withoutExceptionHandling();

        $data = factory(PostModel::class)->make([
            'title' => 'as',
        ]);

        $response = $this->post('post/store', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category'=> $data->category_id,

            'tag'=> [rand(1, 5)],
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_body_validate_require()
    {
        // $this->withoutExceptionHandling();

        $data = factory(PostModel::class)->make([
            'body' => '',
        ]);

        $response = $this->post('post/store', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category'=> $data->category_id,

            'tag'=> [rand(1, 5)],
        ]);

        $response->assertSessionHasErrors('body');
    }

    public function test_category_validate_require()
    {
        // $this->withoutExceptionHandling();

        $data = factory(PostModel::class)->make([
            'category_id' => '',
        ]);

        $response = $this->post('post/store', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category'=> $data->category_id,

            'tag'=> [rand(1, 5)],
        ]);

        $response->assertSessionHasErrors('category');
    }

    public function test_tag_validate_require()
    {
        // $this->withoutExceptionHandling();

        $data = factory(PostModel::class)->make();

        $response = $this->post('post/store', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category'=> $data->category_id,

            'tag'=> '',
        ]);

        $response->assertSessionHasErrors('tag');
    }

    public function test_tag_validate_array()
    {
        // $this->withoutExceptionHandling();

        $data = factory(PostModel::class)->make();

        $response = $this->post('post/store', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category'=> $data->category_id,

            'tag'=> rand(1,5),
        ]);

        $response->assertSessionHasErrors('tag');
    }

    public function test_tag_validate_more_than_one()
    {
        // $this->withoutExceptionHandling();

        $data = factory(PostModel::class)->make();

        $response = $this->post('post/store', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category'=> $data->category_id,

            'tag'=> [rand(1, 5), rand(1, 5)],
        ]);

        // $this->assertCount(1, PostModel::all());
        $this->assertDatabaseHas('post', [
            'title'=> $data->title,

            'body'=> $data->body,

            'category_id'=> $data->category_id,
        ]);
    }

    // public function test_post_update()
    // {
    //     $this->withoutExceptionHandling();

    //     $post = PostModel::first();
    // }
}
