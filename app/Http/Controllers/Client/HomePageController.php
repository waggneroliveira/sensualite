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
            return redirect()->back()
                ->with('error', 'Faça o login para poder curtir a foto.')
                ->with('showLoginModal', true);
        }

        $this->likedService->toggleLike($companionId, $clientId);// Chama o serviço para alternar o like

        return redirect()->back();
    }
}
