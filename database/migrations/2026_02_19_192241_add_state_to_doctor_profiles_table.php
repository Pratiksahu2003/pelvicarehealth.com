<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add `state` column to doctor_profiles.
     *
     * - Stores the Indian State or Union Territory the doctor practises in.
     * - Uses nullable() so existing rows are not broken by the migration.
     *   After the migration you can back-fill from `city` if needed.
     * - Does NOT modify or remove any existing column.
     */
    public function up(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            // Added after `city` so the column order is logical.
            // nullable so existing doctor rows are not violated.
            $table->string('state', 100)->nullable()->after('city');
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn('state');
        });
    }
};
