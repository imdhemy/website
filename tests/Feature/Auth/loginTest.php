<?php

namespace Tests\Feature\Auth;


use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class loginTest extends TestCase
{
    use WithFaker;

    public function test_login_by_email(): void
    {
        $email = $this->faker()->email();
        $password = $this->faker()->password(8);
        $user = User::factory()->create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $response = $this->postJson('api/v1/auth/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['user', 'token']);
        $response->assertJson(['user' => $user->toArray()]);
        $this->assertDatabaseHas('personal_access_tokens', [
            'name' => '__AUTH_TOKEN__',
            'tokenable_id' => $user->id,
        ]);
    }

    public function test_login_by_invalid_credentials(): void
    {
        $email = $this->faker()->email();
        User::factory()->create(['email' => $email]);

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $email,
            'password' => $this->faker()->password(8),
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson([
            'errors' => [
                'password' => ['Invalid password'],
            ],
        ]);
    }
}
