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
        Schema::create('doctor_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->enum('document_type', ['degree_certificate', 'council_registration', 'iap_membership', 'government_id', 'clinic_proof'])->nullable();
            $table->string('file_path');
            $table->string('file_name')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_documents');
    }
};

