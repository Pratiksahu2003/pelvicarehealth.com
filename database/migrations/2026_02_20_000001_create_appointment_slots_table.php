<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('slot_time');
            $table->boolean('is_booked')->default(false);
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->onDelete('set null');
            $table->timestamps();

            // Prevent duplicate slots for the same doctor/date/time
            $table->unique(['doctor_id', 'appointment_date', 'slot_time']);
            $table->index(['doctor_id', 'appointment_date', 'is_booked']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_slots');
    }
};
