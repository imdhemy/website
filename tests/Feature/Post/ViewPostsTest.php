<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ViewPostsTest extends TestCase
{

    public function test_index_all_posts(): void
    {
        $posts = Post::factory(2)->create();

        $response = $this->getJson('api/v1/index/posts' );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            '*'=>['id','title','body','user_id'],
      ]);
}

    public function test_show_one_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->getJson("api/v1/show/post/$post->id");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['id','title','body','user_id']);
        $this->assertDatabaseHas('posts',['id' => $post->id] );

    }
}
