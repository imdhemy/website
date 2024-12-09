<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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
}
