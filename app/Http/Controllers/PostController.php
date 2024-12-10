<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Post;
use App\Http\Requests\PostRequest\StorePostRequest;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function store(StorePostRequest $request): JsonResponse
    {
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $post = Post::create([
            'title' => $request->getTitle(),
            'body' => $request->getBody(),
            'user_id' => $user->id,
        ]);


        return response()->json($post, Response::HTTP_CREATED);
    }
}
