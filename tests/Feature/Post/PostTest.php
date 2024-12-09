<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_create_post(): void
    {
        $data = [
            'title' => $this->faker->text(20),
            'body' => $this->faker->text(70),
            'user_id' => 1,
        ];

        $response = $this->postJson('/posts', $data);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'title',
                'body',
                'user_id',
            ],
        ]);

        $this->assertDatabaseHas('posts', $data);
    }
}
