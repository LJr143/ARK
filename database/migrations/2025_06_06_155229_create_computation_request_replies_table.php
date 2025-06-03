<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('computation_request_replies', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->text('reply_message');
            $table->json('computation_data')->nullable();
            $table->enum('reply_type', ['approved', 'rejected', 'completed', 'info'])->default('info');
            $table->boolean('has_computation')->default(false);
            $table->boolean('is_empty_computation')->default(false);
            $table->timestamp('replied_at');
            $table->timestamps();

            $table->foreign('reference_number')->references('reference_number')->on('computation_requests')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');

            $table->index(['reference_number', 'replied_at']);
            $table->index(['member_id', 'replied_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('computation_request_replies');
    }
};
