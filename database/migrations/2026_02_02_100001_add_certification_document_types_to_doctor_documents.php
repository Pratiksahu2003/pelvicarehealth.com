<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Add optional certification document types for doctor registration.
     */
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }
        DB::statement("ALTER TABLE doctor_documents MODIFY COLUMN document_type ENUM(
            'degree_certificate',
            'council_registration',
            'government_id',
            'iap_membership',
            'clinic_proof',
            'certified_womens_health_physiotherapy',
            'certified_reproductive_health_therapist',
            'certified_pelvic_floor_rehab_therapist',
            'certified_pregnancy_postnatal_rehab_therapist',
            'certified_lactation_counselor'
        ) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }
        DB::statement("ALTER TABLE doctor_documents MODIFY COLUMN document_type ENUM(
            'degree_certificate',
            'council_registration',
            'iap_membership',
            'government_id',
            'clinic_proof'
        ) NULL");
    }
};
