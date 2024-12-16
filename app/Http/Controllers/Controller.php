<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    protected function ok($data): JsonResponse
    {
        return new JsonResponse($data, Response::HTTP_OK);
    }

    protected function created($data): JsonResponse
    {
        return new JsonResponse($data, Response::HTTP_CREATED);
    }
}
