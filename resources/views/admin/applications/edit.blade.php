@extends('layouts.admin')

@section('title', 'Edit Application')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.applications.show', $application->id) }}" class="btn btn-secondary mb-2">
            <i class="fa fa-arrow-left"></i> Back to Details
        </a>
        <h1>Edit Application</h1>
        <p class="text-muted">ID: <code>{{ $application->application_id }}</code></p>
    </div>
</div>

<form action="{{ route('admin.applications.update', $application->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <!-- Personal Information -->
    <div class="stat-card mb-4">
        <h5><i class="fa fa-user"></i> Personal Information</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $application->full_name) }}" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $application->dob->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label>Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-control" required>
                        <option value="Male" {{ $application->gender === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $application->gender === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Citizenship <span class="text-danger">*</span></label>
                    <input type="text" name="citizenship" class="form-control" value="{{ old('citizenship', $application->citizenship) }}" required>
                </div>
                <div class="form-group">
                    <label>Passport Number <span class="text-danger">*</span></label>
                    <input type="text" name="passport" class="form-control" value="{{ old('passport', $application->passport) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $application->email) }}" required>
                </div>
                <div class="form-group">
                    <label>Country Code <span class="text-danger">*</span></label>
                    <input type="text" name="country_code" class="form-control" value="{{ old('country_code', $application->country_code) }}" required>
                </div>
                <div class="form-group">
                    <label>Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $application->phone) }}" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" rows="3">{{ old('address', $application->address) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Visa Status <span class="text-danger">*</span></label>
                    <select name="visa_status" class="form-control" required>
                        <option value="F-1" {{ $application->visa_status === 'F-1' ? 'selected' : '' }}>F-1</option>
                        <option value="J-1" {{ $application->visa_status === 'J-1' ? 'selected' : '' }}>J-1</option>
                        <option value="H-1B" {{ $application->visa_status === 'H-1B' ? 'selected' : '' }}>H-1B</option>
                        <option value="Green Card" {{ $application->visa_status === 'Green Card' ? 'selected' : '' }}>Green Card</option>
                        <option value="Citizen" {{ $application->visa_status === 'Citizen' ? 'selected' : '' }}>Citizen</option>
                        <option value="Other" {{ $application->visa_status === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Medical Education -->
    <div class="stat-card mb-4">
        <h5><i class="fa fa-graduation-cap"></i> Medical Education</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Degree <span class="text-danger">*</span></label>
                    <select name="degree" class="form-control" required>
                        <option value="MD" {{ $application->degree === 'MD' ? 'selected' : '' }}>MD</option>
                        <option value="MBBS" {{ $application->degree === 'MBBS' ? 'selected' : '' }}>MBBS</option>
                        <option value="DO" {{ $application->degree === 'DO' ? 'selected' : '' }}>DO</option>
                        <option value="Other" {{ $application->degree === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Other Degree (if applicable)</label>
                    <input type="text" name="other_degree" class="form-control" value="{{ old('other_degree', $application->other_degree) }}">
                </div>
                <div class="form-group">
                    <label>Medical School <span class="text-danger">*</span></label>
                    <input type="text" name="medical_school" class="form-control" value="{{ old('medical_school', $application->medical_school) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>School Country <span class="text-danger">*</span></label>
                    <input type="text" name="school_country" class="form-control" value="{{ old('school_country', $application->school_country) }}" required>
                </div>
                <div class="form-group">
                    <label>Graduation Year <span class="text-danger">*</span></label>
                    <input type="number" name="graduation_year" class="form-control" value="{{ old('graduation_year', $application->graduation_year) }}" required>
                </div>
                <div class="form-group">
                    <label>ECFMG Certified <span class="text-danger">*</span></label>
                    <select name="ecfmg" class="form-control" required>
                        <option value="Yes" {{ $application->ecfmg === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->ecfmg === 'No' ? 'selected' : '' }}>No</option>
                        <option value="Pending" {{ $application->ecfmg === 'Pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Foreign Medical Licensure -->
    <div class="stat-card mb-4">
        <h5><i class="fa fa-certificate"></i> Foreign Medical Licensure</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>License Country <span class="text-danger">*</span></label>
                    <input type="text" name="license_country" class="form-control" value="{{ old('license_country', $application->license_country) }}" required>
                </div>
                <div class="form-group">
                    <label>License Number <span class="text-danger">*</span></label>
                    <input type="text" name="license_number" class="form-control" value="{{ old('license_number', $application->license_number) }}" required>
                </div>
                <div class="form-group">
                    <label>Issue Date <span class="text-danger">*</span></label>
                    <input type="date" name="issue_date" class="form-control" value="{{ old('issue_date', $application->issue_date->format('Y-m-d')) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Expiry Date <span class="text-danger">*</span></label>
                    <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date', $application->expiry_date->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label>Licensure Status <span class="text-danger">*</span></label>
                    <select name="licensure_status" class="form-control" required>
                        <option value="Active" {{ $application->licensure_status === 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $application->licensure_status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="Suspended" {{ $application->licensure_status === 'Suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Disciplinary Action <span class="text-danger">*</span></label>
                    <select name="disciplinary" class="form-control" required>
                        <option value="Yes" {{ $application->disciplinary === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->disciplinary === 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Postgraduate Training -->
    <div class="stat-card mb-4">
        <h5><i class="fa fa-hospital-o"></i> Postgraduate Training</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Pathway</label>
                    <select name="pathway" class="form-control">
                        <option value="Standard" {{ $application->pathway === 'Standard' ? 'selected' : '' }}>Standard</option>
                        <option value="J-1 Waiver" {{ $application->pathway === 'J-1 Waiver' ? 'selected' : '' }}>J-1 Waiver</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Completed Residency</label>
                    <select name="residency" class="form-control">
                        <option value="Yes" {{ $application->residency === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->residency === 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Residency Institution</label>
                    <input type="text" name="residency_institution" class="form-control" value="{{ old('residency_institution', $application->residency_institution) }}">
                </div>
                <div class="form-group">
                    <label>Residency From</label>
                    <input type="date" name="residency_from" class="form-control" value="{{ old('residency_from', $application->residency_from ? $application->residency_from->format('Y-m-d') : '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Residency To</label>
                    <input type="date" name="residency_to" class="form-control" value="{{ old('residency_to', $application->residency_to ? $application->residency_to->format('Y-m-d') : '') }}">
                </div>
                <div class="form-group">
                    <label>Post-Residency Years</label>
                    <input type="number" name="post_residency_years" class="form-control" value="{{ old('post_residency_years', $application->post_residency_years) }}">
                </div>
                <div class="form-group">
                    <label>Total Practice Years</label>
                    <input type="number" name="total_practice_years" class="form-control" value="{{ old('total_practice_years', $application->total_practice_years) }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Exam Requirements -->
    <div class="stat-card mb-4">
        <h5><i class="fa fa-file-text-o"></i> Exam Requirements</h5>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>USMLE Step 1</label>
                    <select name="step1" class="form-control">
                        <option value="Passed" {{ $application->step1 === 'Passed' ? 'selected' : '' }}>Passed</option>
                        <option value="Failed" {{ $application->step1 === 'Failed' ? 'selected' : '' }}>Failed</option>
                        <option value="Not Taken" {{ $application->step1 === 'Not Taken' ? 'selected' : '' }}>Not Taken</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>USMLE Step 2</label>
                    <select name="step2" class="form-control">
                        <option value="Passed" {{ $application->step2 === 'Passed' ? 'selected' : '' }}>Passed</option>
                        <option value="Failed" {{ $application->step2 === 'Failed' ? 'selected' : '' }}>Failed</option>
                        <option value="Not Taken" {{ $application->step2 === 'Not Taken' ? 'selected' : '' }}>Not Taken</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Jurisprudence</label>
                    <select name="jurisprudence" class="form-control">
                        <option value="Passed" {{ $application->jurisprudence === 'Passed' ? 'selected' : '' }}>Passed</option>
                        <option value="Failed" {{ $application->jurisprudence === 'Failed' ? 'selected' : '' }}>Failed</option>
                        <option value="Not Taken" {{ $application->jurisprudence === 'Not Taken' ? 'selected' : '' }}>Not Taken</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>English Proficiency</label>
                    <select name="english" class="form-control">
                        <option value="TOEFL" {{ $application->english === 'TOEFL' ? 'selected' : '' }}>TOEFL</option>
                        <option value="IELTS" {{ $application->english === 'IELTS' ? 'selected' : '' }}>IELTS</option>
                        <option value="Native Speaker" {{ $application->english === 'Native Speaker' ? 'selected' : '' }}>Native Speaker</option>
                        <option value="Not Required" {{ $application->english === 'Not Required' ? 'selected' : '' }}>Not Required</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Employment in Texas -->
    <div class="stat-card mb-4">
        <h5><i class="fa fa-building"></i> Employment in Texas</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Job Offer</label>
                    <select name="job_offer" class="form-control">
                        <option value="Yes" {{ $application->job_offer === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->job_offer === 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Employer Name</label>
                    <input type="text" name="employer_name" class="form-control" value="{{ old('employer_name', $application->employer_name) }}">
                </div>
                <div class="form-group">
                    <label>Facility Type</label>
                    <input type="text" name="facility_type" class="form-control" value="{{ old('facility_type', $application->facility_type) }}">
                </div>
                <div class="form-group">
                    <label>Employer Address</label>
                    <textarea name="employer_address" class="form-control" rows="2">{{ old('employer_address', $application->employer_address) }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $application->contact_person) }}">
                </div>
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control" value="{{ old('designation', $application->designation) }}">
                </div>
                <div class="form-group">
                    <label>Contact Phone</label>
                    <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $application->contact_phone) }}">
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $application->contact_email) }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Security & Background Check -->
    <div class="stat-card mb-4">
        <h5><i class="fa fa-shield"></i> Security & Background Check</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Security Risk</label>
                    <select name="security_risk" class="form-control">
                        <option value="Yes" {{ $application->security_risk === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->security_risk === 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ITAR Restricted</label>
                    <select name="itar" class="form-control">
                        <option value="Yes" {{ $application->itar === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->itar === 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Criminal Record</label>
                    <select name="criminal" class="form-control">
                        <option value="Yes" {{ $application->criminal === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->criminal === 'No' ? 'selected' : '' }}>No</option>
                        <option value="Pending" {{ $application->criminal === 'Pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Military Service</label>
                    <select name="military" class="form-control">
                        <option value="Yes" {{ $application->military === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->military === 'No' ? 'selected' : '' }}>No</option>
                        <option value="Exempt" {{ $application->military === 'Exempt' ? 'selected' : '' }}>Exempt</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Professional Misconduct</label>
                    <select name="misconduct" class="form-control">
                        <option value="Yes" {{ $application->misconduct === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->misconduct === 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Under Investigation</label>
                    <select name="investigations" class="form-control">
                        <option value="Yes" {{ $application->investigations === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $application->investigations === 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Attestation -->
    <div class="stat-card mb-4">
        <h5><i class="fa fa-pencil-square-o"></i> Attestation</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Applicant Signature</label>
                    <input type="text" name="applicant_signature" class="form-control" value="{{ old('applicant_signature', $application->applicant_signature) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Signature Date</label>
                    <input type="date" name="signature_date" class="form-control" value="{{ old('signature_date', $application->signature_date->format('Y-m-d')) }}">
                </div>
            </div>
        </div>
    </div>

    <div class="text-right mb-4">
        <a href="{{ route('admin.applications.show', $application->id) }}" class="btn btn-secondary">
            <i class="fa fa-times"></i> Cancel
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Update Application
        </button>
    </div>
</form>
@endsection
