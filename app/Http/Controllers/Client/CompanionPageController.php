<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Liked;
use App\Models\Follow;
use App\Models\Gallery;
use App\Models\Companion;
use App\Models\LikedPost;
use Carbon\CarbonInterval;
use App\Models\GalleryFile;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\FeedbackClient;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\CompanionPageService;
use App\Services\FeedbackClientService;


class CompanionPageController extends Controller
{
    protected $companionPageService, $feedbackService;

    public function __construct(CompanionPageService $companionPageService, FeedbackClientService $feedbackService)
    {
        $this->companionPageService = $companionPageService;
        $this->feedbackService = $feedbackService;
    }

    public function index($category = null)
    {
        $clientId = Auth::guard('cliente')->check() ? Auth::guard('cliente')->user()->id : null;
    
        $data = $this->companionPageService->getCompanionPageData($category, null, $clientId);
    
        return view('client.pages.escort', $data);
    }

    public function companion($slug)
    {
        Carbon::setLocale('pt_BR');
        $clientId = Auth::guard('cliente')->check() ? Auth::guard('cliente')->user()->id : null;

        $data = $this->companionPageService->getCompanionPageData(null, $slug, $clientId);

        return view('client.pages.post', $data);
    }

    public function feedback(Request $request)
    {
        $result = $this->feedbackService->saveFeedback($request);

        return redirect()->back()
        ->with($result['status'], $result['message'])
        ->with('showLoginModal', $result['showLoginModal'] ?? false);
    }
}
