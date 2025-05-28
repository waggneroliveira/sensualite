<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribed extends Model
{
    protected $fillable = [
        'plan_id',
        'companion_id',
        'order_code',
        'status',
        'last_pagarme_webhook_at',
    ];
   
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
