<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckSubscriptionRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\ApplicationClient;
use App\Models\Subscription;
use App\Services\SubscriptionService;

class PurchaseController extends Controller
{
    public function purchase(PurchaseRequest $request, SubscriptionService $subscriptionService)
    {
        $client_token = $request->get('client_token');
        $receipt = $request->get('receipt');

        $application_client = ApplicationClient::where(['client_token' => $client_token])->first();

        $response = $subscriptionService->register($application_client->app_id, $application_client->device_os, $receipt);

        $subscription = $subscriptionService->create($client_token, $receipt, $application_client, $response);

        return response([
            'status' => $subscription->status,
            'expire_date' => $subscription->expire_date,
        ]);
    }

    public function check(CheckSubscriptionRequest $request, SubscriptionService $subscriptionService)
    {
        $client_token = $request->get('client_token');

        $last_subscription = Subscription::where(['application_client_id' => $client_token])->orderBy('id', 'desc')->first();

        $response = $subscriptionService->check($last_subscription->app_id, $last_subscription->device_os, $last_subscription->expire_date);

        if ($response['status'] === false) {
            $last_subscription->status = false;
            $last_subscription->save();
        }

        return response([
            'status' => $response['status'],
            'message' => $response['message'],
        ]);
    }
}
