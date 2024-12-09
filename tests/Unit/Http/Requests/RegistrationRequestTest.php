<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\RegistrationRequest;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class RegistrationRequestTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    public function test_it_is_a_public_request(): void
    {
        $request = new RegistrationRequest();

        $actual = $request->authorize();

        $this->assertTrue($actual);
    }

    public function test_validation_rules(): void
    {
        $request = new RegistrationRequest();

        $actual = $request->rules();

        $expected = [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ];
        $this->assertSame($expected, $actual);
    }

    public function test_get_email(): void
    {
        $faker = Factory::create();
        $email = $faker->email();
        $sut = new RegistrationRequest(compact('email'));

        $actual = $sut->getEmail();

        $this->assertSame($email, $actual);
    }

    public function test_get_password(): void
    {
        $faker = Factory::create();
        $password = $faker->password();
        $sut = new RegistrationRequest();
        $sut->merge(['password' => $password]);

        $actual = $sut->getPassword();

        $this->assertSame($password, $actual);
    }
}
