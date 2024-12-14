<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UpdatePostRequest;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class UpdatePostRequestTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_validation_update_rules(): void
    {
        $request = new UpdatePostRequest();

        $actual = $request->rules();

        $expected = [
            'title' => ['required','string','max:100'],
            'body' => ['required'],
        ];
        $this->assertSame($expected,$actual);
    }

    public function test_get_title(): void
    {
        $faker = Factory::create();
        $title = $faker->sentence();
        $sut = new UpdatePostRequest(compact('title'));

        $actual = $sut->getTitle();

        $this->assertSame($title, $actual);
    }
    public function test_get_body(): void
    {
        $faker = Factory::create();
        $body = $faker->paragraph();
        $sut = new UpdatePostRequest(compact('body'));

        $actual = $sut->getBody();

        $this->assertSame($body, $actual);
    }

}
