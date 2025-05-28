<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable = [
        'companion_id',
        'apparence_type',
        'text',
    ];

    public function liked()
    {
        return $this->hasMany(LikedPost::class);
    }
    public function companion(){
        return $this->belongsTo(Companion::class);
    }

    public function postFile(){
        return $this->hasMany(PostFile::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
