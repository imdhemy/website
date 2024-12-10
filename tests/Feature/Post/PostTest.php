<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;
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
}
