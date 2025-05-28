<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable = [
        'companion_id',
        'title',
        'path_image',
        'position',
        'start_date',
        'end_date',
        'status',
        'sorting'
    ];

    public function scopeSorting($query){
        return $query->orderBy('created_at', 'desc');
    }
    public function companion(){
        return $this->belongsTo(Companion::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
