<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostFile extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'post_id',
        'file',
        'sorting',
        'active'
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }
    public function scopeSorting($query){
        return $query->orderBy('sorting', 'ASC');
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
