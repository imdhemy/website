<?php

declare(strict_types=1);

namespace App\Service\Security;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Laravel\Sanctum\NewAccessToken;

final readonly class AuthenticatedUser implements Arrayable
{
    public function __construct(
        public User $user,
        public NewAccessToken $accessToken,
    ) {
    }

    public function toArray(): array
    {
        return [
            'user' => $this->user,
            'token' => $this->accessToken->plainTextToken,
        ];
    }
}
