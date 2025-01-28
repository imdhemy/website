<?php

namespace Tests\Unit\app\Http\Requests;

use App\Http\Requests\LoginRequest;
use PHPUnit\Framework\TestCase;
use Faker\Factory;

class LoginRequestUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_it_is_a_public_request(): void
    {
        $request = new loginRequest();

        $actual = $request->authorize();

        $this->assertTrue($actual);
    }

    public function test_validation_rules(): void
    {
        $request = new loginRequest();

        $actual = $request->rules();

        $expected = [
            'email' => ['required','email','exists:users,email'],
            'password' => ['required', 'min:8'],
        ];
        $this->assertSame($expected, $actual);
    }

    public function test_get_email(): void
    {
        $faker = Factory::create();
        $email = $faker->email();
        $sut = new loginRequest(compact('email'));

        $actual = $sut->email();

        $this->assertSame($email, $actual);
    }

    public function test_get_password(): void
    {
        $faker = Factory::create();
        $password = $faker->password();
        $sut = new loginRequest();
        $sut->merge(['password' => $password]);

        $actual = $sut->Password();

        $this->assertSame($password, $actual);
    }
}
