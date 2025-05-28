<?php

namespace App\Repositories;

use App\Models\Liked;
use App\Models\Companion;
use App\Models\LikedPost;
use Illuminate\Support\Carbon;
use App\Models\CompanionCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

class CompanionRepository
{

    public function allCategories()
    {
        $gender = request()->cookie('genero');
        $categories = CompanionCategory::whereHas('companions', function ($query) use ($gender) {
            if (!empty($gender)) {
                $query->where('gender', $gender)->where('active', 1);
            }
        })->with('companions');
            
        if ($gender) {
            $categories->whereHas('companions', function ($query) use ($gender) {
                $query->where('gender', $gender)->where('active', 1);
            });
        }
        $categories = $categories->active()->get();
        return $categories;
    }
    

    public function getActiveCompanionsHome($limit = 16)
    {
        $query = Companion::where(function($query) {
            $query->whereHas('subscribeds', function($status) {
                $status->where('status', 'paid');
            })->where('companion_status_verification', 'approved')->orWhere('is_courtesy', 1);
        })->active()->with(['subscribeds' => function($status) {
            $status->where('status', 'paid');
        }]);

        $genero = request()->cookie('genero');

        if ($genero) {
            $query->where('gender', $genero);
        }

        return $query->inRandomOrder()->limit($limit)->get();
    }

    public function getTopLoves($limit = 4)
    {
        $query = Companion::where(function($query) {
            $query->where('top_love', 1)
                  ->where(function($subQuery) {
                      $subQuery->whereHas('subscribeds', function($status) {
                          $status->where('status', 'paid');
                      })
                      ->where('companion_status_verification', 'approved')
                      ->orWhere('is_courtesy', 1);
                  });
        })
        ->active()
        ->with(['subscribeds' => function($status) {
            $status->where('status', 'paid');
        }]);       
    
        $genero = request()->cookie('genero');
    
        if ($genero) {
            $query->where('gender', $genero);
        }
        return $query->inRandomOrder()->limit($limit)->get();
    }
    
    public function getNewCompanions()
    {
        $now = Carbon::now();
    
        $query = Companion::where(function ($query) {
            $query->where(function ($q) {
                $q->whereHas('subscribeds', function ($status) {
                    $status->where('status', 'paid');
                })
                ->where('companion_status_verification', 'approved');
            })
            ->orWhere('is_courtesy', 1);
        })
        ->where('created_at', '>=', $now->subDays(30))
        ->active()
        ->with(['subscribeds' => function ($query) {
            $query->where('status', 'paid');
        }]);
        
        $genero = request()->cookie('genero');
    
        if ($genero) {
            $query->where('gender', $genero);
        }
        
        return $query->get();
    }
    
    public function getActiveCompanions($category = null)
    {   
        $query = Companion::with('categories')->where(function($query) {
            $query->whereHas('subscribeds', function($status) {
                $status->where('status', 'paid');
            })->where('companion_status_verification', 'approved')->orWhere('is_courtesy', 1);
        })->active()->with(['subscribeds' => function($status) {
            $status->where('status', 'paid');
        }]);
    
        $genero = request()->cookie('genero');
    
        // Sempre filtrar por gênero se o cookie existir
        if ($genero) {
            $query->where('gender', $genero);
        }
        
        if (!empty($category)) {
            $query->whereHas('categories', function($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        return $query->inRandomOrder()->get();
    }
    
    public function getCompanions()
    {   
        $query = Companion::with('categories')->where(function($query) {
            $query->whereHas('subscribeds', function($status) {
                $status->where('status', 'paid');
            })->where('companion_status_verification', 'approved')->orWhere('is_courtesy', 1);
        })->active()->with(['subscribeds' => function($status) {
            $status->where('status', 'paid');
        }]);
    
        $genero = request()->cookie('genero');
    
        // Sempre filtrar por gênero se o cookie existir
        if ($genero) {
            $query->where('gender', $genero);
        }

        return $query->inRandomOrder()->get();
    }

     // Obter um acompanhante por slug
     public function getCompanionBySlug($slug): ?Companion
     {
        return Companion::with('categories')
        ->where(function($query) {
            $query->whereHas('subscribeds', function($query) {
                $query->where('status', 'paid');
            })
            ->where('companion_status_verification', 'approved')->orWhere('is_courtesy', 1);
        })
        ->with(['subscribeds' => function($query) {
            $query->where('status', 'paid');
        }])
        ->with(['gallery' => function ($query) {
            $query->where('status', 'approved')
            ->with(['galleryFile' => function ($file) {
            // $file->limit(8); //Limitar quantidade de arquivos da galeria
            }])->limit(3); //Limitar quantidade de galeria            
        }])
        ->where('slug', $slug)
        ->active()
        ->first();
     }
 
     // Obter acompanhantes aleatórios
    public function getRandomCompanions(int $limit = 4, $slug): Collection
    {
        $query = Companion::where(function($query) {
            $query->whereHas('subscribeds', function($status) {
                $status->where('status', 'paid');
            })->where('companion_status_verification', 'approved')->orWhere('is_courtesy', 1);
        })->active()->with(['subscribeds' => function($status) {
            $status->where('status', 'paid');
        }]);
    
        $genero = request()->cookie('genero');

        if ($genero) {
            $query->where('gender', $genero)->where('slug', '<>', $slug);
        }
        return $query->inRandomOrder()->limit($limit)->get();
    }

    public function getLikedPostsByCompanionIdAndClientId($companionId, $clientId)
    {
        $likedPostByClient = [];
        $likedPostCounts = [];
    
        foreach ($companionId->post as $post) {
            // Verificar se o cliente curtiu o post
            $likedPostByClient[$post->id] = LikedPost::where('post_id', $post->id)
                ->where('client_id', $clientId)
                ->exists();
    
            // Contar o número de curtidas por post
            $likedPostCounts[$post->id] = LikedPost::where('post_id', $post->id)->count();
        }
    
        // Se o post não tem curtidas, definir como 0 ou vazio
        foreach ($likedPostCounts as $postId => $count) {
            if ($count == 0) {
                $likedPostCounts[$postId] = '';
            }
        }
    
        return [
            'likedPostByClient' => $likedPostByClient,
            'likedPostCounts' => $likedPostCounts,
        ];
    }  
}
