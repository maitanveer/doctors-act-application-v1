@extends('layouts.app')

@section('title', 'Update Objected Fields - Application ' . $application->application_id)

@section('content')
<style>
    body { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; padding: 40px 0; }
    .edit-container { max-width: 900px; margin: 0 auto; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); padding: 40px; }
    .alert-warning { background: #fff3cd; border-left: 5px solid #f39c12; padding: 20px; margin-bottom: 30px; border-radius: 5px; }
    .form-section { background: #f8f9fa; padding: 25px; margin-bottom: 20px; border-radius: 10px; border-left: 4px solid #f39c12; }
    .form-group { margin-bottom: 20px; }
    .form-group label { font-weight: 600; color: #333; margin-bottom: 8px; display: block; }
    .form-group label .required { color: #dc3545; }
    .form-control { width: 100%; padding: 10px 15px; border: 2px solid #ddd; border-radius: 5px; font-size: 14px; transition: all 0.3s; }
    .form-control:focus { border-color: #f39c12; outline: none; box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.1); }
    .objected-field { background: #fff3cd; padding: 15px; border-radius: 5px; margin-bottom: 15px; }
    .field-name { font-weight: bold; color: #856404; margin-bottom: 10px; }
    .btn { padding: 12px 30px; border: none; border-radius: 5px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
    .btn-primary { background: #0054a4; color: white; }
    .btn-primary:hover { background: #003d7a; }
    .btn-secondary { background: #6c757d; color: white; margin-right: 10px; }
    .header-banner { background: #f39c12; color: white; padding: 30px; text-align: center; border-radius: 10px; margin-bottom: 30px; }
</style>

<div class="edit-container">
    <div class="header-banner">
        <h1>⚠️ Update Objected Fields</h1>
        <p style="margin: 10px 0 0 0; font-size: 16px;">Application ID: <strong>{{ $application->application_id }}</strong></p>
    </div>

    <div class="alert-warning">
        <h4 style="margin-top: 0;">📝 Action Required</h4>
        <p><strong>Message from Admin:</strong></p>
        <p>{{ $application->objection_message }}</p>
        <hr style="border-color: #f39c12; margin: 15px 0;">
        <p style="margin-bottom: 0;"><strong>Please update the following fields/documents and resubmit:</strong></p>
    </div>

    <form action="{{ route('application.update', $application->application_id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @foreach($objectedFields as $field)
            <div class="form-section objected-field">
                <div class="field-name">
                    🔸 {{ ucfirst(str_replace(['_', 'doc '], [' ', 'Document: '], $field)) }}
                </div>

                @if($field === 'full_name')
                    <div class="form-group">
                        <label>Full Name <span class="required">*</span></label>
                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $application->full_name) }}" required>
                    </div>

                @elseif($field === 'dob')
                    <div class="form-group">
                        <label>Date of Birth <span class="required">*</span></label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob', $application->dob ? $application->dob->format('Y-m-d') : '') }}" required>
                    </div>

                @elseif($field === 'gender')
                    <div class="form-group">
                        <label>Gender <span class="required">*</span></label>
                        <select name="gender" class="form-control" required>
                            <option value="Male" {{ $application->gender === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $application->gender === 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                @elseif($field === 'citizenship')
                    <div class="form-group">
                        <label>Citizenship <span class="required">*</span></label>
                        <select name="citizenship" class="form-control" required>
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ $application->citizenship === $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>

                @elseif($field === 'passport')
                    <div class="form-group">
                        <label>Passport Number <span class="required">*</span></label>
                        <input type="text" name="passport" class="form-control" value="{{ old('passport', $application->passport) }}" required>
                    </div>

                @elseif($field === 'email')
                    <div class="form-group">
                        <label>Email Address <span class="required">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $application->email) }}" required>
                    </div>

                @elseif($field === 'phone')
                    <div class="form-group">
                        <label>Phone Number <span class="required">*</span></label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $application->phone) }}" required>
                    </div>

                @elseif($field === 'country_code')
                    <div class="form-group">
                        <label>Country Code <span class="required">*</span></label>
                        <input type="text" name="country_code" class="form-control" value="{{ old('country_code', $application->country_code) }}" required>
                    </div>

                @elseif($field === 'address')
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address', $application->address) }}</textarea>
                    </div>

                @elseif($field === 'visa_status')
                    <div class="form-group">
                        <label>Visa Status <span class="required">*</span></label>
                        <select name="visa_status" class="form-control" required>
                            <option value="F-1" {{ $application->visa_status === 'F-1' ? 'selected' : '' }}>F-1</option>
                            <option value="J-1" {{ $application->visa_status === 'J-1' ? 'selected' : '' }}>J-1</option>
                            <option value="H-1B" {{ $application->visa_status === 'H-1B' ? 'selected' : '' }}>H-1B</option>
                            <option value="Green Card" {{ $application->visa_status === 'Green Card' ? 'selected' : '' }}>Green Card</option>
                            <option value="Citizen" {{ $application->visa_status === 'Citizen' ? 'selected' : '' }}>Citizen</option>
                            <option value="Other" {{ $application->visa_status === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                @elseif($field === 'degree')
                    <div class="form-group">
                        <label>Degree <span class="required">*</span></label>
                        <select name="degree" class="form-control" required>
                            <option value="MD" {{ $application->degree === 'MD' ? 'selected' : '' }}>MD</option>
                            <option value="MBBS" {{ $application->degree === 'MBBS' ? 'selected' : '' }}>MBBS</option>
                            <option value="DO" {{ $application->degree === 'DO' ? 'selected' : '' }}>DO</option>
                            <option value="Other" {{ $application->degree === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                @elseif($field === 'other_degree')
                    <div class="form-group">
                        <label>Other Degree (if applicable)</label>
                        <input type="text" name="other_degree" class="form-control" value="{{ old('other_degree', $application->other_degree) }}">
                    </div>

                @elseif($field === 'medical_school')
                    <div class="form-group">
                        <label>Medical School <span class="required">*</span></label>
                        <input type="text" name="medical_school" class="form-control" value="{{ old('medical_school', $application->medical_school) }}" required>
                    </div>

                @elseif($field === 'school_country')
                    <div class="form-group">
                        <label>School Country <span class="required">*</span></label>
                        <select name="school_country" class="form-control" required>
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ $application->school_country === $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>

                @elseif($field === 'graduation_year')
                    <div class="form-group">
                        <label>Graduation Year <span class="required">*</span></label>
                        <input type="number" name="graduation_year" class="form-control" value="{{ old('graduation_year', $application->graduation_year) }}" min="1950" max="{{ date('Y') + 10 }}" required>
                    </div>

                @elseif($field === 'ecfmg')
                    <div class="form-group">
                        <label>ECFMG Certified <span class="required">*</span></label>
                        <select name="ecfmg" class="form-control" required>
                            <option value="Yes" {{ $application->ecfmg === 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ $application->ecfmg === 'No' ? 'selected' : '' }}>No</option>
                            <option value="Pending" {{ $application->ecfmg === 'Pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>

                @elseif($field === 'license_country')
                    <div class="form-group">
                        <label>License Country <span class="required">*</span></label>
                        <select name="license_country" class="form-control" required>
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ $application->license_country === $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>

                @elseif($field === 'license_number')
                    <div class="form-group">
                        <label>License Number <span class="required">*</span></label>
                        <input type="text" name="license_number" class="form-control" value="{{ old('license_number', $application->license_number) }}" required>
                    </div>

                @elseif($field === 'issue_date')
                    <div class="form-group">
                        <label>License Issue Date <span class="required">*</span></label>
                        <input type="date" name="issue_date" class="form-control" value="{{ old('issue_date', $application->issue_date ? $application->issue_date->format('Y-m-d') : '') }}" required>
                    </div>

                @elseif($field === 'expiry_date')
                    <div class="form-group">
                        <label>License Expiry Date <span class="required">*</span></label>
                        <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date', $application->expiry_date ? $application->expiry_date->format('Y-m-d') : '') }}" required>
                    </div>

                @elseif($field === 'licensure_status')
                    <div class="form-group">
                        <label>Licensure Status <span class="required">*</span></label>
                        <select name="licensure_status" class="form-control" required>
                            <option value="Active" {{ $application->licensure_status === 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $application->licensure_status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="Suspended" {{ $application->licensure_status === 'Suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                    </div>

                @elseif($field === 'disciplinary')
                    <div class="form-group">
                        <label>Disciplinary Action <span class="required">*</span></label>
                        <select name="disciplinary" class="form-control" required>
                            <option value="Yes" {{ $application->disciplinary === 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ $application->disciplinary === 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                @elseif(in_array($field, ['pathway', 'residency', 'step1', 'step2', 'jurisprudence', 'english', 'job_offer', 'security_risk', 'itar', 'criminal', 'military', 'misconduct', 'investigations']))
                    <div class="form-group">
                        <label>{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field, $application->$field) }}">
                    </div>

                @elseif(in_array($field, ['residency_institution', 'employer_name', 'facility_type', 'contact_person', 'designation', 'contact_phone', 'contact_email', 'applicant_signature']))
                    <div class="form-group">
                        <label>{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field, $application->$field) }}">
                    </div>

                @elseif(in_array($field, ['residency_from', 'residency_to', 'signature_date']))
                    <div class="form-group">
                        <label>{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        <input type="date" name="{{ $field }}" class="form-control" value="{{ old($field, $application->$field ? $application->$field->format('Y-m-d') : '') }}">
                    </div>

                @elseif(in_array($field, ['post_residency_years', 'total_practice_years']))
                    <div class="form-group">
                        <label>{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        <input type="number" name="{{ $field }}" class="form-control" value="{{ old($field, $application->$field) }}">
                    </div>

                @elseif($field === 'employer_address')
                    <div class="form-group">
                        <label>Employer Address</label>
                        <textarea name="employer_address" class="form-control" rows="3">{{ old('employer_address', $application->employer_address) }}</textarea>
                    </div>

                @elseif(str_starts_with($field, 'doc_'))
                    <div class="form-group">
                        <label>Upload {{ ucfirst(str_replace(['doc_', '_'], ['', ' '], $field)) }} Document</label>
                        @if($application->$field)
                            <p style="color: #28a745; font-size: 13px; margin-bottom: 10px;">
                                ✓ Current file: {{ $application->$field }}
                            </p>
                        @endif
                        <input type="file" name="{{ $field }}" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        <small style="color: #666; display: block; margin-top: 5px;">Accepted formats: PDF, JPG, PNG (Max 5MB)</small>
                    </div>
                @endif
            </div>
        @endforeach

        @if($errors->any())
            <div style="background: #f8d7da; border-left: 4px solid #dc3545; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                <h5 style="color: #721c24; margin-top: 0;">Validation Errors:</h5>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li style="color: #721c24;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="text-align: right; margin-top: 30px; padding-top: 20px; border-top: 2px solid #dee2e6;">
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">✓ Submit Updated Information</button>
        </div>
    </form>
</div>
@endsection
