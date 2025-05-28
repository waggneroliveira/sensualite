<?php
namespace App\Services;

use App\Repositories\CompanionRepository;
use App\Repositories\LikedRepository;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeService
{
    protected $companionRepository;
    protected $likedRepository;

    public function __construct(CompanionRepository $companionRepository, LikedRepository $likedRepository) {
        $this->companionRepository = $companionRepository;
        $this->likedRepository = $likedRepository;
    }

    public function getHomeData()
    {
        $clientId = Auth::guard('cliente')->id();
        
        $companions = $this->companionRepository->getActiveCompanionsHome();
        $topLoves = $this->companionRepository->getTopLoves();
        $newsCompanions = $this->companionRepository->getNewCompanions();
        $categories = $this->companionRepository->allCategories();
        $companionIds = $companions->pluck('id')->merge($topLoves->pluck('id'));

        // Buscar curtidas e formatar para a view
        $likedCounts = $this->likedRepository->getLikesCountHome($companionIds);

        $likedByClient = [];
        if ($clientId) {
            $clientLikes = $this->likedRepository->getClientLikesHome($companionIds, $clientId);
            foreach ($companionIds as $id) {
                $likedByClient[$id] = in_array($id, $clientLikes);
            }
        }

        // Buscar anúncios
        $ads = Announcement::where('position', 'home')
        ->where('status', 'completed')
        ->where(DB::raw('DATE(end_date)'), '>=', date('Y-m-d'))
        ->inRandomOrder()
        ->get();

        $adsHomeFooter = Announcement::where('position', 'footer_home')
        ->where('status', 'completed')
        ->where(DB::raw('DATE(end_date)'), '>=', date('Y-m-d'))
        ->inRandomOrder()
        ->get();

        return compact('newsCompanions', 'companions', 'ads', 'likedCounts', 'likedByClient', 'topLoves', 'categories', 'adsHomeFooter');
    }
}
