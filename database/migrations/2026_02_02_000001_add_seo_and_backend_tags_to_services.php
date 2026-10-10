<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('is_active');
            $table->string('meta_description', 500)->nullable()->after('meta_title');
            $table->string('meta_keywords', 500)->nullable()->after('meta_description');
            $table->json('backend_tags')->nullable()->after('meta_keywords')->comment('Specializations for filtering e.g. Pelvic floor rehab, Women\'s health physio');
        });

        Schema::table('service_subcategories', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('is_active');
            $table->string('meta_description', 500)->nullable()->after('meta_title');
            $table->string('meta_keywords', 500)->nullable()->after('meta_description');
        });
    }

    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords', 'backend_tags']);
        });
        Schema::table('service_subcategories', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords']);
        });
    }
};
