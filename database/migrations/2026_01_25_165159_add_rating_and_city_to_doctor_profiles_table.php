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
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->decimal('rating', 3, 2)->default(0)->after('years_of_experience');
            $table->string('city')->nullable()->after('clinic_address');
            $table->string('profile_image')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn(['rating', 'city', 'profile_image']);
        });
    }
};
