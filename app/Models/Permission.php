<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends Model
{
    use HasFactory, HasRoles, LogsActivity;

    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function name()
    {
        return substr($this->name,strpos($this->name,'.')+1);
    }

    public function index()
    {
        $value = explode('.',$this->name);
        return $value[0];
    }

    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
