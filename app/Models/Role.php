<?php

namespace App\Models;

use App\Models\Scopes\SuperAdminScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;
    
    protected static function booted(): void
    {
        static::addGlobalScope(new SuperAdminScope);
    }
}
