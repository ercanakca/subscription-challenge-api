<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Application::create(
            [
                'name' => 'Uygulama 1',
                'app_key' => 'ABCDEFGHIJ',
                'is_active' => true,
            ]
        );
        Application::create(
            [
                'name' => 'Uygulama 2',
                'app_key' => '0123456789',
                'is_active' => true,
            ]
        );
    }
}
