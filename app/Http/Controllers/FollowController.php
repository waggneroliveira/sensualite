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
            return redirect()->back();
        } else {
            Follow::create([
                'companion_id' => $companionId,
                'client_id' => $clientId,
            ]);
            return redirect()->back();
        }
        
        return redirect()->back();
    }

    public function togglePostLiked(Request $request, $postId)
    {   
        $clientId = null;

        if (Auth::guard('cliente')->check()) {
            $clientId = Auth::guard('cliente')->user()->id;
        } else {
            return redirect()->back()
                ->with('error', 'Faça o login para poder curtir a foto.')
                ->with('showLoginModal', true); 
        }
        
        // Verifica se já existe a curtida
        $liked = LikedPost::join('posts','liked_posts.post_id','posts.id')
        ->select(
            'posts.id as postId',
            'posts.companion_id as postCompanionId',
            'liked_posts.id',
            'liked_posts.post_id',
            'liked_posts.client_id',
        )
        ->where('posts.id', $postId)
        ->where('client_id', $clientId)
        ->first();


        if ($liked) {
            $liked->delete(); // Remove a curtida
            return redirect()->back();
        } else {
            LikedPost::create([
                'post_id' => $postId,
                'client_id' => $clientId,
            ]);
            return redirect()->back();
        }
        
        return redirect()->back();
    }
}
