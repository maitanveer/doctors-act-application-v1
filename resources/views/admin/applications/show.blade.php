@extends('layouts.admin')

@section('title', 'Application Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary mb-2">
            <i class="fa fa-arrow-left"></i> Back to List
        </a>
        <h1>Application Details</h1>
        <p class="text-muted">ID: <code>{{ $application->application_id }}</code></p>
    </div>
    <div>
        <span class="badge badge-{{$application->status==='approved'?'success':($application->status==='rejected'?'danger':'warning')}}" style="font-size:1.1rem;padding:10px 20px;">
            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
        </span>
    </div>
</div>

<!-- Quick Actions -->
<div class="stat-card mb-4">
    <div class="d-flex justify-content-between">
        <h5>Quick Actions</h5>
        <div>
            @if(auth()->user()->isSuperAdmin())
            <a href="{{ route('admin.applications.edit', $application->id) }}" class="btn btn-primary">
                <i class="fa fa-edit"></i> Edit
            </a>
            @endif
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-download"></i> Export
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('admin.applications.export-pdf', $application->id) }}">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </a>
                </div>
            </div>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#requestDocsModal">
                <i class="fa fa-exclamation-circle"></i> Request Objected Docs
            </button>
            <form action="{{ route('admin.applications.destroy', $application->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this application?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
</div>

<!-- Status Update -->
<div class="stat-card mb-4">
    <h5 class="mb-3">Update Status</h5>
    <form action="{{ route('admin.applications.update-status', $application->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <select name="status" class="form-control" id="statusSelect" required>
                    <option value="submitted" {{$application->status==='submitted'?'selected':''}}>Submitted</option>
                    <option value="under_review" {{$application->status==='under_review'?'selected':''}}>Under Review</option>
                    <option value="approved" {{$application->status==='approved'?'selected':''}}>Approved</option>
                    <option value="rejected" {{$application->status==='rejected'?'selected':''}}>Rejected</option>
                </select>
            </div>
            <div class="col-md-9">
                <textarea name="notes" class="form-control" rows="2" placeholder="Admin notes...">{{$application->admin_notes}}</textarea>
            </div>
        </div>
        <div id="rejectionReasonDiv" style="display:{{$application->status==='rejected'?'block':'none'}};">
            <div class="form-group mt-3">
                <label>Rejection Reason <span class="text-danger">*</span></label>
                <textarea name="rejection_reason" class="form-control" rows="3">{{$application->rejection_reason}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">
            <i class="fa fa-save"></i> Update & Send Email
        </button>
    </form>
</div>

<!-- Personal Information -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-user"></i> Personal Information</h5>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Full Name:</strong> {{$application->full_name}}</p>
            <p><strong>Date of Birth:</strong> {{$application->dob->format('M d, Y')}}</p>
            <p><strong>Gender:</strong> {{$application->gender}}</p>
            <p><strong>Citizenship:</strong> {{$application->citizenship}}</p>
            <p><strong>Passport:</strong> {{$application->passport}}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Email:</strong> <a href="mailto:{{$application->email}}">{{$application->email}}</a></p>
            <p><strong>Phone:</strong> {{$application->country_code}} {{$application->phone}}</p>
            <p><strong>Address:</strong> {{$application->address ?? 'N/A'}}</p>
            <p><strong>Visa Status:</strong> {{$application->visa_status}}</p>
            @if($application->other_visa_text)
            <p><strong>Other Visa:</strong> {{$application->other_visa_text}}</p>
            @endif
        </div>
    </div>
</div>

<!-- Medical Education -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-graduation-cap"></i> Medical Education</h5>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Degree:</strong> {{$application->degree}}</p>
            @if($application->other_degree)
            <p><strong>Other Degree:</strong> {{$application->other_degree}}</p>
            @endif
            <p><strong>Medical School:</strong> {{$application->medical_school}}</p>
            <p><strong>School Country:</strong> {{$application->school_country}}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Graduation Year:</strong> {{$application->graduation_year}}</p>
            <p><strong>ECFMG Certified:</strong> <span class="badge badge-{{$application->ecfmg==='Yes'?'success':'secondary'}}">{{$application->ecfmg}}</span></p>
        </div>
    </div>
</div>

<!-- Foreign Medical Licensure -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-certificate"></i> Foreign Medical Licensure</h5>
    <div class="row">
        <div class="col-md-6">
            <p><strong>License Country:</strong> {{$application->license_country}}</p>
            <p><strong>License Number:</strong> {{$application->license_number}}</p>
            <p><strong>Issue Date:</strong> {{$application->issue_date->format('M d, Y')}}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Expiry Date:</strong> {{$application->expiry_date->format('M d, Y')}}</p>
            <p><strong>Status:</strong> <span class="badge badge-{{$application->licensure_status==='Active'?'success':'warning'}}">{{$application->licensure_status}}</span></p>
            <p><strong>Disciplinary Action:</strong> <span class="badge badge-{{$application->disciplinary==='No'?'success':'danger'}}">{{$application->disciplinary}}</span></p>
        </div>
    </div>
</div>

<!-- Postgraduate Training -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-hospital-o"></i> Postgraduate Training & Experience</h5>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Pathway:</strong> {{$application->pathway}}</p>
            <p><strong>Completed Residency:</strong> <span class="badge badge-{{$application->residency==='Yes'?'success':'secondary'}}">{{$application->residency ?? 'N/A'}}</span></p>
            @if($application->residency === 'Yes')
            <p><strong>Residency Institution:</strong> {{$application->residency_institution ?? 'N/A'}}</p>
            <p><strong>Residency Duration:</strong> 
                @if($application->residency_from && $application->residency_to)
                {{$application->residency_from->format('M Y')}} - {{$application->residency_to->format('M Y')}}
                @else
                N/A
                @endif
            </p>
            @endif
        </div>
        <div class="col-md-6">
            <p><strong>Post-Residency Years:</strong> {{$application->post_residency_years ?? 'N/A'}}</p>
            <p><strong>Total Practice Years:</strong> {{$application->total_practice_years ?? 'N/A'}}</p>
        </div>
    </div>
</div>

<!-- Exam Requirements -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-file-text-o"></i> Exam Requirements</h5>
    <div class="row">
        <div class="col-md-3">
            <p><strong>USMLE Step 1:</strong></p>
            <span class="badge badge-{{$application->step1==='Passed'?'success':($application->step1==='Failed'?'danger':'secondary')}}">{{$application->step1}}</span>
        </div>
        <div class="col-md-3">
            <p><strong>USMLE Step 2:</strong></p>
            <span class="badge badge-{{$application->step2==='Passed'?'success':($application->step2==='Failed'?'danger':'secondary')}}">{{$application->step2}}</span>
        </div>
        <div class="col-md-3">
            <p><strong>Jurisprudence:</strong></p>
            <span class="badge badge-{{$application->jurisprudence==='Passed'?'success':($application->jurisprudence==='Failed'?'danger':'secondary')}}">{{$application->jurisprudence}}</span>
        </div>
        <div class="col-md-3">
            <p><strong>English Proficiency:</strong></p>
            <span class="badge badge-info">{{$application->english}}</span>
        </div>
    </div>
</div>

<!-- Employment in Texas -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-building"></i> Employment in Texas</h5>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Job Offer:</strong> <span class="badge badge-{{$application->job_offer==='Yes'?'success':'secondary'}}">{{$application->job_offer}}</span></p>
            @if($application->job_offer === 'Yes')
            <p><strong>Employer Name:</strong> {{$application->employer_name ?? 'N/A'}}</p>
            <p><strong>Facility Type:</strong> {{$application->facility_type ?? 'N/A'}}</p>
            <p><strong>Employer Address:</strong> {{$application->employer_address ?? 'N/A'}}</p>
            @endif
        </div>
        <div class="col-md-6">
            @if($application->job_offer === 'Yes')
            <p><strong>Contact Person:</strong> {{$application->contact_person ?? 'N/A'}}</p>
            <p><strong>Designation:</strong> {{$application->designation ?? 'N/A'}}</p>
            <p><strong>Contact Phone:</strong> {{$application->contact_phone ?? 'N/A'}}</p>
            <p><strong>Contact Email:</strong> 
                @if($application->contact_email)
                <a href="mailto:{{$application->contact_email}}">{{$application->contact_email}}</a>
                @else
                N/A
                @endif
            </p>
            @endif
        </div>
    </div>
</div>

<!-- Security & Background Check -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-shield"></i> Security & Background Check</h5>
    <div class="row">
        <div class="col-md-4">
            <p><strong>Security Risk:</strong> <span class="badge badge-{{$application->security_risk==='No'?'success':'danger'}}">{{$application->security_risk}}</span></p>
            <p><strong>ITAR Restricted:</strong> <span class="badge badge-{{$application->itar==='No'?'success':'danger'}}">{{$application->itar}}</span></p>
        </div>
        <div class="col-md-4">
            <p><strong>Criminal Record:</strong> <span class="badge badge-{{$application->criminal==='No'?'success':'warning'}}">{{$application->criminal}}</span></p>
            <p><strong>Military Service:</strong> <span class="badge badge-info">{{$application->military}}</span></p>
        </div>
        <div class="col-md-4">
            <p><strong>Professional Misconduct:</strong> <span class="badge badge-{{$application->misconduct==='No'?'success':'danger'}}">{{$application->misconduct ?? 'N/A'}}</span></p>
            <p><strong>Under Investigation:</strong> <span class="badge badge-{{$application->investigations==='No'?'success':'danger'}}">{{$application->investigations}}</span></p>
        </div>
    </div>
</div>

<!-- Uploaded Documents -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-files-o"></i> Uploaded Documents</h5>
    <div class="row">
        <div class="col-md-6">
            <ul class="list-unstyled">
                <li>
                    <i class="fa fa-{{$application->upload_document?'check text-success':'times text-danger'}}"></i> 
                    <strong>Application Document:</strong> {{$application->upload_document ? basename($application->upload_document) : 'Not uploaded'}}
                    @if($application->upload_document)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'upload_document']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_passport?'check text-success':'times text-danger'}}"></i> 
                    <strong>Passport:</strong> {{$application->doc_passport ? basename($application->doc_passport) : 'Not uploaded'}}
                    @if($application->doc_passport)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_passport']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_diploma?'check text-success':'times text-danger'}}"></i> 
                    <strong>Diploma:</strong> {{$application->doc_diploma ? basename($application->doc_diploma) : 'Not uploaded'}}
                    @if($application->doc_diploma)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_diploma']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_transcripts?'check text-success':'times text-danger'}}"></i> 
                    <strong>Transcripts:</strong> {{$application->doc_transcripts ? basename($application->doc_transcripts) : 'Not uploaded'}}
                    @if($application->doc_transcripts)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_transcripts']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_ecfmg?'check text-success':'times text-danger'}}"></i> 
                    <strong>ECFMG Certificate:</strong> {{$application->doc_ecfmg ? basename($application->doc_ecfmg) : 'Not uploaded'}}
                    @if($application->doc_ecfmg)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_ecfmg']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_foreign_license?'check text-success':'times text-danger'}}"></i> 
                    <strong>Foreign License:</strong> {{$application->doc_foreign_license ? basename($application->doc_foreign_license) : 'Not uploaded'}}
                    @if($application->doc_foreign_license)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_foreign_license']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_good_standing?'check text-success':'times text-danger'}}"></i> 
                    <strong>Good Standing:</strong> {{$application->doc_good_standing ? basename($application->doc_good_standing) : 'Not uploaded'}}
                    @if($application->doc_good_standing)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_good_standing']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_disciplinary?'check text-success':'times text-danger'}}"></i> 
                    <strong>Disciplinary Records:</strong> {{$application->doc_disciplinary ? basename($application->doc_disciplinary) : 'Not uploaded'}}
                    @if($application->doc_disciplinary)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_disciplinary']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_residency?'check text-success':'times text-danger'}}"></i> 
                    <strong>Residency Certificate:</strong> {{$application->doc_residency ? basename($application->doc_residency) : 'Not uploaded'}}
                    @if($application->doc_residency)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_residency']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_experience?'check text-success':'times text-danger'}}"></i> 
                    <strong>Experience Letters:</strong> {{$application->doc_experience ? basename($application->doc_experience) : 'Not uploaded'}}
                    @if($application->doc_experience)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_experience']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <ul class="list-unstyled">
                <li>
                    <i class="fa fa-{{$application->doc_usmle1?'check text-success':'times text-danger'}}"></i> 
                    <strong>USMLE Step 1:</strong> {{$application->doc_usmle1 ? basename($application->doc_usmle1) : 'Not uploaded'}}
                    @if($application->doc_usmle1)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_usmle1']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_usmle2?'check text-success':'times text-danger'}}"></i> 
                    <strong>USMLE Step 2:</strong> {{$application->doc_usmle2 ? basename($application->doc_usmle2) : 'Not uploaded'}}
                    @if($application->doc_usmle2)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_usmle2']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_jurisprudence?'check text-success':'times text-danger'}}"></i> 
                    <strong>Jurisprudence Exam:</strong> {{$application->doc_jurisprudence ? basename($application->doc_jurisprudence) : 'Not uploaded'}}
                    @if($application->doc_jurisprudence)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_jurisprudence']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_english?'check text-success':'times text-danger'}}"></i> 
                    <strong>English Proficiency:</strong> {{$application->doc_english ? basename($application->doc_english) : 'Not uploaded'}}
                    @if($application->doc_english)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_english']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_job_offer?'check text-success':'times text-danger'}}"></i> 
                    <strong>Job Offer Letter:</strong> {{$application->doc_job_offer ? basename($application->doc_job_offer) : 'Not uploaded'}}
                    @if($application->doc_job_offer)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_job_offer']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_contract?'check text-success':'times text-danger'}}"></i> 
                    <strong>Employment Contract:</strong> {{$application->doc_contract ? basename($application->doc_contract) : 'Not uploaded'}}
                    @if($application->doc_contract)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_contract']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_criminal?'check text-success':'times text-danger'}}"></i> 
                    <strong>Criminal Background:</strong> {{$application->doc_criminal ? basename($application->doc_criminal) : 'Not uploaded'}}
                    @if($application->doc_criminal)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_criminal']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_police_clearance?'check text-success':'times text-danger'}}"></i> 
                    <strong>Police Clearance:</strong> {{$application->doc_police_clearance ? basename($application->doc_police_clearance) : 'Not uploaded'}}
                    @if($application->doc_police_clearance)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_police_clearance']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
                <li>
                    <i class="fa fa-{{$application->doc_military?'check text-success':'times text-danger'}}"></i> 
                    <strong>Military Records:</strong> {{$application->doc_military ? basename($application->doc_military) : 'Not uploaded'}}
                    @if($application->doc_military)
                        <a href="{{ route('admin.applications.download-document', [$application->id, 'doc_military']) }}" class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Attestation & Submission Info -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-pencil-square-o"></i> Applicant Attestation & Submission</h5>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Applicant Signature:</strong> {{$application->applicant_signature}}</p>
            <p><strong>Signature Date:</strong> {{$application->signature_date->format('M d, Y')}}</p>
            <p><strong>Submission Date:</strong> {{$application->submission_date ? $application->submission_date->format('M d, Y H:i:s') : 'N/A'}}</p>
        </div>
        <div class="col-md-6">
            <p><strong>IP Address:</strong> {{$application->ip_address ?? 'N/A'}}</p>
            <p><strong>User Agent:</strong> <small>{{$application->user_agent ?? 'N/A'}}</small></p>
        </div>
    </div>
</div>

@if($application->admin_notes || $application->rejection_reason)
<!-- Admin Notes & Actions -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-sticky-note"></i> Admin Notes & Actions</h5>
    @if($application->admin_notes)
    <div class="alert alert-info">
        <strong>Admin Notes:</strong><br>
        {{$application->admin_notes}}
    </div>
    @endif
    @if($application->rejection_reason)
    <div class="alert alert-danger">
        <strong>Rejection Reason:</strong><br>
        {{$application->rejection_reason}}
    </div>
    @endif
    @if($application->status_updated_at)
    <p><small class="text-muted">Last updated: {{$application->status_updated_at->format('M d, Y H:i:s')}}
        @if($application->updatedBy)
        by {{$application->updatedBy->name}}
        @endif
    </small></p>
    @endif
</div>
@endif

@if($application->document_request_pending)
<!-- Document Request Info -->
<div class="stat-card mb-4">
    <h5><i class="fa fa-exclamation-triangle text-warning"></i> Document Request Pending</h5>
    <div class="alert alert-warning">
        <p><strong>Requested Documents:</strong></p>
        <ul>
            @foreach(json_decode($application->requested_fields ?? '[]', true) as $field)
            <li>{{ str_replace(['doc_', '_'], ['', ' '], ucfirst($field)) }}</li>
            @endforeach
        </ul>
        @if($application->request_message)
        <p><strong>Message to Applicant:</strong><br>{{$application->request_message}}</p>
        @endif
    </div>
</div>
@endif

<!-- Request Documents Modal -->
<div class="modal fade" id="requestDocsModal">
    <div class="modal-dialog modal-xl" style="max-width: 90%; margin: 30px auto;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
            <form action="{{ route('admin.applications.request-documents', $application->id) }}" method="POST">
                @csrf
                <div class="modal-header" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; padding: 20px 30px; border-radius: 12px 12px 0 0;">
                    <div>
                        <h4 style="margin: 0; font-weight: 600;">⚠️ Request Objected Documents</h4>
                        <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">Select fields and documents that need correction or resubmission</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1; font-size: 32px;">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0; max-height: 70vh; overflow-y: auto;">
                    <div style="padding: 25px 30px;">
                        <div class="alert alert-info" style="background: #e3f2fd; border-left: 4px solid #2196f3; margin-bottom: 25px;">
                            <strong>💡 Tip:</strong> Select only the fields that require correction. The applicant will receive an email with instructions to update these specific fields.
                        </div>

                        <!-- Personal Information -->
                        <div class="field-section" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #0054a4;">
                            <h5 style="color: #0054a4; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fa fa-user" style="margin-right: 8px;"></i> Personal Information
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="full_name"> <span>Full Name</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="dob"> <span>Date of Birth</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="gender"> <span>Gender</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="citizenship"> <span>Citizenship</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="passport"> <span>Passport Number</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="email"> <span>Email</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="phone"> <span>Phone</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="country_code"> <span>Country Code</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="address"> <span>Address</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="visa_status"> <span>Visa Status</span></label></div>
                            </div>
                        </div>

                        <!-- Medical Education -->
                        <div class="field-section" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #28a745;">
                            <h5 style="color: #28a745; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fa fa-graduation-cap" style="margin-right: 8px;"></i> Medical Education
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="degree"> <span>Degree</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="other_degree"> <span>Other Degree</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="medical_school"> <span>Medical School</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="school_country"> <span>School Country</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="graduation_year"> <span>Graduation Year</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="ecfmg"> <span>ECFMG Status</span></label></div>
                            </div>
                        </div>

                        <!-- Foreign Medical Licensure -->
                        <div class="field-section" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #6f42c1;">
                            <h5 style="color: #6f42c1; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fa fa-certificate" style="margin-right: 8px;"></i> Foreign Medical Licensure
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="license_country"> <span>License Country</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="license_number"> <span>License Number</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="issue_date"> <span>Issue Date</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="expiry_date"> <span>Expiry Date</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="licensure_status"> <span>Licensure Status</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="disciplinary"> <span>Disciplinary Action</span></label></div>
                            </div>
                        </div>

                        <!-- Postgraduate Training -->
                        <div class="field-section" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #17a2b8;">
                            <h5 style="color: #17a2b8; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fa fa-hospital-o" style="margin-right: 8px;"></i> Postgraduate Training
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="pathway"> <span>Pathway</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="residency"> <span>Completed Residency</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="residency_institution"> <span>Residency Institution</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="residency_from"> <span>Residency From</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="residency_to"> <span>Residency To</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="post_residency_years"> <span>Post-Residency Years</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="total_practice_years"> <span>Total Practice Years</span></label></div>
                            </div>
                        </div>

                        <!-- Exam Requirements -->
                        <div class="field-section" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #fd7e14;">
                            <h5 style="color: #fd7e14; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fa fa-file-text-o" style="margin-right: 8px;"></i> Exam Requirements
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="step1"> <span>USMLE Step 1</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="step2"> <span>USMLE Step 2</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="jurisprudence"> <span>Jurisprudence</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="english"> <span>English Proficiency</span></label></div>
                            </div>
                        </div>

                        <!-- Employment in Texas -->
                        <div class="field-section" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #20c997;">
                            <h5 style="color: #20c997; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fa fa-building" style="margin-right: 8px;"></i> Employment in Texas
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="job_offer"> <span>Job Offer</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="employer_name"> <span>Employer Name</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="facility_type"> <span>Facility Type</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="employer_address"> <span>Employer Address</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="contact_person"> <span>Contact Person</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="designation"> <span>Designation</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="contact_phone"> <span>Contact Phone</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="contact_email"> <span>Contact Email</span></label></div>
                            </div>
                        </div>

                        <!-- Security & Background Check -->
                        <div class="field-section" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #dc3545;">
                            <h5 style="color: #dc3545; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fa fa-shield" style="margin-right: 8px;"></i> Security & Background Check
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="security_risk"> <span>Security Risk</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="itar"> <span>ITAR Restricted</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="criminal"> <span>Criminal Record</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="military"> <span>Military Service</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="misconduct"> <span>Professional Misconduct</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="investigations"> <span>Under Investigation</span></label></div>
                            </div>
                        </div>

                        <!-- Attestation -->
                        <div class="field-section" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #6c757d;">
                            <h5 style="color: #6c757d; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fa fa-pencil-square-o" style="margin-right: 8px;"></i> Attestation
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="applicant_signature"> <span>Applicant Signature</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="signature_date"> <span>Signature Date</span></label></div>
                            </div>
                        </div>

                        <!-- Documents -->
                        <div class="field-section" style="background: #fff3cd; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #ffc107;">
                            <h5 style="color: #856404; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fa fa-paperclip" style="margin-right: 8px;"></i> Documents
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_passport"> <span>Passport Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_diploma"> <span>Diploma Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_transcripts"> <span>Transcripts Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_ecfmg"> <span>ECFMG Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_foreign_license"> <span>Foreign License Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_good_standing"> <span>Good Standing Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_disciplinary"> <span>Disciplinary Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_residency"> <span>Residency Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_experience"> <span>Experience Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_usmle1"> <span>USMLE Step 1 Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_usmle2"> <span>USMLE Step 2 Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_jurisprudence"> <span>Jurisprudence Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_english"> <span>English Proficiency Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_job_offer"> <span>Job Offer Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_contract"> <span>Contract Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_criminal"> <span>Criminal Record Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_police_clearance"> <span>Police Clearance Document</span></label></div>
                                <div class="col-md-4 mb-2"><label class="checkbox-label"><input type="checkbox" name="objected_fields[]" value="doc_military"> <span>Military Document</span></label></div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div style="background: white; padding: 20px; border-radius: 8px; border: 2px solid #dee2e6;">
                            <label style="font-weight: 600; color: #333; margin-bottom: 10px; display: block;">
                                <i class="fa fa-comment-o"></i> Objection Message <span class="text-danger">*</span>
                            </label>
                            <textarea name="objection_message" class="form-control" rows="5" placeholder="Provide detailed explanation of what needs to be corrected or resubmitted. Be specific to help the applicant understand the required changes." required style="border: 1px solid #ced4da; border-radius: 6px; padding: 12px;"></textarea>
                            <small style="color: #6c757d; display: block; margin-top: 8px;">
                                <i class="fa fa-info-circle"></i> This message will be sent to the applicant via email along with the list of objected fields.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: #f8f9fa; padding: 20px 30px; border-top: 2px solid #dee2e6;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 10px 25px; border-radius: 6px;">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-warning" style="background: #f39c12; border: none; padding: 10px 30px; border-radius: 6px; color: white; font-weight: 600;">
                        <i class="fa fa-send"></i> Send Objection Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.checkbox-label {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.2s;
    cursor: pointer;
    margin-bottom: 0;
}

.checkbox-label:hover {
    background: rgba(0, 84, 164, 0.05);
}

.checkbox-label input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin-right: 10px;
    cursor: pointer;
    flex-shrink: 0;
}

.checkbox-label span {
    font-size: 14px;
    color: #333;
    line-height: 1.4;
}

.checkbox-label input[type="checkbox"]:checked + span {
    font-weight: 600;
    color: #0054a4;
}

.field-section {
    transition: all 0.2s;
}

.field-section:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transform: translateY(-1px);
}

#requestDocsModal .modal-body::-webkit-scrollbar {
    width: 8px;
}

#requestDocsModal .modal-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#requestDocsModal .modal-body::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

#requestDocsModal .modal-body::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('statusSelect').addEventListener('change', function() {
    document.getElementById('rejectionReasonDiv').style.display = this.value==='rejected'?'block':'none';
});
</script>
@endpush
