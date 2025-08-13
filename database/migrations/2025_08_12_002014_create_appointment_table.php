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
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barber_id');
            $table->dateTime('appointment_time');
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('notes')->nullable();
            $table->foreign('barber_id')->references('id')->on('barbers')->onDelete('cascade');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
