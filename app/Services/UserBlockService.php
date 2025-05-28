<?php

namespace App\Services;

use App\Models\UserBlock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBlockService
{
    public function blockUserClient($blockedId, $blockerId)
    {   
        $blockedType = 'acompanhante';
        $blockerType = 'cliente';

        // dd($blockedId, $blockerId);
        if (UserBlock::isBlocked($blockerId, $blockerType, $blockedId, $blockedType)) {
            return ['status' => false, 'message' => 'Usuário já está bloqueado.'];
        }

        try {
            DB::beginTransaction();
            UserBlock::create([
                'blocker_id' => $blockerId,
                'blocker_type' => $blockerType,
                'blocked_id' => $blockedId,
                'blocked_type' => $blockedType
            ]);
            DB::commit();
            return ['status' => true, 'message' => 'Usuário bloqueado com sucesso!'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'message' => 'Não foi possível bloquear usuário!'];
        }
    }
    public function blockUserCompanion($blockedId, $blockerId)
    {   
        $blockedType = 'cliente';
        $blockerType = 'acompanhante';
        // dd($blockedId, $blockerId);
        if (UserBlock::isBlocked($blockerId, $blockerType, $blockedId, $blockedType)) {
            return ['status' => false, 'message' => 'Usuário já está bloqueado.'];
        }

        try {
            DB::beginTransaction();
            UserBlock::create([
                'blocker_id' => $blockerId,
                'blocker_type' => $blockerType,
                'blocked_id' => $blockedId,
                'blocked_type' => $blockedType
            ]);
            DB::commit();
            return ['status' => true, 'message' => 'Usuário bloqueado com sucesso!'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'message' => 'Não foi possível bloquear usuário!'];
        }
    }
}
