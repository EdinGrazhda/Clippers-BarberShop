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
        Schema::table('barbers', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('experience_years')->default(0);
            $table->json('specialties')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barbers', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone', 'experience_years', 'specialties', 'is_active']);
        });
    }
};
