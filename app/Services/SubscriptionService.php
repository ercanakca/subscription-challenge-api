<?php

namespace App\Services;

use App\Models\Application3rdPassword;
use App\Models\Subscription;
use Illuminate\Support\Facades\Http;

class SubscriptionService
{
    public function register($application_key, $device_os, string $receipt)
    {
        if ($device_os === 'IOS') {
            $cred = Application3rdPassword::where(['application_key' => $application_key, 'api' => 'apple'])->first();
            $response = Http::withBasicAuth($cred->username, $cred->password)->post(config('apis.apple').'/purchase', ['hash' => $receipt]);
        } elseif ($device_os === 'ANDROID') {
            $cred = Application3rdPassword::where(['application_key' => $application_key, 'api' => 'google'])->first();
            $response = Http::withBasicAuth($cred->username, $cred->password)->post(config('apis.google').'/purchase', ['hash' => $receipt]);
        } else {
            return ['status' => false, 'message' => 'Bilinmeyen bir cihaz ile istek gönderildi.'];
        }

        dump('********************');
        dump($response);

        return json_decode($response->body(), true);
    }

    public function check($application_key, $device_os, string $expire_date)
    {
        if ($device_os === 'IOS') {
            $cred = Application3rdPassword::where(['application_key' => $application_key, 'api' => 'apple'])->first();
            $response = Http::withBasicAuth($cred->username, $cred->password)->post(config('apis.apple').'/check', ['expire_date' => $expire_date]);
        } elseif ($device_os === 'ANDROID') {
            $cred = Application3rdPassword::where(['application_key' => $application_key, 'api' => 'google'])->first();
            $response = Http::withBasicAuth($cred->username, $cred->password)->post(config('apis.google').'/check', ['expire_date' => $expire_date]);
        } else {
            return ['status' => false, 'message' => 'Bilinmeyen bir cihaz ile istek gönderildi.'];
        }

        return json_decode($response->body(), true);
    }

    public function create($client_token, $receipt, $application_client, $register_response)
    {
        dump('123');

        return Subscription::create([
            'application_client_id' => $client_token,
            'app_id' => $application_client->app_id,
            'hash' => $receipt,
            'status' => $register_response['status'],
            'device_os' => $application_client->device_os,
            'created_at' => now(),
            'paid_at' => $register_response['status'] ? now() : null,
            'expire_date' => $register_response['status'] ? $register_response['expire_date'] : null,
        ]);
    }
}
