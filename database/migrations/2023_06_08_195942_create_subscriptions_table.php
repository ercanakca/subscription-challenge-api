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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('application_client_id', 50);
            $table->string('app_id', 10)->index();
            $table->string('hash', 50)->index();
            $table->boolean('status')->index();
            $table->timestamp('created_at');
            $table->enum('device_os', ['IOS', 'ANDROID']);
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expire_date')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
