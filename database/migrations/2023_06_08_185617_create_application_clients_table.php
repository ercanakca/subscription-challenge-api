<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('application_clients', function (Blueprint $table) {
            $table->id();
            $table->string('device_uid', 10);
            $table->string('app_id', 10)->index();
            $table->string('phone_number', 13)->nullable();
            $table->string('language', 5);
            $table->enum('device_os', ['IOS', 'ANDROID']);
            $table->string('client_token', 25)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
