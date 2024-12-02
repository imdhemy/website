<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $user = User::create([
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
        ]);

        return response()->json($user, 201);
    }
}
