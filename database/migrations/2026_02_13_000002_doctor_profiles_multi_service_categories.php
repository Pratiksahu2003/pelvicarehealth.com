<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->json('service_category_ids')->nullable()->after('languages');
            $table->json('service_subcategory_ids')->nullable()->after('service_category_ids');
        });

        // Migrate existing single IDs to arrays
        $profiles = \DB::table('doctor_profiles')->whereNotNull('service_category_id')->get();
        foreach ($profiles as $p) {
            \DB::table('doctor_profiles')->where('id', $p->id)->update([
                'service_category_ids' => json_encode([(int) $p->service_category_id]),
            ]);
        }
        $profilesWithSub = \DB::table('doctor_profiles')->whereNotNull('service_subcategory_id')->get();
        foreach ($profilesWithSub as $p) {
            \DB::table('doctor_profiles')->where('id', $p->id)->update([
                'service_subcategory_ids' => json_encode([(int) $p->service_subcategory_id]),
            ]);
        }

        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropForeign(['service_category_id']);
            $table->dropForeign(['service_subcategory_id']);
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->foreignId('service_category_id')->nullable()->after('languages')->constrained('service_categories')->onDelete('set null');
            $table->foreignId('service_subcategory_id')->nullable()->after('service_category_id')->constrained('service_subcategories')->onDelete('set null');
        });

        // Restore first ID from arrays if present
        $profiles = \DB::table('doctor_profiles')->whereNotNull('service_category_ids')->get();
        foreach ($profiles as $p) {
            $ids = json_decode($p->service_category_ids, true);
            if (!empty($ids)) {
                \DB::table('doctor_profiles')->where('id', $p->id)->update(['service_category_id' => $ids[0]]);
            }
        }
        $profiles = \DB::table('doctor_profiles')->whereNotNull('service_subcategory_ids')->get();
        foreach ($profiles as $p) {
            $ids = json_decode($p->service_subcategory_ids, true);
            if (!empty($ids)) {
                \DB::table('doctor_profiles')->where('id', $p->id)->update(['service_subcategory_id' => $ids[0]]);
            }
        }

        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn(['service_category_ids', 'service_subcategory_ids']);
        });
    }
};
