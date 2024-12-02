<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\RegistrationRequest;
use PHPUnit\Framework\TestCase;

class RegistrationRequestTest extends TestCase
{
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
}
