<?php
namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\Announcement;
use App\Repositories\FeedRepository;
use Illuminate\Support\Facades\Auth;

class FeedService
{
    protected $feedRepository;

    public function __construct(FeedRepository $feedRepository)
    {
        $this->feedRepository = $feedRepository;
    }

    public function getFeedData()
    {
        Carbon::setLocale('pt_BR');

        $clientId = Auth::guard('cliente')->check() ? Auth::guard('cliente')->user()->id : null;
        $posts = $this->feedRepository->getPosts();
        $suggestionscompanions = $this->feedRepository->suggestionsForYou(); // Obter sugestões de acompanhantes

        $timeDifferences = [];
        $likedPostByClient = [];
        $likedPostCounts = [];

        foreach ($posts as $post) {
            if ($post->companion) {
                $timeDifferences[$post->id] = $this->calculateTimeDifference($post->created_at);

                // Obtém curtidas
                $likedPostByClient[$post->id] = $this->feedRepository->getLikedPostByClient($post->id, $clientId);
                $likedPostCounts[$post->id] = $this->feedRepository->getLikedPostCount($post->id) ?: '';
            }
        }
        
        $ads = Announcement::with('companion')
        ->whereIn('position', ['feed_left', 'feed_footer'])
        ->where('status', 'completed')
        ->whereDate('end_date', '>=', date('Y-m-d'))
        ->inRandomOrder()
        ->get()
        ->groupBy('position');

        return compact('ads', 'posts', 'timeDifferences', 'likedPostByClient', 'likedPostCounts', 'suggestionscompanions');
    }

    private function calculateTimeDifference($createdAt)
    {
        $createdAt = Carbon::parse($createdAt);
        $now = Carbon::now();
        $diffInMinutes = $createdAt->diffInMinutes($now);
        $diffInDays = $createdAt->diffInDays($now);

        if ($diffInDays >= 1) {
            return "há " . CarbonInterval::days($diffInDays)->cascade()->forHumans();
        } elseif ($diffInMinutes >= 60) {
            return "há " . CarbonInterval::hours(floor($diffInMinutes / 60))->cascade()->forHumans();
        } elseif ($diffInMinutes > 0) {
            return "há " . CarbonInterval::minutes($diffInMinutes)->cascade()->forHumans();
        } else {
            return "agora mesmo";
        }
    }
}
