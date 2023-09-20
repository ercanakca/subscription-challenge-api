<?php

namespace App\Services;

use App\Models\Application;
use App\Models\ApplicationClient;
use App\Models\Device;
use Illuminate\Support\Str;

class AuthService
{
    public function register($app_id, $os, $device_uid, $language)
    {
        $app = Application::where(['app_key' => $app_id, 'is_active' => true])->first();
        if ($app) {
            $device = Device::firstOrCreate([
                'device_os' => $os,
                'device_uid' => $device_uid,
            ]);

            if ($device) {
                $client_token = Str::random(25);
                $application_client = ApplicationClient::where([
                    'device_uid' => $device->device_uid,
                    'app_id' => $app_id,
                    'language' => $language,
                    'device_os' => $os,
                ])->first();
                if (! $application_client) {
                    $application_client = ApplicationClient::firstOrCreate([
                        'device_uid' => $device->device_uid,
                        'app_id' => $app_id,
                        'language' => $language,
                        'device_os' => $os,
                        'client_token' => $client_token,
                    ]);
                }

                return [
                    'status' => true,
                    'client_token' => $application_client->client_token,
                ];
            }

            return [
                'status' => false,
                'message' => 'Kaydınız gerçekleştirilemedi.',
            ];
        }

        return [
            'status' => false,
            'message' => 'Geçersiz bir app_key gönderdiniz veya bu uygulama artık kullanımda değil.',
        ];
    }
}
