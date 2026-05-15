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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->string('type'); // oil_change, tire_rotation, brake_service, inspection, repair, etc.
            $table->date('date');
            $table->decimal('cost', 8, 2);
            $table->date('next_due')->nullable();
            $table->integer('next_due_km')->nullable();
            $table->text('remarks')->nullable();
              $table->string('service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
