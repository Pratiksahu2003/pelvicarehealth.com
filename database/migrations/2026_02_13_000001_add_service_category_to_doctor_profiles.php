<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->foreignId('service_category_id')->nullable()->after('languages')->constrained('service_categories')->onDelete('set null');
            $table->foreignId('service_subcategory_id')->nullable()->after('service_category_id')->constrained('service_subcategories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropForeign(['service_category_id']);
            $table->dropForeign(['service_subcategory_id']);
        });
    }
};
