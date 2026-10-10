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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->string('slug')->unique()->after('title');
            $table->text('excerpt')->nullable()->after('slug');
            $table->longText('content')->after('excerpt');
            $table->string('featured_image')->nullable()->after('content');
            $table->boolean('is_published')->default(false)->after('featured_image');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade')->after('is_published');
            $table->timestamp('published_at')->nullable()->after('author_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['title', 'slug', 'excerpt', 'content', 'featured_image', 'is_published', 'author_id', 'published_at']);
        });
    }
};

