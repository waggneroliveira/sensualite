<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedbackClient extends Model
{
    use HasRoles, HasFactory, LogsActivity;

    protected $fillable = [
        'companion_id',
        'client_id',
        'surname',
        'message',
        'response',
        'rating',
        'city',
        'service_date',
        'active',
        'sorting',
        'like',
    ];

    public function scopeSorting($query){
        return $query->orderBy('sorting', 'ASC');
    }
    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function companion(){
        return $this->belongsTo(Companion::class, 'companion_id', 'id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
