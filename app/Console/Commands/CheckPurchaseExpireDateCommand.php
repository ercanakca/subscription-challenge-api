<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class CheckPurchaseExpireDateCommand extends Command
{
    protected $signature = 'app:check-purchase-expire-date-command';

    protected $description = 'Aboneliklerin süresinin dolup dolmadığını kontrol ederek günceller.';

    public function handle(SubscriptionService $subscriptionService)
    {
        $subscriptions = Subscription::select(['id', 'app_id', 'device_os', 'status', 'expire_date'])->where(['status' => 1])->whereDate('expire_date', '<', now('-6'))->limit(1000)->get();

        foreach ($subscriptions as $subscription) {
            $res = $subscriptionService->check($subscription->app_id, $subscription->device_os, $subscription->expire_date);
            if ($res['status'] === false) {
                $subscription->status = false;
                $subscription->save();
            }
        }
    }
}
