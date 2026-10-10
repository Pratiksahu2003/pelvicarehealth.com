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
        Schema::table('appointments', function (Blueprint $table) {
            $table->enum('session_type', ['home_visit', 'clinic_visit', 'video_session'])->default('clinic_visit')->after('appointment_time');
            $table->decimal('session_fee', 10, 2)->nullable()->after('session_type');
            $table->string('patient_address')->nullable()->after('session_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['session_type', 'session_fee', 'patient_address']);
        });
    }
};

