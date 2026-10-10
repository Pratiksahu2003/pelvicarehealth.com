<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Allow guest (unauthenticated) users to book appointments.
     * patient_id will be null for guest bookings; guest info stored in separate columns.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Make patient_id nullable to support guest bookings
            $table->foreignId('patient_id')->nullable()->change();

            // Guest fields
            $table->string('guest_name')->nullable()->after('doctor_notes');
            $table->string('guest_phone')->nullable()->after('guest_name');
            $table->string('guest_email')->nullable()->after('guest_phone');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('patient_id')->nullable(false)->change();
            $table->dropColumn(['guest_name', 'guest_phone', 'guest_email']);
        });
    }
};
