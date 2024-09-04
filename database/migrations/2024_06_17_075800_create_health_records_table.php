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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->integer('systolic_pressure')->nullable();
            $table->integer('diastolic_pressure')->nullable();
            $table->decimal('blood_sugar', 5, 2)->nullable();
            $table->decimal('cholesterol', 5, 2)->nullable();
            $table->decimal('temperature', 4, 2)->nullable();
            $table->integer('pulse')->nullable();
            $table->date('lastTestedDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};