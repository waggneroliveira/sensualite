<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Liked;
use App\Models\Follow;
use App\Models\Gallery;
use App\Models\LikedPost;
use Carbon\CarbonInterval;
use App\Models\Announcement;
use App\Models\Conversation;
use App\Models\FeedbackClient;
use App\Models\CompanionCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LikedRepository;
use App\Repositories\CompanionRepository;

class CompanionPageService
{
    protected $companionRepository;
    protected $likedRepository;

    public function __construct(CompanionRepository $companionRepository, LikedRepository $likedRepository)
    {
        $this->companionRepository = $companionRepository;
        $this->likedRepository = $likedRepository;
    }

    public function getCompanionPageData($category = null, $slug = null, $clientId = null)
    {
        $clientId = Auth::guard('cliente')->id();//Retornar usuário autenticado
        $companions = $this->companionRepository->getActiveCompanions($category);// Buscar acompanhantes ativos
        
        $companionIds = $companions->pluck('id')->toArray();// Obter os IDs dos acompanhantes
        $categories = $this->companionRepository->allCategories();
        $likeds = $this->likedRepository->getLikesCount($companionIds);// Buscar as curtidas por companion_id     

        // Verificar se o cliente curtiu as acompanhantes
        $likedByClient = [];
        if ($clientId) {
            $clientLikes = $this->likedRepository->getClientLikes($companionIds, $clientId);
            foreach ($companionIds as $id) {
                $likedByClient[$id] = in_array($id, $clientLikes);
                
            }
        }

        $authUserType = Auth::guard('cliente')->check() ? 'cliente' : (Auth::guard('acompanhante')->check() ? 'acompanhante' : null);

        $companion = $this->companionRepository->getCompanionBySlug($slug);//Buscar acompanhante por slug

        if(isset($companion)){
            $conversationExists = Conversation::where('client_id', $clientId)
            ->where('companion_id', $companion->id)
            ->exists();
            $conversationId = Conversation::select(
                'id'
            )
            ->where('client_id', $clientId)
            ->where('companion_id', $companion->id)
            ->first();
        }

        $ads = Announcement::with('companion')
        ->whereIn('position', ['companion_left', 'companion_footer'])
        ->where('status', 'completed')
        ->whereDate('end_date', '>=', date('Y-m-d'))
        ->inRandomOrder()
        ->get()
        ->groupBy('position');
   
        if (!$companion) {
            $adscompanions = Announcement::with('companion')->where('position', 'companion')
            ->where('status', 'completed')
            ->where(DB::raw('DATE(end_date)'), '>=', date('Y-m-d'))
            ->inRandomOrder()
            ->get();

            $ads = Announcement::with('companion')
            ->whereIn('position', ['companion', 'companion_footer'])
            ->where('status', 'completed')
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->inRandomOrder()
            ->get()
            ->groupBy('position');

            return [
                'likeds' => $likeds ?? collect(),
                'likedByClient' => $likedByClient ?? [],
                'categories' => $categories ?? collect(), 
                'ads' => $ads ?? collect(), 
                'adscompanions' => $adscompanions ?? collect(), 
                'companions' => $this->companionRepository->getActiveCompanions($category)//Buscar todos as acomapanhantes 
            ];
        }
        
        $companions = $this->companionRepository->getRandomCompanions(4, $companion->slug);// Obter s acompanhantes aleatórios da página de acompanhante (Modelos Prive)

        // Lógica de tempo das galerias e posts
        $diffInHoursGallery = $this->calculateTimeDifference($companion->gallery);
        $timeDifferences = $this->calculatePostTimeDifferences($companion->post);

        // Obter curtidas e seguidores
        $likedCounts = Liked::where('companion_id', $companion->id)
        ->get()
        ->groupBy('companion_id')
        ->map(fn($likes) => $likes->count());

        $likedCountsAll = Liked::selectRaw('companion_id, COUNT(*) as count')
        ->groupBy('companion_id')
        ->pluck('count', 'companion_id'); 

        $likedPostCounts = LikedPost::join('posts', 'posts.id', '=', 'liked_posts.post_id')
        ->where('posts.companion_id', $companion->id)
        ->where('liked_posts.client_id', $clientId)
        ->get()
        ->groupBy('companion_id')
        ->map(fn($likePosts) => $likePosts->count());

        // Obter as seguidas por companion_id
        $follows = Follow::where('companion_id', $companion->id)
        ->get()
        ->groupBy('companion_id');

        $followCounts = Follow::where('companion_id', $companion->id)
        ->get()
        ->groupBy('companion_id')
        ->map(fn($follows) => $follows->count());

        $followByClient = Follow::where('companion_id', $companion->id)
        ->where('client_id', $clientId)
        ->exists();

        // Obter feedbacks
        $feedbacks = FeedbackClient::with('companion')
        ->where('companion_id', $companion->id)
        ->sorting()
        ->active()
        ->get();

        $feedbackChecked = FeedbackClient::where('client_id', $clientId)
        ->where('companion_id', $companion->id) 
        ->exists(); 

        // Obter midias
        $midiaGalleries = Post::with('postFile')
        ->where('companion_id', $companion->id)
        ->get();

        $publishes = ($companion->post->count() ?? 0);

        // Obter as curtidas de posts por companion_id e client_id
        $likedPosts = $this->companionRepository->getLikedPostsByCompanionIdAndClientId($companion, $clientId);
        $likedPostByClient = $likedPosts['likedPostByClient'];
        $likedPostCounts = $likedPosts['likedPostCounts'];
        
        return [
            'categories' => $categories,
            'authUserType' => $authUserType,
            'conversationId' => $conversationId,
            'conversationExists' => $conversationExists,
            'companion' => $companion,
            'companions' => $companions ?? collect(),
            'ads' => $ads ?? collect(),
            'likedPosts' => $likedPosts ?? collect(),
            'likedCounts' => $likedCounts ?? collect(),
            'likeds' => $likeds ?? collect(),
            'likedCountsAll' => $likedCountsAll ?? collect(),
            'likedPostCounts' => $likedPostCounts ?? collect(),
            'follows' => $follows ?? collect(),
            'followCounts' => $followCounts ?? collect(),
            'likedByClient' => $likedByClient ?? [],
            'followByClient' => $followByClient ?? false,
            'publishes' => $publishes ?? 0,
            'feedbacks' => $feedbacks ?? collect(),
            'midiaGalleries' => $midiaGalleries ?? collect(),
            'timeDifferences' => $timeDifferences ?? [],
            'diffInHoursGallery' => $diffInHoursGallery ?? 0,
            'likedPostByClient' => $likedPostByClient ?? [],
            'likedPostCounts' => $likedPostCounts ?? collect(),
            'feedbackChecked' => $feedbackChecked
        ];
        
    }

    private function calculateTimeDifference($gallery)
    {
        $diffInHoursGallery = null;
    
        if ($gallery->isNotEmpty()) {
            foreach ($gallery as $g) {
                $createdAt = Carbon::parse($g->created_at);
                $now = Carbon::now();
                $diffInMinutes = $createdAt->diffInMinutes($now);
                $diffInDays = $createdAt->diffInDays($now);
    
                // Se tiver mais de 24 horas, exibir "há X dias"
                if ($diffInDays >= 1) {
                    $diffInHoursGallery = "há " . CarbonInterval::days($diffInDays)->cascade()->forHumans();
                } elseif ($diffInMinutes >= 60) {
                    // Exibir em horas se for maior que 60 minutos
                    $diffInHoursGallery = "há " . CarbonInterval::hours(floor($diffInMinutes / 60))->cascade()->forHumans();
                } elseif ($diffInMinutes > 0) {
                    // Exibir em minutos
                    $diffInHoursGallery = "há " . CarbonInterval::minutes($diffInMinutes)->cascade()->forHumans();
                } else {
                    // Exibir em segundos ou "agora mesmo"
                    $diffInHoursGallery = "há " . CarbonInterval::seconds($diffInMinutes * 60)->cascade()->forHumans();
                }
            }
        }
    
        return $diffInHoursGallery;
    }

    private function calculatePostTimeDifferences($posts)
    {
        $timeDifferences = [];
        foreach ($posts as $post) {
            $createdAt = Carbon::parse($post->created_at);
            $now = Carbon::now();
            
            $diffInSeconds = $createdAt->diffInSeconds($now);
            $diffInMinutes = $createdAt->diffInMinutes($now);
            $diffInHours = $createdAt->diffInHours($now);
            $diffInDays = $createdAt->diffInDays($now);

            if ($diffInDays >= 1) {
                $formattedDiff = CarbonInterval::days($diffInDays)->cascade()->forHumans();
            } elseif ($diffInHours >= 1) {
                $formattedDiff = CarbonInterval::hours($diffInHours)->cascade()->forHumans();
            } elseif ($diffInMinutes >= 1) {
                $formattedDiff = CarbonInterval::minutes($diffInMinutes)->cascade()->forHumans();
            } else {
                $formattedDiff = CarbonInterval::seconds($diffInSeconds)->cascade()->forHumans();
            }

            $timeDifferences[$post->id] = "há " . $formattedDiff;
        }

        return $timeDifferences;

    }
    

}
