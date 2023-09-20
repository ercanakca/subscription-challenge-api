<?php

namespace App\Console\Commands;

use App\Models\ApplicationClient;
use App\Services\AuthService;
use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class GenerateFakeDataCommand extends Command
{
    protected $signature = 'app:generate-fake-data-command';

    protected $description = 'Veritabanında test için kayıt oluşturur.';

    public function handle(AuthService $authService, SubscriptionService $subscriptionService)
    {
        // Sahte bir cihaz kaydı oluşturarak 2 uygulamamızdan 1 tanesini kullanmasını sağlıyoruz..
        $applications = ['0123456789', 'ABCDEFGHIJ'];
        $devices = ['IOS', 'ANDROID'];

        for ($i = 0; $i < 500; $i++) {
            $client = $authService->register(
                $applications[array_rand($applications)],
                $devices[array_rand($devices)],
                fake()->numberBetween(1111111111, 9999999999),
                'tr-TR',
            );

            // Sahte kullanıcımıza 0 ile 2 tane arasında satış yapıyoruz
            for ($j = 0; $j < rand(0, 7); $j++) {

                // AuthService içindeki register sonucunda ApplicationToken instance geri döndürebilirdik. Bu servis şu anda
                // bana gerekli olan ApplicationClient intance döndürmediği için mecburen bir sorgu ile tekrar veritabanından
                // aldık. register methodu zaten amacı gereği ApplicationClient intance döndüremeyeceği için orada düzenleme
                // yapmak yerine burada +1 mysql query çalıştırmayı bilerek göze aldık. Burası sadece demo data doldurduğu için
                // ve bizim de mysql tarafının yük altında çalışmasını test ettiğimiz için +1 sorgu test amacımıza uygun şekilde
                // işimize geliyor ve mysql'i yoruyor.

                $application_client = ApplicationClient::select(['app_id', 'device_os', 'client_token'])->where(['client_token' => $client['client_token']])->first();
                $receipt = fake()->numberBetween(1111111111, 9999999999);

                $subscription_register = $subscriptionService->register($application_client->app_id, $application_client->device_os, (string) $receipt);
                dump($subscription_register);
                $subscriptionService->create($client['client_token'], $receipt, $application_client, $subscription_register);
            }
        }
    }
}
