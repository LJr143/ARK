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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('reminder_id')->unique();
            $table->string('title');
            $table->foreignId('category_id')->constrained('reminder_categories');
            $table->string('location');
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->datetime('start_datetime');
            $table->datetime('end_datetime');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->enum('status', ['upcoming', 'ended', 'archived'])->default('upcoming');
            $table->string('recipient_type')->default('public');
            $table->text('notification_methods')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
