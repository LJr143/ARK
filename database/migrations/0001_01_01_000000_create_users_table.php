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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Personal Information
            $table->string('family_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->enum('sex', ['Male', 'Female', 'Other'])->nullable();
            $table->enum('civil_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->text('permanent_address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('mobile');
            $table->string('facebook_id')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('skype_id')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            //Login Details
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->longText('google_id')->nullable();
            $table->string('temp_password')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamp('credentials_sent_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('force_password_change')->default(true);

            // Professional Information
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_telephone')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('designation')->nullable();
            $table->string('school_graduated')->nullable();
            $table->integer('year_graduated')->nullable();
            $table->string('honors')->nullable();
            $table->string('post_graduate_school')->nullable();
            $table->integer('post_graduate_year')->nullable();
            $table->string('post_graduate_honors')->nullable();
            $table->text('special_courses')->nullable();
            $table->text('awards')->nullable();

            // PRC Information
            $table->string('prc_registration_number');
            $table->date('prc_date_issued')->nullable();
            $table->date('prc_valid_until')->nullable();

            // Expertise Information
            $table->text('expertise')->nullable();
            $table->integer('years_of_practice')->nullable();
            $table->string('practice_type')->nullable();
            $table->text('services_rendered')->nullable();

            // CPE/CPD Information
            $table->text('cpe_seminars_attended')->nullable();

            // Membership Information
            $table->string('current_chapter')->nullable();
            $table->string('previous_chapter')->nullable();
            $table->text('positions_held')->nullable();

            // Status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('remarks')->nullable();

            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
