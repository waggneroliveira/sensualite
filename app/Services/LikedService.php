<?php

namespace App\Services;

use App\Repositories\LikedRepository;

class LikedService
{
    protected $likedRepository;

    public function __construct(LikedRepository $likedRepository)
    {
        $this->likedRepository = $likedRepository;
    }

    public function toggleLike($companionId, $clientId)
    {
        $liked = $this->likedRepository->getLike($companionId, $clientId);

        if ($liked) {
            $this->likedRepository->deleteLike($companionId, $clientId);
        } else {
            $this->likedRepository->createLike($companionId, $clientId);
        }
    }
}
