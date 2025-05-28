<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['conversation_id', 'sender_id', 'message', 'sender_type', 'is_one_time_view'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
