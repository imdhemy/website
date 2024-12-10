<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Post;
use App\Http\Requests\PostRequest\StorePostRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function store(StorePostRequest $request): JsonResponse
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $post = Post::create([
            'title' => $request->getTitle(),
            'body' => $request->getBody(),
            'user_id' => $user->id,
        ]);
        return response()->json($post, Response::HTTP_CREATED);
    }

    public function destroy($id): JsonResponse
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }

        if ($post->user_id !== $user->id) {
            return response()->json(['error' => 'You are not authorized to delete this post'], Response::HTTP_FORBIDDEN);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], Response::HTTP_OK);
    }


}
