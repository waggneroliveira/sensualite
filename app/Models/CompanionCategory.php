<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanionCategory extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable = [
        'title',
        'slug',
        'active',
        'path_image',
        'sorting',
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }
    // public function companions()
    // {
    //     return $this->hasMany(Companion::class);
    // }
    public function companions()
{
    return $this->belongsToMany(
        Companion::class, 
        'companion_category_has_companions', 
        'companion_category_id', 
        'companion_id'
    );
}
    public function scopeSorting($query){
        return $query->orderBy('sorting', 'asc');
    }
    
    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
