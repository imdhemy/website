<?php

declare(strict_types=1);

namespace App\Service\Security;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

final readonly class Authenticate
{
    public function __construct(private LoginRequest $request)
    {
    }

    public function execute(): User
    {
        if (!Auth::attempt([
            'email' => $this->request->email(),
            'password' => $this->request->password(),
        ])) {
            throw new InvalidLoginAttemptException();
        }

        return $this->request->user();
    }
}
