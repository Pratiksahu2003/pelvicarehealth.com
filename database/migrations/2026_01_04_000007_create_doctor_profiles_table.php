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
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('years_of_experience')->default(0);
            $table->text('specializations')->nullable(); // JSON array
            $table->text('languages')->nullable(); // JSON array
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            $table->text('bio')->nullable();
            $table->string('clinic_name')->nullable();
            $table->text('clinic_address')->nullable();
            $table->decimal('home_visit_fee', 10, 2)->nullable();
            $table->decimal('clinic_visit_fee', 10, 2)->nullable();
            $table->decimal('video_session_fee', 10, 2)->nullable();
            $table->integer('slot_duration')->default(60); // in minutes
            $table->integer('max_patients_per_day')->default(10);
            $table->integer('buffer_time')->default(15); // in minutes
            $table->boolean('same_day_bookings')->default(true);
            $table->boolean('profile_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_profiles');
    }
};

