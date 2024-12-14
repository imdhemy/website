<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdatePostTest extends TestCase
{
    use RefreshDatabase; use WithFaker;

    public function test_update_one_post(): void
    {
        $post = Post::factory()->create();
        $post_updated =[
            'title'=> $this->faker()->sentence(),
            'body'=> $this->faker()->paragraph(),
        ];

        $response = $this->putJson("api/v1/update/post/$post->id", $post_updated);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['id','title','body','user_id']);
        $response->assertJsonFragment(['id' => $post->id]);
        $this->assertDatabaseHas('posts',['id' => $post->id] );

    }
}
