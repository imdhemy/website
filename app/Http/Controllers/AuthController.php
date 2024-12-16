<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request): JsonResponse
    {
        $user = User::create([
            'email' => $request->getEmail(),
            'password' => bcrypt($request->getPassword()),
        ]);

        return response()->json($user, Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $email = $request->email();
        $password = $request->password();


        $check = Auth::attempt(['email' => $email, 'password' => $password]);
        if (!$check) {
            return response()->json(['message' => 'the password not correct'], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $email)->first();
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], Response::HTTP_OK);
    }

}
