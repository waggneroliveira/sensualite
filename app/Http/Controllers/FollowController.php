<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\LikedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggleFollow(Request $request, $companionId)
    {   
        $clientId = null;

        if (Auth::guard('cliente')->check()) {
            $clientId = Auth::guard('cliente')->user()->id;
        } else {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'error' => 'Faça o login para poder seguir a acompanhante.',
                    'showLoginModal' => true
                ], 401);
            }
            return redirect()->back()
                ->with('error', 'Faça o login para poder seguir a acompanhante.')
                ->with('showLoginModal', true); 
        }

        // Verifica se já segue
        $follow = Follow::where('companion_id', $companionId)
            ->where('client_id', $clientId)
            ->first();

        if ($follow) {
            $follow->delete(); // Remove a seguida
            $followed = false;
        } else {
            Follow::create([
                'companion_id' => $companionId,
                'client_id' => $clientId,
            ]);
            $followed = true;
        }
        $followersCount = Follow::where('companion_id', $companionId)->count();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'followed' => $followed,
                'followersCount' => $followersCount
            ]);
        }
        return redirect()->back();
    }

    public function togglePostLiked(Request $request, $postId)
    {
        if (!Auth::guard('cliente')->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Faça o login para poder curtir a foto.',
                    'showLoginModal' => true,
                ], 401);
            }
            return redirect()->back()
                ->with('error', 'Faça o login para poder curtir a foto.')
                ->with('showLoginModal', true);
        }

        $clientId = Auth::guard('cliente')->user()->id;

        // Verifica se já existe a curtida
        $liked = LikedPost::where('post_id', $postId)
            ->where('client_id', $clientId)
            ->first();

        if ($liked) {
            $liked->delete();
            $likedNow = false;
        } else {
            LikedPost::create([
                'post_id' => $postId,
                'client_id' => $clientId,
            ]);
            $likedNow = true;
        }
        $count = LikedPost::where('post_id', $postId)->count();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'liked' => $likedNow,
                'count' => $count,
            ]);
        }
        // Para requisição normal, apenas redireciona de volta
        return redirect()->back();
    }

}
