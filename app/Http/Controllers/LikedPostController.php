<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\LikedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikedPostController extends Controller
{
    public function toggleLiked(Request $request, $postId)
    {
        $clientId = Auth::guard('cliente')->user()->id;

        // Verifica se já existe a curtida
        $liked = LikedPost::where('post_id', $postId)
            ->where('client_id', $clientId)
            ->first();

        if ($liked) {
            $liked->delete(); // Remove a curtida
            $response = [
                'liked' => false,
                'message' => 'Curtida removida com sucesso!',
            ];
        } else {
            LikedPost::create([
                'post_id' => $postId,
                'client_id' => $clientId,
            ]);
            $response = [
                'liked' => true,
                'message' => 'Curtida registrada com sucesso!',
            ];
        }
        
        // Retorna a resposta em formato JSON
        return response()->json($response);
    }

    public function getLikeds($postId)
    {
        $post = Post::withCount('likeds')->findOrFail($postId);
        $clientId = auth()->id();

        $clientCurtiu = $post->likeds()->where('client_id', $clientId)->exists();

        return response()->json([
            'likeds_total' => $post->likeds_count,
            'client_curtiu' => $clientCurtiu,
        ]);
    }
}
