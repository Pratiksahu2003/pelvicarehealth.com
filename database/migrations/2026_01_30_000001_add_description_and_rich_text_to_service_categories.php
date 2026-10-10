<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->longText('description')->nullable()->after('short_description');
        });

        // Change short_description to TEXT so it can store HTML from TinyMCE
        Schema::getConnection()->statement('ALTER TABLE service_categories MODIFY short_description TEXT NULL');
    }

    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn('description');
        });
        Schema::getConnection()->statement('ALTER TABLE service_categories MODIFY short_description VARCHAR(255) NULL');
    }
};
