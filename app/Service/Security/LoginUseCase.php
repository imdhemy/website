<?php

declare(strict_types=1);

namespace App\Service\Security;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

final readonly class LoginUseCase
{
    public function __construct(private LoginRequest $request)
    {
    }

    public function execute(): AuthenticatedUser
    {
        if (! Auth::attempt([
            'email' => $this->request->email(),
            'password' => $this->request->password(),
        ])) {
            throw new InvalidLoginAttemptException();
        }

        $user = $this->request->user();
        $token = $user->createToken('__AUTH_TOKEN__');

        return new AuthenticatedUser(user: $user, accessToken: $token);
    }
}
