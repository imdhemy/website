<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostTest extends TestCase
{
    use  RefreshDatabase,WithFaker;
    public function test_create_post(): void
    {
        $user = User::factory()->create();
        $data = [
            'title' => $this->faker->text(20),
            'body' => $this->faker->text(70),
            'user_id' => $user->id,
        ];

        $response = $this->postJson('api/v1/posts', $data);

        $response->assertStatus(201);
        $response->assertJsonStructure([
                'id',
                'title',
                'body',
                'user_id',
                'created_at',
                'updated_at'
        ]);
        $this->assertDatabaseHas('posts', [
            'title' => $data['title'],
            'body' => $data['body'],
            'user_id' => $user->id,
        ]);
    }

    public function test_delete_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("api/v1/posts/{$post->id}");

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Post deleted successfully']);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

}
