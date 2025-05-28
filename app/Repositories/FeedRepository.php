<?php
namespace App\Repositories;

use App\Models\Post;
use App\Models\Companion;
use App\Models\LikedPost;

class FeedRepository
{
    public function getPosts()
    {
        $query = Post::with('postFile');

        $genero = request()->cookie('genero');

        // Sempre filtrar por gênero se o cookie existir
        if ($genero) {
            $query->whereHas('companion', function($result) use ($genero) {
                $result->where('gender', $genero);
            });
        }
        return $query->orderByDesc('created_at')->get();
    }

    public function getLikedPostByClient($postId, $clientId)
    {
        return LikedPost::where('post_id', $postId)
            ->where('client_id', $clientId)
            ->exists();
    }

    public function getLikedPostCount($postId)
    {
        return LikedPost::where('post_id', $postId)->count();
    }

    public function suggestionsForYou (){
        $query = Companion::with(['post' => function ($query) {
            $query->with(['postFile' => function ($file) {
                $file->inRandomOrder()->limit(3);
            }]);
        }]);
        
        $genero = request()->cookie('genero');
        
        if ($genero) {
            $query->where('gender', $genero);
        }
        
        $query->whereHas('post');
        
        return $query->inRandomOrder()->active()->limit(4)->get();        
    }

}
