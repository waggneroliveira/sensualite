<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBlock extends Model
{
    protected $fillable = ['blocker_id', 'blocker_type', 'blocked_id', 'blocked_type'];

    // Verifica se um usuário bloqueou outro
    public static function isBlocked($blockerId, $blockerType, $blockedId, $blockedType)
    {
        return self::where([
            ['blocker_id', $blockerId],
            ['blocker_type', $blockerType],
            ['blocked_id', $blockedId],
            ['blocked_type', $blockedType]
        ])->exists();
    }
}
