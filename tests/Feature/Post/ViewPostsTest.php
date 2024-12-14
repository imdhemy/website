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
        $posts = Post::factory()->create();
        $posts= $posts->all();


        $response = $this->getJson('api/v1/index/posts' ,$posts->toArray());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['id','title','body','user_id']);
        $this->assertDatabaseHas('posts',$posts->toArray());
    }
}
