<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\Authenticatable;

class Client extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'password',
        'policy_term',
        'active',
        'path_image',
    ];
    
    protected static $recordEvents = ['created', 'deleted']; //OBS: Com isso eu evito que, ao deslogar, o activity log registre o evento de update quando eu deslogar

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function liked()
    {
        return $this->hasMany(Liked::class);
    }

    public function scopeActive(){
        return $this->where('active', 1);
    }

    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
