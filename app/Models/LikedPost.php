<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikedPost extends Model
{
    protected $fillable = ['post_id', 'client_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
