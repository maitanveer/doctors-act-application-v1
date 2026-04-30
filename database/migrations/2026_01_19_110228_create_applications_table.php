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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->unique();
            
            // Personal Information
            $table->string('full_name');
            $table->date('dob');
            $table->string('gender', 20);
            $table->string('citizenship', 100);
            $table->string('passport', 100);
            $table->string('email');
            $table->string('phone', 20);
            $table->string('country_code', 10);
            $table->text('address')->nullable();
            $table->string('visa_status', 50);
            $table->string('other_visa_text', 100)->nullable();
            
            // Medical Education
            $table->string('degree');
            $table->string('other_degree')->nullable();
            $table->string('medical_school');
            $table->string('school_country', 100);
            $table->integer('graduation_year');
            $table->string('ecfmg', 10);
            
            // Foreign Medical Licensure
            $table->string('license_country', 100);
            $table->string('license_number', 100);
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('licensure_status', 50);
            $table->string('disciplinary', 20);
            
            // Postgraduate Training
            $table->string('pathway', 20);
            $table->string('residency', 10)->nullable();
            $table->string('residency_institution')->nullable();
            $table->date('residency_from')->nullable();
            $table->date('residency_to')->nullable();
            $table->integer('post_residency_years')->nullable();
            $table->integer('total_practice_years')->nullable();
            
            // Exam Requirements
            $table->string('step1', 20);
            $table->string('step2', 20);
            $table->string('jurisprudence', 20);
            $table->string('english', 50);
            
            // Employment in Texas
            $table->string('job_offer', 10);
            $table->string('employer_name')->nullable();
            $table->string('facility_type', 50)->nullable();
            $table->text('employer_address')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('designation', 100)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->string('contact_email')->nullable();
            
            // Security & Background Check
            $table->string('security_risk', 10);
            $table->string('itar', 10);
            $table->string('criminal', 20);
            $table->string('military', 20);
            $table->string('misconduct', 10)->nullable();
            $table->string('investigations', 10);
            
            // Applicant Attestation
            $table->string('applicant_signature');
            $table->date('signature_date');
            
            // Document uploads - storing filenames
            $table->string('upload_document')->nullable();
            $table->string('doc_passport')->nullable();
            $table->string('doc_diploma')->nullable();
            $table->string('doc_transcripts')->nullable();
            $table->string('doc_ecfmg')->nullable();
            $table->string('doc_foreign_license')->nullable();
            $table->string('doc_good_standing')->nullable();
            $table->string('doc_disciplinary')->nullable();
            $table->string('doc_residency')->nullable();
            $table->string('doc_experience')->nullable();
            $table->string('doc_usmle1')->nullable();
            $table->string('doc_usmle2')->nullable();
            $table->string('doc_jurisprudence')->nullable();
            $table->string('doc_english')->nullable();
            $table->string('doc_job_offer')->nullable();
            $table->string('doc_contract')->nullable();
            $table->string('doc_criminal')->nullable();
            $table->string('doc_police_clearance')->nullable();
            $table->string('doc_military')->nullable();
            
            // Metadata
            $table->string('status', 20)->default('submitted');
            $table->string('ip_address', 50)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('submission_date')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('email');
            $table->index('application_id');
            $table->index('status');
            $table->index('submission_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
