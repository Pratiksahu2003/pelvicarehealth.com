<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('doctor_profiles', 'slug')) {
            Schema::table('doctor_profiles', function (Blueprint $table) {
                $table->string('slug')->nullable()->unique()->after('user_id');
            });
        }
        // Alter bio to longText for rich HTML (no doctrine/dbal)
        try {
            Schema::getConnection()->statement('ALTER TABLE doctor_profiles MODIFY bio LONGTEXT NULL');
        } catch (\Throwable $e) {
            // Ignore if already longText
        }
        // Backfill slug from users.name for existing rows where slug is null
        $rows = \DB::table('doctor_profiles')->join('users', 'users.id', '=', 'doctor_profiles.user_id')->select('doctor_profiles.id', 'users.name')->whereNull('doctor_profiles.slug')->get();
        $used = \DB::table('doctor_profiles')->whereNotNull('slug')->pluck('slug')->toArray();
        foreach ($rows as $row) {
            $base = Str::slug($row->name);
            $slug = $base;
            $n = 0;
            while (in_array($slug, $used, true)) {
                $n++;
                $slug = $base . '-' . $n;
            }
            $used[] = $slug;
            \DB::table('doctor_profiles')->where('id', $row->id)->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::getConnection()->statement('ALTER TABLE doctor_profiles MODIFY bio TEXT NULL');
    }
};
