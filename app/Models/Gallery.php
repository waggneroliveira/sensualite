<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable = [
        'title',
        'companion_id',
        'active',
        'requested_at',
        'approved_at',
        'rejected_at',
        'rejection_reason',
    ];

    public function galleryFile(){
        return $this->hasMany(GalleryFile::class);
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
