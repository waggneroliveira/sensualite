<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Subscribed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubscriptionStatusService
{
    public function checkAndExpireSubscriptions()
    {
        $now = Carbon::now();

        Subscribed::where('status', 'paid')
            ->where('last_pagarme_webhook_at', '<', $now->subWeek())
            ->update(['status' => 'expired']);
    }

    public function getExpiredSubscriptions(){
        $authSubscribidsExpired = Auth::guard('acompanhante')->user();
        $hasActiveSubscription = $authSubscribidsExpired->hasActiveSubscription();

        return $hasActiveSubscription;
    }
}
