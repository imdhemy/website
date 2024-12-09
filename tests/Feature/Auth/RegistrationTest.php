<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use WithFaker;

    public function test_registration_by_email(): void
    {
        $email = $this->faker()->email();
        $data = [
            'email' => $email,
            'password' => $this->faker()->password(),
        ];

        $response = $this->postJson('/api/v1/auth/registration', $data);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure(['id', 'email', 'created_at', 'updated_at']);
        $response->assertJsonFragment(['email' => $email]);
        $this->assertDatabaseHas('users', ['email' => $email]);
    }
}
