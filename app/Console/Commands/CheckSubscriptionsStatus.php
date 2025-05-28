<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SubscriptionStatusService;

class CheckSubscriptionsStatus extends Command
{
    protected $signature = 'subscriptions:check-status';
    protected $description = 'Verifica assinaturas e expira se necessário';
    
    protected $service;

    public function __construct(SubscriptionStatusService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function handle()
    {
        $this->service->checkAndExpireSubscriptions();
        $this->info('Assinaturas verificadas e atualizadas.');
    }
}
