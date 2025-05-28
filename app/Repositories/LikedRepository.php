<?php

namespace App\Repositories;

use App\Models\Liked;

class LikedRepository
{
    public function getLikesCountHome($companionIds)
    {
        return Liked::whereIn('companion_id', $companionIds)
            ->get()
            ->groupBy('companion_id')
            ->map->count();
    }

    public function getClientLikesHome($companionIds, $clientId)
    {
        return Liked::whereIn('companion_id', $companionIds)
            ->where('client_id', $clientId)
            ->pluck('companion_id')
            ->toArray();
    }

    public function getLike($companionId, $clientId)
    {
        return Liked::where('companion_id', $companionId)
            ->where('client_id', $clientId)
            ->first();
    }

    public function createLike($companionId, $clientId)
    {
        return Liked::create([
            'companion_id' => $companionId,
            'client_id' => $clientId,
        ]);
    }

    public function deleteLike($companionId, $clientId)
    {
        $liked = $this->getLike($companionId, $clientId);
        if ($liked) {
            $liked->delete();
        }
    }


    //Pagina de acompanhantes
    public function getLikesCount($companionIds)
    {
        return Liked::whereIn('companion_id', $companionIds)
            ->get()
            ->groupBy('companion_id')
            ->map->count();
    }


    public function getClientLikes($companionIds, $clientId)
    {
        return Liked::whereIn('companion_id', $companionIds)
            ->where('client_id', $clientId)
            ->pluck('companion_id')
            ->toArray();
    }

    public function getLikesByCompanion($companionId)
    {
        return Liked::where('companion_id', $companionId)->get();
    }
}
