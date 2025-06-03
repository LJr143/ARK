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
        Schema::create('fiscal_years', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "FY 2025-2026"
            $table->date('start_date'); // e.g., 2025-07-01
            $table->date('end_date');   // e.g., 2026-06-30
            $table->decimal('membership_fee', 10, 2);
            $table->decimal('late_penalty_rate', 5, 2)->default(0); // Percentage
            $table->integer('grace_period_days')->default(30); // Days after due date before penalty applies
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->unique(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscal_years');
    }
};
