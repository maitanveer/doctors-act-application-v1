<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'application_id',
        'full_name',
        'dob',
        'gender',
        'citizenship',
        'passport',
        'email',
        'phone',
        'country_code',
        'address',
        'visa_status',
        'other_visa_text',
        'degree',
        'other_degree',
        'medical_school',
        'school_country',
        'graduation_year',
        'ecfmg',
        'license_country',
        'license_number',
        'issue_date',
        'expiry_date',
        'licensure_status',
        'disciplinary',
        'pathway',
        'residency',
        'residency_institution',
        'residency_from',
        'residency_to',
        'post_residency_years',
        'total_practice_years',
        'step1',
        'step2',
        'jurisprudence',
        'english',
        'job_offer',
        'employer_name',
        'facility_type',
        'employer_address',
        'contact_person',
        'designation',
        'contact_phone',
        'contact_email',
        'security_risk',
        'itar',
        'criminal',
        'military',
        'misconduct',
        'investigations',
        'applicant_signature',
        'signature_date',
        'upload_document',
        'doc_passport',
        'doc_diploma',
        'doc_transcripts',
        'doc_ecfmg',
        'doc_foreign_license',
        'doc_good_standing',
        'doc_disciplinary',
        'doc_residency',
        'doc_experience',
        'doc_usmle1',
        'doc_usmle2',
        'doc_jurisprudence',
        'doc_english',
        'doc_job_offer',
        'doc_contract',
        'doc_criminal',
        'doc_police_clearance',
        'doc_military',
        'status',
        'ip_address',
        'user_agent',
        'submission_date',
        'admin_notes',
        'rejection_reason',
        'document_request_pending',
        'requested_fields',
        'request_message',
        'objected_fields',
        'objection_message',
        'objection_pending',
        'status_updated_at',
        'updated_by'
    ];

    protected $casts = [
        'dob' => 'date',
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'residency_from' => 'date',
        'residency_to' => 'date',
        'signature_date' => 'date',
        'submission_date' => 'datetime',
        'status_updated_at' => 'datetime',
        'graduation_year' => 'integer',
        'post_residency_years' => 'integer',
        'total_practice_years' => 'integer',
        'document_request_pending' => 'boolean',
    ];

    /**
     * Get the user who last updated this application
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get requested fields as array
     */
    public function getRequestedFieldsArrayAttribute()
    {
        return $this->requested_fields ? json_decode($this->requested_fields, true) : [];
    }

    /**
     * Set requested fields from array
     */
    public function setRequestedFieldsArrayAttribute($value)
    {
        $this->attributes['requested_fields'] = json_encode($value);
    }
}

