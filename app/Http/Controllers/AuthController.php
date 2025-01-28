<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Service\Security\LoginUseCase;
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

    public function login(LoginUseCase $useCase): JsonResponse
    {
        return $this->ok($useCase->execute());
    }
}
