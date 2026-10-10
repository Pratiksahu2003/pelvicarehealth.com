<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::getConnection()->statement('ALTER TABLE service_subcategories MODIFY description LONGTEXT NULL');
    }

    public function down(): void
    {
        Schema::getConnection()->statement('ALTER TABLE service_subcategories MODIFY description TEXT NULL');
    }
};
