<?php

declare(strict_types=1);

namespace App\Service\Security;

use Illuminate\Http\JsonResponse;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

final  class InvalidLoginAttemptException extends RuntimeException
{
    public function render(): JsonResponse
    {
        return new JsonResponse([
            'errors' => [
                'password' => ['Invalid password'],
            ],
        ], Response::HTTP_BAD_REQUEST);
    }
}
