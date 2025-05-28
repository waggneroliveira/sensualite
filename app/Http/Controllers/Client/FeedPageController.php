<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Companion;
use App\Models\LikedPost;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Services\FeedService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeedPageController extends Controller
{
    protected $feedService;

    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;
    }

    public function index()
    {
        $data = $this->feedService->getFeedData();
        return view('client.pages.feed', $data);
    }
}
