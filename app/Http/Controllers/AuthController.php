<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Service\Security\Authenticate;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request): JsonResponse
    {
        $user = User::create([
            'email' => $request->getEmail(),
            'password' => bcrypt($request->getPassword()),
        ]);

        return $this->created($user);
    }

    public function login(Authenticate $authenticate): JsonResponse
    {
        $user = $authenticate->execute();

        $token = $user->createToken('__AUTH_TOKEN__')->plainTextToken;

        return $this->ok(['user' => $user, 'token' => $token]);
    }

}
