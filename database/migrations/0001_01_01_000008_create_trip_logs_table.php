<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trip_logs', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle');
            $table->string('driver');
            $table->string('destination');
            $table->string('purpose');
            $table->dateTime('departure');
            $table->dateTime('return')->nullable();
            $table->integer('odometer_start')->default(0);
            $table->integer('odometer_end')->default(0);
            $table->integer('distance')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trip_logs');
    }
};
