<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['client_id', 'companion_id', 'restrict', 'hash'];
    
    public function setHashAttribute()
    {
        $this->attributes['hash'] = Str::uuid();
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function companion()
    {
        return $this->belongsTo(Companion::class);
    }
}
