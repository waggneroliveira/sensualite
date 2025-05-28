<?php

namespace App\Repositories;

use App\Models\FeedbackClient;

class FeedbackClientRepository
{
    public function create(array $data)
    {
        return FeedbackClient::create($data);
    }
}
