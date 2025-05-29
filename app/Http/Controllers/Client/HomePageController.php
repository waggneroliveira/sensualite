<?php

namespace App\Http\Controllers\Client;

use DateTime;
use Carbon\Carbon;
use App\Models\Liked;
use App\Models\Companion;
use App\Models\LikedPost;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Services\HomeService;
use App\Services\LikedService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{

    protected $homeService, $likedService;

    public function __construct(HomeService $homeService, LikedService $likedService)
    {
        $this->homeService = $homeService;
        $this->likedService = $likedService;
    }

    public function index()
    {
        $data = $this->homeService->getHomeData();
        return view('client.pages.home', $data);
    }

    public function setGenero(Request $request)
    {
        $genero = $request->input('genero');

        session(['genero' => $genero]);
        
        return redirect()->route('client.home')->cookie('genero', $genero, 43200); // 30 dias
    }

    public function toggleLiked(Request $request, $companionId)
    {
        $clientId = Auth::guard('cliente')->id();

        if (!$clientId) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'error' => 'Faça o login para poder curtir a foto.',
                    'showLoginModal' => true
                ], 401);
            }
            return redirect()->back()
                ->with('error', 'Faça o login para poder curtir a foto.')
                ->with('showLoginModal', true);
        }

        $liked = $this->likedService->toggleLike($companionId, $clientId);
        $likedCount = Liked::where('companion_id', $companionId)->count();
        // Verifica se o usuário logado curtiu após a ação
        $likedByMe = Liked::where('companion_id', $companionId)
            ->where('client_id', $clientId)
            ->exists();

        return response()->json([
            'liked' => $liked,
            'likedCount' => $likedCount,
            'likedByMe' => $likedByMe,
            'companionId' => $companionId
        ]);
    }
}
