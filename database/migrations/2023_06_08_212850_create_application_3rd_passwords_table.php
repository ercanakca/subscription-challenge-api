<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('application_3rd_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('application_key')->index();
            $table->string('username', 15);
            $table->string('password', 15);
            $table->string('api', 10);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_3rd_passwords');
    }
};
