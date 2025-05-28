<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryFile extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'gallery_id',
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

    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
