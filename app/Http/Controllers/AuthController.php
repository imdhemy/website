<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $user = User::create([
            'email' => $request->getEmail(),
            'password' => bcrypt($request->getPassword()),
        ]);

        return response()->json($user, Response::HTTP_CREATED);
    }
}
