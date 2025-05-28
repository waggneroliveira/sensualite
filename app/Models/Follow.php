<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['companion_id', 'client_id'];

    public function companion()
    {
        return $this->belongsTo(Companion::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
