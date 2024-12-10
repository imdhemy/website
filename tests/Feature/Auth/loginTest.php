<?php

namespace Tests\Feature\Auth;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Tests\TestCase;

class loginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
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
        $this->assertDatabaseHas('users', ['email' => $email]);
        $this->assertDatabaseHas('personal_access_tokens', [
            'name' => $user->name . '-AuthToken',
            'tokenable_id' => $user->id,
        ]);

    }
}
