<?php

namespace App\Http\Controllers;

use App\Models\Liked;
use App\Models\Companion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LikedController extends Controller
{
    public function toggleLiked(Request $request, $companionId)
    {   
        $clientId = null;

        if (Auth::guard('cliente')->check()) {
            $clientId = Auth::guard('cliente')->user()->id;
        } else {
            return redirect()->route('client.home')
                ->with('error', 'Faça o login para poder curtir a foto.')
                ->with('showLoginModal', true); 
        }

        // Verifica se já existe a curtida
        $liked = Liked::where('companion_id', $companionId)
            ->where('client_id', $clientId)
            ->first();

        if ($liked) {
            $liked->delete(); // Remove a curtida
            $response = [
                'liked' => false,
                'message' => 'Curtida removida com sucesso!',
            ];
        } else {
            Liked::create([
                'companion_id' => $companionId,
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

    public function getLikeds($compaionId)
    {
        $compaion = Companion::withCount('likeds')->findOrFail($compaionId);
        $clientId = auth()->id();

        $clientCurtiu = $compaion->likeds()->where('client_id', $clientId)->exists();

        return response()->json([
            'likeds_total' => $compaion->likeds_count,
            'client_curtiu' => $clientCurtiu,
        ]);
    }
}
