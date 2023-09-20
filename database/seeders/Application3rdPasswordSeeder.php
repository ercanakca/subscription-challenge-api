<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Application3rdPassword;
use Illuminate\Database\Seeder;

class Application3rdPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $applications = Application::all();
        foreach ($applications as $application) {
            Application3rdPassword::create([
                'application_key' => $application->app_key,
                'username' => 'apple',
                'password' => 123456,
                'api' => 'apple',
            ]);
            Application3rdPassword::create([
                'application_key' => $application->app_key,
                'username' => 'google',
                'password' => 123456,
                'api' => 'google',
            ]);
        }
    }
}
