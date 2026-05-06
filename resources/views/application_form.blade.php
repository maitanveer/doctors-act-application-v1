@extends('layouts.app')



@section('title', 'Texas Doctor’s Act (HB 2038) - Provisional Medical License Pathway')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Texas Doctor's Act (HB 2038) - Provisional Medical License Application</title>
        <style>
            body {
                /* background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); */
                min-height: 100vh;

            }


            .container {
                max-width: 1200px;
                margin: 0 auto;
                background: white;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }


            .header h1 {
                font-size: 24px;
                margin-bottom: 10px;
                font-weight: 600;
            }

            .header .subtitle {
                font-size: 16px;
                opacity: 0.9;
            }

            .progress-container {
                background: #f8f9fa;
                padding: 20px 30px;
                border-bottom: 2px solid #e9ecef;
            }

            .progress-steps {
                display: flex;
                justify-content: space-between;
                position: relative;
                counter-reset: step;
            }

            .progress-steps::before {
                content: '';
                position: absolute;
                top: 15px;
                left: 0;
                width: 100%;
                height: 4px;
                background: #e0e0e0;
                z-index: 1;
            }

            .progress-bar {
                position: absolute;
                top: 15px;
                left: 0;
                height: 4px;
                background: #0054a4;
                z-index: 2;
                transition: all 0.5s ease;
            }

            .step {
                position: relative;
                z-index: 3;
                text-align: center;
                width: 100px;
            }

            .step-circle {
                width: 34px;
                height: 34px;
                border-radius: 50%;
                background: #e0e0e0;
                color: #666;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 8px;
                font-weight: bold;
                border: 3px solid white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .step.completed .step-circle {
                background: #28a745;
                color: white;
            }

            .step.active .step-circle {
                background: #0054a4;
                color: white;
                animation: pulse 2s infinite;
            }

            .step.pending .step-circle {
                background: #6c757d;
                color: white;
            }

            .step-label {
                font-size: 12px;
                font-weight: 600;
                color: #666;
                transition: all 0.3s ease;
            }

            .step.completed .step-label {
                color: #28a745;
            }

            .step.active .step-label {
                color: #0054a4;
            }

            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(0, 84, 164, 0.4);
                }

                70% {
                    box-shadow: 0 0 0 10px rgba(0, 84, 164, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(0, 84, 164, 0);
                }
            }

            }

            .form-container {
                padding: 30px;
            }

            .step-content {
                display: none;
                animation: fadeIn 0.5s ease;
            }

            .step-content.active {
                display: block;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .form-section {
                margin-bottom: 30px;
                padding: 20px;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                background: #fafafa;
            }

            .section-title {
                font-size: 18px;
                color: #0054a4;
                margin-bottom: 15px;
                padding-bottom: 8px;
                border-bottom: 2px solid #e0e0e0;
                font-weight: 600;
            }

            .form-row {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                margin-bottom: 15px;
            }

            .form-group {
                flex: 1;
                min-width: 250px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: 500;
                color: #333;
            }

            label.required::after {
                content: " *";
                color: #dc3545;
            }

            input,
            select,
            textarea {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #ced4da;
                border-radius: 4px;
                font-size: 14px;
                transition: all 0.3s;
            }

            input:focus,
            select:focus,
            textarea:focus {
                outline: none;
                border-color: #0054a4;
                box-shadow: 0 0 0 3px rgba(0, 84, 164, 0.1);
            }

            .radio-group {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
                margin-top: 5px;
            }

            .radio-option {
                display: flex;
                align-items: center;
            }

            .radio-option input {
                width: auto;
                margin-right: 5px;
            }

            .checkbox-group {
                display: flex;
                align-items: center;
                margin-top: 5px;
            }

            .checkbox-group input {
                width: auto;
                margin-right: 8px;
            }

            .validation-error {
                color: #dc3545;
                font-size: 12px;
                margin-top: 5px;
                display: none;
                font-weight: 500;
            }

            .error {
                border-color: #dc3545 !important;
            }
            
            /* Enhanced styling for file input errors */
            input[type="file"].error {
                border: 2px solid #dc3545 !important;
                background-color: #fff5f5;
            }
            
            /* Table row error highlighting */
            tr.error-row {
                background-color: #fff5f5;
                border-left: 4px solid #dc3545;
            }

            .buttons {
                display: flex;
                justify-content: space-between;
                margin-top: 30px;
                padding-top: 20px;
                border-top: 1px solid #e0e0e0;
            }

            button {
                padding: 12px 25px;
                border: none;
                border-radius: 4px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
            }

            .btn-prev {
                background: #6c757d;
                color: white;
            }

            .btn-prev:hover {
                background: #5a6268;
            }

            .btn-next {
                background: #0054a4;
                color: white;
            }

            .btn-next:hover {
                background: #004085;
            }

            .btn-submit {
                background: #28a745;
                color: white;
            }

            .btn-submit:hover {
                background: #218838;
            }

            .summary {
                background: #e8f4fd;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 20px;
                border-left: 4px solid #0054a4;
            }

            .summary h3 {
                color: #0054a4;
                margin-bottom: 10px;
            }

            .hidden {
                display: none;
            }

            .success-message {
                text-align: center;
                padding: 40px 20px;
                display: none;
            }

            .success-icon {
                font-size: 60px;
                color: #28a745;
                margin-bottom: 20px;
            }

            .email-preview {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                margin-top: 20px;
                border: 1px dashed #dee2e6;
            }

            .email-preview h4 {
                color: #0054a4;
                margin-bottom: 15px;
            }

            .email-content {
                background: white;
                padding: 15px;
                border-radius: 4px;
                font-family: monospace;
                font-size: 12px;
                max-height: 200px;
                overflow-y: auto;
            }

            @media (max-width: 768px) {
                .progress-steps {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 15px;
                }

                .progress-steps::before {
                    display: none;
                }

                .step {
                    display: flex;
                    align-items: center;
                    width: 100%;
                    text-align: left;
                }

                .step-circle {
                    margin: 0 15px 0 0;
                    flex-shrink: 0;
                }

                .form-row {
                    flex-direction: column;
                    gap: 15px;
                }

                .form-group {
                    min-width: 100%;
                }
            }

            /* Preview and certification styles */
            .form-preview {
                background: #f8f9fa;
                padding: 25px;
                border-radius: 8px;
                margin: 25px 0;
                border: 1px solid #dee2e6;
            }

            .form-preview h4 {
                color: #0054a4;
                margin-bottom: 20px;
                font-size: 20px;
                font-weight: 600;
            }

            .preview-section {
                background: white;
                padding: 18px;
                border-radius: 6px;
                margin-bottom: 15px;
                border-left: 4px solid #0054a4;
            }

            .preview-section h5 {
                color: #0054a4;
                margin-bottom: 12px;
                font-size: 16px;
                font-weight: 600;
                border-bottom: 1px solid #e9ecef;
                padding-bottom: 6px;
            }

            .preview-row {
                display: flex;
                margin-bottom: 10px;
                align-items: baseline;
            }

            .preview-label {
                font-weight: 600;
                color: #495057;
                min-width: 200px;
                flex-shrink: 0;
            }

            .preview-value {
                color: #212529;
                flex: 1;
            }

            .certification-box {
                background: #e7f3ff;
                border: 2px solid #0054a4;
                border-radius: 8px;
                padding: 16px;
                margin: 20px 0;
            }

            .certification-checkbox {
                display: flex;
                align-items: center;
                gap: 12px;
                cursor: pointer;
            }

            .certification-checkbox input[type="checkbox"] {
                width: 20px;
                height: 20px;
                margin: 0;
                transform: scale(1.12);
                accent-color: #0054a4;
                cursor: pointer;
            }

            .certification-checkbox span {
                font-size: 16px;
                font-weight: 500;
                color: #212529;
            }

            .certification-error {
                color: #dc3545;
                font-size: 14px;
                margin-top: 8px;
                display: none;
            }
        </style>
        <script>
            function validateFileSize(input, maxMB, errorId) {
                const errorElement = document.getElementById(errorId);
                if (!input || !input.files || input.files.length === 0) {
                    if (errorElement) errorElement.style.display = 'none';
                    return;
                }
                const file = input.files[0];
                const maxBytes = maxMB * 1024 * 1024;
                if (file.size > maxBytes) {
                    if (errorElement) errorElement.style.display = 'block';
                    input.value = '';
                    input.classList.add('error');
                    input.style.borderColor = '#dc3545';
                    input.style.backgroundColor = '#fff5f5';
                } else {
                    // File is valid - clear all error styling
                    if (errorElement) errorElement.style.display = 'none';
                    input.classList.remove('error');
                    input.style.borderColor = '#ced4da';
                    input.style.boxShadow = 'none';
                    input.style.backgroundColor = '';
                    
                    // Clear table row highlighting
                    const row = input.closest('tr');
                    if (row) {
                        row.style.backgroundColor = '';
                        row.style.borderLeft = '';
                    }
                }
            }
            // Expose for inline onchange handlers and other scripts
            window.validateFileSize = validateFileSize;
        </script>
    </head>

    <body>
        <div class="container" style="margin-top: 2rem">
            <br>
            <div class="alert alert-info">For any technical difficulty, please reach out to support@ibnsinafoundation.org</div>
            <div class="alert alert-info" role="alert">
              <strong>Disclaimer:</strong> IBN SINA Foundation does not issue medical licenses.
              Our role is limited to preliminary assessment and guidance.
              Only the Texas Medical Board (TMB) can issue a provisional or full physician license.
          </div>
            <br>
            <div class="program-note" style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #0054a4;">
                <strong>Note:</strong> This application supports multiple Dr ACT programs. Program selection determines eligibility review and onboarding pathway.
            </div>
            <h1>TEXAS DOCTOR'S ACT (HB 2038) – Provisional Medical License</h1>
            <br>
            <div class="insurance-notice" style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3 style="color: #856404; margin-top: 0;">Insurance & Liability Notice</h3>
                <p style="margin-bottom: 0; color: #856404;">All participants in the Clinical Rotations Program and Volunteer Specialist Program are required to maintain their own valid professional liability (malpractice) insurance for the duration of their engagement. Dr ACT does not provide liability coverage for rotation participants or volunteers. Proof of personal liability insurance meeting applicable U.S. and facility requirements must be submitted prior to placement.</p>
            </div>
            <div class="subtitle">Application Form – Effective September 1, 2025</div>


            <div class="progress-container">
                <div class="progress-steps">
                    <div class="step completed" id="step1">
                        <div class="step-circle">1</div>
                        <div class="step-label">Personal Info</div>
                    </div>
                    <div class="step active" id="step2">
                        <div class="step-circle">2</div>
                        <div class="step-label">Education</div>
                    </div>
                    <div class="step pending" id="step3">
                        <div class="step-circle">3</div>
                        <div class="step-label">Foreign License</div>
                    </div>
                    <div class="step pending" id="step4">
                        <div class="step-circle">4</div>
                        <div class="step-label">Experience</div>
                    </div>
                    <div class="step pending" id="step5">
                        <div class="step-circle">5</div>
                        <div class="step-label">Exams</div>
                    </div>
                    <div class="step pending" id="step6">
                        <div class="step-circle">6</div>
                        <div class="step-label">Employment</div>
                    </div>
                    <div class="step pending" id="step7">
                        <div class="step-circle">7</div>
                        <div class="step-label">Background</div>
                    </div>
                    <div class="step pending" id="step8">
                        <div class="step-circle">8</div>
                        <div class="step-label">Review & Submit</div>
                    </div>
                    <div class="progress-bar" id="progressBar"></div>
                </div>
            </div>

            <div class="form-container">
                <!-- Step 1: Personal Information -->
                <div class="step-content active" id="stepContent1">
                    <div class="form-section">
                        <h2 class="section-title">SECTION A — PERSONAL INFORMATION</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required" for="fullName">Full Name</label>
                                <input type="text" id="fullName" name="fullName">
                                <div class="validation-error" id="fullNameError">Full name is required</div>
                            </div>
                            <div class="form-group">
                                <label class="required" for="dob">Date of Birth (MM/DD/YYYY)</label>
                                <input type="date" id="dob" name="dob">
                                <div class="validation-error" id="dobError">Valid date of birth is required</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Gender</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="male" name="gender" value="Male">
                                        <label for="male">Male</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="female" name="gender" value="Female">
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                                <div class="validation-error" id="genderError">Please select a gender</div>
                            </div>
                            <div class="form-group">
                                <label class="required" for="citizenship">Country of Citizenship</label>
                                <select id="citizenship" name="citizenship">
                                    <option value="">Select country</option>
                                    @if(!empty($countries))
                                        @foreach($countries as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="validation-error" id="citizenshipError">Country of citizenship is required</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required" for="passport">Passport Number</label>
                                <input type="text" id="passport" name="passport">
                                <div class="validation-error" id="passportError">Passport number is required</div>
                            </div>
                            <div class="form-group">
                                <label class="required" for="email">Email Address</label>
                                <input type="email" id="email" name="email">
                                <div class="validation-error" id="emailError">Valid email address is required</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required" for="phone">Phone Number</label>
                                <div style="display:flex; gap:8px; align-items:center;">
                                    <select id="countryCode" name="countryCode" style="width:140px;">
                                        <option value="">Code</option>
                                        @if(!empty($countryCodes))
                                            @foreach($countryCodes as $code => $label)
                                                <option value="{{ $code }}">{{ $label }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <input type="tel" id="phone" name="phone" style="flex:1;">
                                </div>
                                <div class="validation-error" id="phoneError">Phone number is required</div>
                            </div>
                            <div class="form-group">
                                <label for="address">U.S. Address (if applicable)</label>
                                <input type="text" id="address" name="address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Current Visa/Work Status</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="citizen" name="visaStatus" value="U.S. Citizen">
                                        <label for="citizen">U.S. Citizen</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="resident" name="visaStatus"
                                            value="Permanent Resident">
                                        <label for="resident">Permanent Resident</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="h1b" name="visaStatus" value="H-1B">
                                        <label for="h1b">H-1B</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="o1" name="visaStatus" value="O-1">
                                        <label for="o1">O-1</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="j1" name="visaStatus" value="J-1">
                                        <label for="j1">J-1</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="otherVisa" name="visaStatus" value="Other">
                                        <label for="otherVisa">Other:</label>
                                        <input type="text" id="otherVisaText" name="otherVisaText" style="width: 100px; margin-left: 5px;"
                                            disabled>
                                    </div>
                                </div>
                                <div class="validation-error" id="visaStatusError">Please select a visa/work status</div>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <div></div>
                        <button class="btn-next" onclick="nextStep(1)">Next: Medical Education →</button>
                    </div>
                </div>

                <!-- Step 2: Medical Education -->
                <div class="step-content" id="stepContent2">
                    <div class="form-section">
                        <h2 class="section-title">SECTION B — MEDICAL EDUCATION</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required" for="degree">Medical Degree</label>
                                <select id="degree" name="degree" onchange="toggleOtherDegree(this.value)">
                                    <option value="">Select degree</option>
                                    @if(!empty($degrees))
                                        @foreach($degrees as $deg)
                                            <option value="{{ $deg }}">{{ $deg }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="validation-error" id="degreeError">Medical degree is required</div>
                                <div style="margin-top:8px; display:none;" id="otherDegreeRow">
                                    <label for="otherDegree">Please specify</label>
                                    <input type="text" id="otherDegree" name="otherDegree" disabled>
                                    <div class="validation-error" id="otherDegreeError">Please specify your degree</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required" for="medicalSchool">Medical School Name</label>
                                <input type="text" id="medicalSchool" name="medicalSchool">
                                <div class="validation-error" id="medicalSchoolError">Medical school name is required
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required" for="schoolCountry">Country of Medical School</label>
                                <select id="schoolCountry" name="schoolCountry">
                                    <option value="">Select country</option>
                                    @if(!empty($countries))
                                        @foreach($countries as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="validation-error" id="schoolCountryError">Country is required</div>
                            </div>
                            <div class="form-group">
                                <label class="required" for="graduationYear">Year of Graduation</label>
                                <input type="number" id="graduationYear" name="graduationYear" min="1900"
                                    max="2025">
                                <div class="validation-error" id="graduationYearError">Valid graduation year is required
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">ECFMG Eligibility</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="ecfmgYes" name="ecfmg" value="Yes">
                                        <label for="ecfmgYes">Yes, my medical school qualifies me for ECFMG
                                            eligibility</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="ecfmgNo" name="ecfmg" value="No">
                                        <label for="ecfmgNo">No</label>
                                    </div>
                                </div>
                                <div class="validation-error" id="ecfmgError">ECFMG eligibility is required. You must be ECFMG eligible to proceed.</div>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <button class="btn-prev" onclick="prevStep(2)">← Previous</button>
                        <button class="btn-next" onclick="nextStep(2)">Next: Foreign Medical Licensure →</button>
                    </div>
                </div>

                <!-- Step 3: Foreign Medical Licensure -->
                <div class="step-content" id="stepContent3">
                    <div class="form-section">
                        <h2 class="section-title">SECTION C — FOREIGN MEDICAL LICENSURE</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required" for="licenseCountry">Country of Current Medical License</label>
                                <select id="licenseCountry" name="licenseCountry">
                                    <option value="">Select country</option>
                                    @if(!empty($countries))
                                        @foreach($countries as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="validation-error" id="licenseCountryError">Country is required</div>
                            </div>
                            <div class="form-group">
                                <label class="required" for="licenseNumber">License Number</label>
                                <input type="text" id="licenseNumber" name="licenseNumber">
                                <div class="validation-error" id="licenseNumberError">License number is required</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required" for="issueDate">Issue Date</label>
                                <input type="date" id="issueDate" name="issueDate">
                                <div class="validation-error" id="issueDateError">Issue date is required</div>
                            </div>
                            <div class="form-group">
                                <label class="required" for="expiryDate">Expiry Date</label>
                                <input type="date" id="expiryDate" name="expiryDate">
                                <div class="validation-error" id="expiryDateError">Expiry date is required</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Licensure Status</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="goodStanding" name="licensureStatus"
                                            value="Active and in Good Standing" onchange="toggleLicensureExplanation()">
                                        <label for="goodStanding">Active and in Good Standing</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="notGoodStanding" name="licensureStatus"
                                            value="Not in Good Standing" onchange="toggleLicensureExplanation()">
                                        <label for="notGoodStanding">Not in Good Standing (explain):</label>
                                    </div>
                                </div>
                                <div style="margin-top:8px; display:none;" id="licensureExplanationRow">
                                    <label for="licensureExplanation">Please explain:</label>
                                    <textarea id="licensureExplanation" name="licensureExplanation" rows="3" placeholder="Provide details about your licensure status..."></textarea>
                                    <div class="validation-error" id="licensureExplanationError">Please provide an explanation</div>
                                </div>
                                <div class="validation-error" id="licensureStatusError">Please select licensure status
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Disciplinary History</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="disciplinaryNone" name="disciplinary" value="None" onchange="toggleDisciplinaryExplanation()">
                                        <label for="disciplinaryNone">None</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="disciplinaryYes" name="disciplinary" value="Yes" onchange="toggleDisciplinaryExplanation()">
                                        <label for="disciplinaryYes">Yes (provide explanation and documentation)</label>
                                    </div>
                                </div>
                                <div style="margin-top:8px; display:none;" id="disciplinaryExplanationRow">
                                    <label for="disciplinaryExplanation">Please explain:</label>
                                    <textarea id="disciplinaryExplanation" name="disciplinaryExplanation" rows="3" placeholder="Provide details about your disciplinary history..."></textarea>
                                    <div class="validation-error" id="disciplinaryExplanationError">Please provide an explanation</div>
                                </div>
                                <div class="validation-error" id="disciplinaryError">Please select disciplinary history
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required" for="uploadDocument">Upload Lisence Document</label>
                                <input type="file" id="uploadDocument" name="uploadDocument" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 5, 'uploadDocumentError')">
                                <div class="validation-error" id="uploadDocumentError">Please upload a document</div>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <button class="btn-prev" onclick="prevStep(3)">← Previous</button>
                        <button class="btn-next" onclick="nextStep(3)">Next: Postgraduate Training →</button>
                    </div>
                </div>

                <!-- Step 4: Postgraduate Training & Experience -->
                <div class="step-content" id="stepContent4">
                    <div class="form-section">
                        <h2 class="section-title">SECTION D — POSTGRADUATE TRAINING & EXPERIENCE</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Select Your Pathway</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="pathA" name="pathway" value="Path A">
                                        <label for="pathA">Path A — Countries Requiring Residency</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="pathB" name="pathway" value="Path B">
                                        <label for="pathB">Path B — Countries NOT Requiring Residency</label>
                                    </div>
                                </div>
                                <div class="validation-error" id="pathwayError">Please select a pathway</div>
                            </div>
                        </div>

                        <div id="pathAFields" class="hidden">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required">Residency Completed</label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="residencyYes" name="residency" value="Yes">
                                            <label for="residencyYes">Yes</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="residencyNo" name="residency" value="No">
                                            <label for="residencyNo">No</label>
                                        </div>
                                    </div>
                                    <div class="validation-error" id="residencyError">Please indicate if residency was
                                        completed</div>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="residencyInstitution">Residency Institution &
                                        Country</label>
                                    <input type="text" id="residencyInstitution" name="residencyInstitution">
                                    <div class="validation-error" id="residencyInstitutionError">Institution is required
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required" for="residencyFrom">Dates: From</label>
                                    <input type="date" id="residencyFrom" name="residencyFrom">
                                    <div class="validation-error" id="residencyFromError">Start date is required</div>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="residencyTo">To</label>
                                    <input type="date" id="residencyTo" name="residencyTo">
                                    <div class="validation-error" id="residencyToError">End date is required</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required" for="postResidencyYears">Post-Residency Clinical Practice
                                        Years Completed</label>
                                    <input type="number" id="postResidencyYears" name="postResidencyYears"
                                        min="5" max="50" placeholder="Minimum 5 years, maximum 50">
                                    <div class="validation-error" id="postResidencyYearsError">Minimum 5 years required
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="pathBFields" class="hidden">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required" for="totalPracticeYears">Total Years of Licensed Medical
                                        Practice After Graduation</label>
                                    <input type="number" id="totalPracticeYears" name="totalPracticeYears"
                                        min="10" max="50" placeholder="Minimum 10 years, maximum 50">
                                    <div class="validation-error" id="totalPracticeYearsError">Minimum 10 years required
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <button class="btn-prev" onclick="prevStep(4)">← Previous</button>
                        <button class="btn-next" onclick="nextStep(4)">Next: Exam Requirements →</button>
                    </div>
                </div>

                <!-- Step 5: Exam Requirements -->
                <div class="step-content" id="stepContent5">
                    <div class="form-section">
                        <h2 class="section-title">SECTION E — EXAM REQUIREMENTS</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">USMLE Step 1</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="step1Passed" name="step1" value="Passed" onchange="toggleExamExplanation('step1')">
                                        <label for="step1Passed">Passed</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="step1Pending" name="step1" value="Pending" onchange="toggleExamExplanation('step1')">
                                        <label for="step1Pending">Pending</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="step1NotAttempted" name="step1"
                                            value="Not Attempted" onchange="toggleExamExplanation('step1')">
                                        <label for="step1NotAttempted">Not Attempted</label>
                                    </div>
                                </div>
                                <div style="margin-top:8px; display:none;" id="step1ExplanationRow">
                                    <label for="step1Explanation">Please provide explanation:</label>
                                    <textarea id="step1Explanation" name="step1Explanation" rows="2" placeholder="Provide details about your USMLE Step 1 status..."></textarea>
                                    <div class="validation-error" id="step1ExplanationError">Please provide an explanation</div>
                                </div>
                                <div class="validation-error" id="step1Error">Please select USMLE Step 1 status</div>
                            </div>
                            <div class="form-group">
                                <label class="required">USMLE Step 2</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="step2Passed" name="step2" value="Passed" onchange="toggleExamExplanation('step2')">
                                        <label for="step2Passed">Passed</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="step2Pending" name="step2" value="Pending" onchange="toggleExamExplanation('step2')">
                                        <label for="step2Pending">Pending</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="step2NotAttempted" name="step2"
                                            value="Not Attempted" onchange="toggleExamExplanation('step2')">
                                        <label for="step2NotAttempted">Not Attempted</label>
                                    </div>
                                </div>
                                <div style="margin-top:8px; display:none;" id="step2ExplanationRow">
                                    <label for="step2Explanation">Please provide explanation:</label>
                                    <textarea id="step2Explanation" name="step2Explanation" rows="2" placeholder="Provide details about your USMLE Step 2 status..."></textarea>
                                    <div class="validation-error" id="step2ExplanationError">Please provide an explanation</div>
                                </div>
                                <div class="validation-error" id="step2Error">Please select USMLE Step 2 status</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Texas Medical Jurisprudence Exam</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="jurisprudencePassed" name="jurisprudence"
                                            value="Passed">
                                        <label for="jurisprudencePassed">Passed</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="jurisprudencePending" name="jurisprudence"
                                            value="Pending">
                                        <label for="jurisprudencePending">Pending</label>
                                    </div>
                                </div>
                                <div class="validation-error" id="jurisprudenceError">Please select Texas Jurisprudence
                                    Exam status</div>
                            </div>
                            <div class="form-group">
                                <label class="required">English Language Proficiency</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="ielts" name="english" value="IELTS">
                                        <label for="ielts">IELTS</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="toefl" name="english" value="TOEFL">
                                        <label for="toefl">TOEFL</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="oet" name="english" value="OET">
                                        <label for="oet">OET</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="native" name="english"
                                            value="Native English Speaker">
                                        <label for="native">Native English Speaker</label>
                                    </div>
                                </div>
                                <div class="validation-error" id="englishError">Please select English proficiency</div>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <button class="btn-prev" onclick="prevStep(5)">← Previous</button>
                        <button class="btn-next" onclick="nextStep(5)">Next: Employment in Texas →</button>
                    </div>
                </div>

                <!-- Step 6: Employment in Texas -->
                <div class="step-content" id="stepContent6">
                    <div class="form-section">
                        <h2 class="section-title">SECTION F — EMPLOYMENT IN TEXAS</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Do you have a verified job offer in Texas?</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="jobOfferYes" name="jobOffer" value="Yes">
                                        <label for="jobOfferYes">Yes</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="jobOfferNo" name="jobOffer" value="No">
                                        <label for="jobOfferNo">No</label>
                                    </div>
                                </div>
                                <div class="validation-error" id="jobOfferError">Please indicate if you have a job offer
                                </div>
                            </div>
                        </div>

                        <div id="jobOfferFields" class="hidden">
                            <div class="form-row">
                                <div class="form-group">
                                    <p style="margin: 0 0 12px; color: #0b5ed7; font-weight: 600;">
                                        Selecting Yes makes the job offer letter required in Section H and in the final review step.
                                    </p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required" for="employerName">Employer Name</label>
                                    <input type="text" id="employerName" name="employerName">
                                    <div class="validation-error" id="employerNameError">Employer name is required</div>
                                </div>
                                <div class="form-group">
                                    <label class="required">Facility Type</label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="hospital" name="facilityType" value="Hospital">
                                            <label for="hospital">Hospital</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="facilityPractice" name="facilityType"
                                                value="Facility-Based Practice">
                                            <label for="facilityPractice">Facility-Based Practice</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="groupPractice" name="facilityType"
                                                value="Group Medical Practice">
                                            <label for="groupPractice">Group Medical Practice</label>
                                        </div>
                                    </div>
                                    <div class="validation-error" id="facilityTypeError">Please select facility type</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required" for="employerAddress">Address</label>
                                    <input type="text" id="employerAddress" name="employerAddress">
                                    <div class="validation-error" id="employerAddressError">Address is required</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required" for="contactPerson">Employer Contact Person</label>
                                    <input type="text" id="contactPerson" name="contactPerson">
                                    <div class="validation-error" id="contactPersonError">Contact person is required</div>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="designation">Designation</label>
                                    <input type="text" id="designation" name="designation">
                                    <div class="validation-error" id="designationError">Designation is required</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required" for="contactPhone">Phone</label>
                                    <input type="tel" id="contactPhone" name="contactPhone">
                                    <div class="validation-error" id="contactPhoneError">Phone is required</div>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="contactEmail">Email</label>
                                    <input type="email" id="contactEmail" name="contactEmail">
                                    <div class="validation-error" id="contactEmailError">Valid email is required</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <button class="btn-prev" onclick="prevStep(6)">← Previous</button>
                        <button class="btn-next" onclick="nextStep(6)">Next: Security & Background →</button>
                    </div>
                </div>

                <!-- Step 7: Security & Background Check -->
                <div class="step-content" id="stepContent7">
                    <div class="form-section">
                        <h2 class="section-title">SECTION G — SECURITY & BACKGROUND CHECK</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Are you a citizen of a country on U.S. national security risk
                                    lists?</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="securityNo" name="securityRisk" value="No">
                                        <label for="securityNo">No</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="securityYes" name="securityRisk" value="Yes">
                                        <label for="securityYes">Yes (cannot apply)</label>
                                    </div>
                                </div>
                                <div class="validation-error" id="securityRiskError">Please answer this question</div>
                            </div>
                            <div class="form-group">
                                <label class="required">Are you a citizen of a country restricted under ITAR
                                    regulations?</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="itarNo" name="itar" value="No">
                                        <label for="itarNo">No</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="itarYes" name="itar" value="Yes">
                                        <label for="itarYes">Yes (cannot apply)</label>
                                    </div>
                                </div>
                                <div class="validation-error" id="itarError">Please answer this question</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Criminal History</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="criminalNone" name="criminal" value="None" onchange="toggleCriminalExplanation()">
                                        <label for="criminalNone">None</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="criminalYes" name="criminal" value="Yes" onchange="toggleCriminalExplanation()">
                                        <label for="criminalYes">Yes (provide explanation & certified court
                                            records)</label>
                                    </div>
                                </div>
                                <div style="margin-top:8px; display:none;" id="criminalExplanationRow">
                                    <label for="criminalExplanation">Please provide explanation and details:</label>
                                    <textarea id="criminalExplanation" name="criminalExplanation" rows="3" placeholder="Provide details about your criminal history..."></textarea>
                                    <div class="validation-error" id="criminalExplanationError">Please provide an explanation</div>
                                </div>
                                <div class="validation-error" id="criminalError">Please indicate criminal history</div>
                            </div>
                            <div class="form-group">
                                <label class="required">Military Service</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="militaryNone" name="military" value="None">
                                        <label for="militaryNone">None</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="militaryYes" name="military" value="Yes">
                                        <label for="militaryYes">Yes (submit discharge documents)</label>
                                    </div>
                                </div>
                                <div class="validation-error" id="militaryError">Please indicate military service</div>
                            </div>
                        </div>

                        <div id="militaryFields" class="hidden">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required">Discharged for misconduct?</label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="misconductNo" name="misconduct" value="No">
                                            <label for="misconductNo">No</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="misconductYes" name="misconduct" value="Yes">
                                            <label for="misconductYes">Yes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required">Ongoing Investigations or Misconduct Cases</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="investigationsNo" name="investigations"
                                            value="No" onchange="toggleInvestigationsExplanation()">
                                        <label for="investigationsNo">No</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="investigationsYes" name="investigations"
                                            value="Yes" onchange="toggleInvestigationsExplanation()">
                                        <label for="investigationsYes">Yes (provide details)</label>
                                    </div>
                                </div>
                                <div style="margin-top:8px; display:none;" id="investigationsExplanationRow">
                                    <label for="investigationsExplanation">Please provide details:</label>
                                    <textarea id="investigationsExplanation" name="investigationsExplanation" rows="3" placeholder="Provide details about ongoing investigations or misconduct cases..."></textarea>
                                    <div class="validation-error" id="investigationsExplanationError">Please provide details</div>
                                </div>
                                <div class="validation-error" id="investigationsError">Please answer this question</div>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <button class="btn-prev" onclick="prevStep(7)">← Previous</button>
                        <button class="btn-next" onclick="nextStep(7)">Next: Review & Submit →</button>
                    </div>
                </div>

                <!-- Step 8: Review & Submit -->
                <div class="step-content" id="stepContent8">
                    <div class="summary">
                        <h3>Application Summary</h3>
                        <p>Please review all information before submitting. Make sure all details are accurate and complete.
                        </p>
                        <p><strong>Note:</strong> After submission, you will receive a confirmation email and the
                            administrator will be notified.</p>
                    </div>

                    <div class="form-section">
                        <h2 class="section-title">SECTION H — CONSOLIDATED DOCUMENTS CHECKLIST</h2>
                        <p>Please indicate which supporting documents are included with your application. Mark "Mandatory" as applicable and tick the status box when the document is attached.</p>
                        
                        <!-- Missing Documents Alert -->
                        <div id="missingDocumentsAlert" style="display: none; background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
                            <h4 style="color: #856404; margin-top: 0; margin-bottom: 10px;">⚠️ Missing Mandatory Documents</h4>
                            <p style="color: #856404; margin-bottom: 5px;">Please upload the following required documents:</p>
                            <ul id="missingDocumentsList" style="color: #856404; margin: 10px 0 0 20px;">
                                <!-- Missing documents will be listed here dynamically -->
                            </ul>
                        </div>
                        
                        <table class="documents-checklist" style="width:100%; border-collapse: collapse; margin-bottom:16px;">
                            <thead>
                                <tr style="text-align:left; border-bottom:1px solid #ddd;">
                                    <th style="padding:8px">Document</th>
                                    <th style="padding:8px">Mandatory</th>
                                    <th style="padding:8px">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:8px">Passport copy</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_passport" name="doc_passport" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_passportError')">
                                        <div class="validation-error" id="doc_passportError" style="display:none">Passport copy is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Medical degree diploma</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_diploma" name="doc_diploma" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_diplomaError')">
                                        <div class="validation-error" id="doc_diplomaError" style="display:none">Medical degree diploma is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Medical school transcripts</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_transcripts" name="doc_transcripts" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_transcriptsError')">
                                        <div class="validation-error" id="doc_transcriptsError" style="display:none">Medical school transcripts are required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Proof of ECFMG eligibility</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_ecfmg" name="doc_ecfmg" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_ecfmgError')">
                                        <div class="validation-error" id="doc_ecfmgError" style="display:none">Proof of ECFMG eligibility is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Copy of foreign medical license</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_foreign_license" name="doc_foreign_license" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" required onchange="validateFileSize(this, 2, 'doc_foreign_licenseError')">
                                        <div class="validation-error" id="doc_foreign_licenseError" style="display:none">License document is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Good standing certificate</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_good_standing" name="doc_good_standing" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_good_standingError')">
                                        <div class="validation-error" id="doc_good_standingError" style="display:none">Good standing certificate is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Disciplinary clearance letter</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_disciplinary" name="doc_disciplinary" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_disciplinaryError')">
                                        <div class="validation-error" id="doc_disciplinaryError" style="display:none">Disciplinary clearance letter is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Residency completion certificate</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_residency" name="doc_residency" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_residencyError')">
                                        <div class="validation-error" id="doc_residencyError" style="display:none">Residency completion certificate is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Employment experience letters / Clinical practice verification</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_experience" name="doc_experience" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_experienceError')">
                                        <div class="validation-error" id="doc_experienceError" style="display:none">Employment experience letters are required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">USMLE Step 1 score report</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_usmle1" name="doc_usmle1" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_usmle1Error')">
                                        <div class="validation-error" id="doc_usmle1Error" style="display:none">USMLE Step 1 score report is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">USMLE Step 2 score report</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_usmle2" name="doc_usmle2" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_usmle2Error')">
                                        <div class="validation-error" id="doc_usmle2Error" style="display:none">USMLE Step 2 score report is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Texas Jurisprudence Exam proof</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_jurisprudence" name="doc_jurisprudence" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_jurisprudenceError')">
                                        <div class="validation-error" id="doc_jurisprudenceError" style="display:none">Texas Jurisprudence Exam proof is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">English proficiency certificate</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_english" name="doc_english" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_englishError')">
                                        <div class="validation-error" id="doc_englishError" style="display:none">English proficiency certificate is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="docJobOfferLabel" style="padding:8px">Job offer letter from Texas facility</td>
                                    <td id="docJobOfferRequirementLabel" style="padding:8px">No</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_job_offer" name="doc_job_offer" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_job_offerError')">
                                        <div class="validation-error" id="doc_job_offerError" style="display:none">Job offer letter is required when Job Offer is Yes and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Contract (if available)</td>
                                    <td style="padding:8px">No</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_contract" name="doc_contract" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_contractError')">
                                        <div class="validation-error" id="doc_contractError" style="display:none">File must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Criminal background check</td>
                                    <td style="padding:8px">Yes</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_criminal" name="doc_criminal" required accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_criminalError')">
                                        <div class="validation-error" id="doc_criminalError" style="display:none">Criminal background check is required and must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Police clearance</td>
                                    <td style="padding:8px">No</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_police_clearance" name="doc_police_clearance" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_police_clearanceError')">
                                        <div class="validation-error" id="doc_police_clearanceError" style="display:none">File must be 2MB or smaller</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px">Military documents (if applicable)</td>
                                    <td style="padding:8px">No</td>
                                    <td style="padding:8px">
                                        <input type="file" id="doc_military" name="doc_military" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,image/*" onchange="validateFileSize(this, 2, 'doc_militaryError')">
                                        <div class="validation-error" id="doc_militaryError" style="display:none">File must be 2MB or smaller</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="form-section">
                        <h2 class="section-title">SECTION I — APPLICANT ATTESTATION</h2>
                        <p>I hereby certify that all information provided in this application is accurate, truthful, and
                            complete. I understand that providing false or misleading information may result in denial,
                            suspension, or revocation of licensure.</p>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="required" for="applicantSignature">Applicant Signature</label>
                                <input type="text" id="applicantSignature" name="applicantSignature"
                                    placeholder="Type your full name as signature">
                                <div class="validation-error" id="signatureError">Signature is required</div>
                            </div>
                            <div class="form-group">
                                <label class="required" for="signatureDate">Date</label>
                                <input type="date" id="signatureDate" name="signatureDate" value="<?php echo date('Y-m-d'); ?>">
                                <div class="validation-error" id="signatureDateError">Date is required</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-preview">
                        <h4>📋 Application Preview</h4>
                        <p style="margin-bottom: 20px; color: #6c757d;">Please review all your information carefully before submitting.</p>
                        <div id="formPreviewContent">
                            <!-- Preview content will be dynamically generated here -->
                        </div>
                    </div>

                    <div class="certification-box">
                        <label class="certification-checkbox" for="certifyCheckbox">
                            <input type="checkbox" id="certifyCheckbox" name="certifyCheckbox">
                            <span>I certify that the above record is correct and all information provided is accurate and truthful.</span>
                        </label>
                        <div class="certification-error" id="certifyError">You must certify that the information is correct before submitting</div>
                    </div>

                    <div class="buttons">
                        <button class="btn-prev" onclick="prevStep(8)">← Previous</button>
                        <button class="btn-submit" onclick="submitApplication()">Submit Application</button>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="success-message" id="successMessage">
                    <div class="success-icon">✓</div>
                    <h2>Application Submitted Successfully!</h2>
                    <div style="background: #e7f3ff; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #0054a4;">
                        <p style="margin: 0 0 10px 0; font-size: 16px;">Your Texas Doctor's Act Provisional Medical License application has been successfully submitted.</p>
                        <p style="margin: 0; color: #495057;"><strong>Application ID:</strong> <span id="applicationId" style="color: #0054a4; font-weight: 600;">TDA-2025-</span></p>
                    </div>
                    <div style="background: #d4edda; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #28a745;">
                        <p style="margin: 0; color: #155724;">✉️ Confirmation emails have been sent to you and the administrator.</p>
                    </div>
                    <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #ffc107;">
                        <p style="margin: 0; color: #856404;"><strong>Next Steps:</strong></p>
                        <ul style="margin: 10px 0 0 20px; color: #856404;">
                            <li>Check your email for confirmation and further instructions</li>
                            <li>Keep your Application ID for reference</li>
                            <li>You will be notified within 14 business days regarding the status</li>
                        </ul>
                    </div>
                    <button class="btn-next" onclick="resetForm()" style="margin-top: 20px;">Submit Another
                        Application</button>
                </div>
            </div>
        </div>

        <script>
            let currentStep = 1;
            const totalSteps = 8;
            let formData = {};

            // Initialize form
            document.addEventListener('DOMContentLoaded', function() {
                setupEventListeners();
                setupRealTimeValidation();
                updateProgressBar();
                enforceDateMax();
                
                // Initialize dynamic fields
                const deg = document.getElementById('degree');
                if (deg) toggleOtherDegree(deg.value);
                toggleLicensureExplanation();
                toggleDisciplinaryExplanation();
                toggleCriminalExplanation();
                toggleInvestigationsExplanation();
                toggleExamExplanation('step1');
                toggleExamExplanation('step2');
            });

            function enforceDateMax() {
                const today = new Date().toISOString().split('T')[0];
                document.querySelectorAll('input[type="date"]').forEach(input => {
                    input.setAttribute('max', today);
                    input.addEventListener('change', function() {
                        if (this.value && this.value > today) {
                            // For DOB, clear the invalid future selection and remind the user
                            const errId = this.id + 'Error';
                            const errEl = document.getElementById(errId);

                            if (errEl) {
                                errEl.textContent = 'Date cannot be in the future.';
                                errEl.style.display = 'block';
                            } else {
                                let msg = document.createElement('div');
                                msg.className = 'validation-error';
                                msg.id = errId;
                                msg.textContent = 'Date cannot be in the future.';
                                this.parentNode.appendChild(msg);
                            }

                            this.classList.add('error');
                            this.style.borderColor = '#dc3545';
                            this.style.boxShadow = '0 0 0 3px rgba(220,53,69,0.08)';

                            // Clear the invalid selection to force the user to pick a valid DOB
                            this.value = '';

                            // Focus DOB specifically so user corrects it
                            if (this.id === 'dob') {
                                this.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                this.focus();
                            }
                        } else {
                            clearValidation(this.id);
                        }
                    });
                });
            }

            function setupEventListeners() {
                // Visa status other text field
                document.getElementById('otherVisa').addEventListener('change', function() {
                    document.getElementById('otherVisaText').disabled = !this.checked;
                    if (this.checked) {
                        document.getElementById('otherVisaText').focus();
                    }
                });

                // Pathway selection
                document.querySelectorAll('input[name="pathway"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'Path A') {
                            document.getElementById('pathAFields').classList.remove('hidden');
                            document.getElementById('pathBFields').classList.add('hidden');
                            // Clear Path B validation if switching
                            clearValidation('totalPracticeYears');
                        } else if (this.value === 'Path B') {
                            document.getElementById('pathAFields').classList.add('hidden');
                            document.getElementById('pathBFields').classList.remove('hidden');
                            // Clear Path A validation if switching
                            clearValidation('residency');
                            clearValidation('residencyInstitution');
                            clearValidation('residencyFrom');
                            clearValidation('residencyTo');
                            clearValidation('postResidencyYears');
                        }
                    });
                });

                // Job offer selection
                document.querySelectorAll('input[name="jobOffer"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        const jobOfferDocument = document.getElementById('doc_job_offer');
                        const jobOfferLabel = document.getElementById('docJobOfferLabel');
                        const jobOfferRequirementLabel = document.getElementById('docJobOfferRequirementLabel');
                        if (this.value === 'Yes') {
                            document.getElementById('jobOfferFields').classList.remove('hidden');
                            if (jobOfferDocument) jobOfferDocument.required = true;
                            if (jobOfferLabel) {
                                jobOfferLabel.innerHTML = 'Job offer letter from Texas facility <span style="color:#dc3545">*</span>';
                            }
                            if (jobOfferRequirementLabel) jobOfferRequirementLabel.textContent = 'Yes';
                        } else {
                            document.getElementById('jobOfferFields').classList.add('hidden');
                            if (jobOfferDocument) {
                                jobOfferDocument.required = false;
                            }
                            if (jobOfferLabel) {
                                jobOfferLabel.textContent = 'Job offer letter from Texas facility';
                            }
                            if (jobOfferRequirementLabel) jobOfferRequirementLabel.textContent = 'No';
                            // Clear job offer validation if switching to No
                            const jobOfferFields = [
                                'employerName', 'facilityType', 'employerAddress', 'contactPerson',
                                'designation', 'contactPhone', 'contactEmail', 'doc_job_offer'
                            ];
                            jobOfferFields.forEach(field => clearValidation(field));
                        }
                    });
                });

                const selectedJobOffer = document.querySelector('input[name="jobOffer"]:checked')?.value;
                const jobOfferDocument = document.getElementById('doc_job_offer');
                const jobOfferLabel = document.getElementById('docJobOfferLabel');
                const jobOfferRequirementLabel = document.getElementById('docJobOfferRequirementLabel');
                if (jobOfferDocument) {
                    jobOfferDocument.required = selectedJobOffer === 'Yes';
                }
                if (jobOfferLabel) {
                    jobOfferLabel.innerHTML = selectedJobOffer === 'Yes'
                        ? 'Job offer letter from Texas facility <span style="color:#dc3545">*</span>'
                        : 'Job offer letter from Texas facility';
                }
                if (jobOfferRequirementLabel) {
                    jobOfferRequirementLabel.textContent = selectedJobOffer === 'Yes' ? 'Yes' : 'No';
                }

                // Military service selection
                document.querySelectorAll('input[name="military"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'Yes') {
                            document.getElementById('militaryFields').classList.remove('hidden');
                        } else {
                            document.getElementById('militaryFields').classList.add('hidden');
                            clearValidation('misconduct');
                        }
                    });
                });

                // Form change listeners removed - preview generated only when entering step 8
                
                // Certification checkbox listener
                const certifyCheckbox = document.getElementById('certifyCheckbox');
                if (certifyCheckbox) {
                    certifyCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            document.getElementById('certifyError').style.display = 'none';
                        }
                    });
                }

                // Enforce min/max on numeric conditional fields and show inline errors
                const postEl = document.getElementById('postResidencyYears');
                if (postEl) {
                    postEl.addEventListener('input', function() {
                        const val = parseInt(this.value || '');
                        const err = document.getElementById('postResidencyYearsError');
                        if (isNaN(val)) {
                            if (err) err.style.display = 'block';
                            return;
                        }
                        if (val > 50) {
                            this.value = 50;
                            if (err) {
                                err.textContent = 'The post residency years field must not be greater than 50.';
                                err.style.display = 'block';
                            }
                        } else if (val < 5) {
                            if (err) {
                                err.textContent = 'Minimum 5 years required';
                                err.style.display = 'block';
                            }
                        } else {
                            clearValidation('postResidencyYears');
                        }
                    });
                }

                const totalEl = document.getElementById('totalPracticeYears');
                if (totalEl) {
                    totalEl.addEventListener('input', function() {
                        const val = parseInt(this.value || '');
                        const err = document.getElementById('totalPracticeYearsError');
                        if (isNaN(val)) {
                            if (err) err.style.display = 'block';
                            return;
                        }
                        if (val > 50) {
                            this.value = 50;
                            if (err) {
                                err.textContent = 'The total practice years field must not be greater than 50.';
                                err.style.display = 'block';
                            }
                        } else if (val < 10) {
                            if (err) {
                                err.textContent = 'Minimum 10 years required';
                                err.style.display = 'block';
                            }
                        } else {
                            clearValidation('totalPracticeYears');
                        }
                    });
                }
            }

            function toggleOtherDegree(value) {
                const row = document.getElementById('otherDegreeRow');
                const input = document.getElementById('otherDegree');
                const error = document.getElementById('otherDegreeError');
                if (!row || !input) return;
                if (value === 'Other') {
                    row.style.display = 'block';
                    input.disabled = false;
                } else {
                    row.style.display = 'none';
                    input.disabled = true;
                    if (error) error.style.display = 'none';
                    input.classList.remove('error');
                }
            }

            function toggleLicensureExplanation(event) {
                // Use a small timeout to ensure the radio button is checked
                setTimeout(() => {
                    const row = document.getElementById('licensureExplanationRow');
                    const input = document.getElementById('licensureExplanation');
                    const error = document.getElementById('licensureExplanationError');
                    if (!row || !input) return;
                    const selectedValue = document.querySelector('input[name="licensureStatus"]:checked')?.value;
                    if (selectedValue === 'Not in Good Standing') {
                        row.style.display = 'block';
                        input.disabled = false;
                        input.focus();
                    } else {
                        row.style.display = 'none';
                        input.disabled = true;
                        if (error) error.style.display = 'none';
                        input.classList.remove('error');
                        input.value = '';
                    }
                }, 10);
            }

            function toggleDisciplinaryExplanation(event) {
                // Use a small timeout to ensure the radio button is checked
                setTimeout(() => {
                    const row = document.getElementById('disciplinaryExplanationRow');
                    const input = document.getElementById('disciplinaryExplanation');
                    const error = document.getElementById('disciplinaryExplanationError');
                    if (!row || !input) return;
                    const selectedValue = document.querySelector('input[name="disciplinary"]:checked')?.value;
                    if (selectedValue === 'Yes') {
                        row.style.display = 'block';
                        input.disabled = false;
                        input.focus();
                    } else {
                        row.style.display = 'none';
                        input.disabled = true;
                        if (error) error.style.display = 'none';
                        input.classList.remove('error');
                        input.value = '';
                    }
                }, 10);
            }

            function toggleCriminalExplanation(event) {
                // Use a small timeout to ensure the radio button is checked
                setTimeout(() => {
                    const row = document.getElementById('criminalExplanationRow');
                    const input = document.getElementById('criminalExplanation');
                    const error = document.getElementById('criminalExplanationError');
                    if (!row || !input) return;
                    const selectedValue = document.querySelector('input[name="criminal"]:checked')?.value;
                    if (selectedValue === 'Yes') {
                        row.style.display = 'block';
                        input.disabled = false;
                        input.focus();
                    } else {
                        row.style.display = 'none';
                        input.disabled = true;
                        if (error) error.style.display = 'none';
                        input.classList.remove('error');
                        input.value = '';
                    }
                }, 10);
            }

            function toggleInvestigationsExplanation(event) {
                // Use a small timeout to ensure the radio button is checked
                setTimeout(() => {
                    const row = document.getElementById('investigationsExplanationRow');
                    const input = document.getElementById('investigationsExplanation');
                    const error = document.getElementById('investigationsExplanationError');
                    if (!row || !input) return;
                    const selectedValue = document.querySelector('input[name="investigations"]:checked')?.value;
                    if (selectedValue === 'Yes') {
                        row.style.display = 'block';
                        input.disabled = false;
                        input.focus();
                    } else {
                        row.style.display = 'none';
                        input.disabled = true;
                        if (error) error.style.display = 'none';
                        input.classList.remove('error');
                        input.value = '';
                    }
                }, 10);
            }

            function toggleExamExplanation(examType) {
                // Use a small timeout to ensure the radio button is checked
                setTimeout(() => {
                    const row = document.getElementById(`${examType}ExplanationRow`);
                    const input = document.getElementById(`${examType}Explanation`);
                    const error = document.getElementById(`${examType}ExplanationError`);
                    if (!row || !input) return;
                    const selectedValue = document.querySelector(`input[name="${examType}"]:checked`)?.value;
                    if (selectedValue === 'Pending' || selectedValue === 'Not Attempted') {
                        row.style.display = 'block';
                        input.disabled = false;
                        input.focus();
                    } else {
                        row.style.display = 'none';
                        input.disabled = true;
                        if (error) error.style.display = 'none';
                        input.classList.remove('error');
                        input.value = '';
                    }
                }, 10);
            }

            function setupRealTimeValidation() {
                // For text inputs, textareas, selects
                document.querySelectorAll('input:not([type="radio"]):not([type="checkbox"]), textarea, select').forEach(
                input => {
                    input.addEventListener('input', function() {
                        clearValidation(this.id);
                    });

                    // Add focus/blur events for better UX
                    input.addEventListener('focus', function() {
                        this.style.borderColor = '#0054a4';
                        this.style.boxShadow = '0 0 0 3px rgba(0, 84, 164, 0.1)';
                    });

                    input.addEventListener('blur', function() {
                        if (!this.classList.contains('error')) {
                            this.style.borderColor = '#ced4da';
                            this.style.boxShadow = 'none';
                        }
                    });
                });

                // For radio buttons
                document.querySelectorAll('input[type="radio"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        const name = this.name;
                        clearRadioValidation(name);
                    });
                });

                // For date inputs
                document.querySelectorAll('input[type="date"]').forEach(input => {
                    input.addEventListener('change', function() {
                        if (this.value) {
                            clearValidation(this.id);
                        }
                    });
                });

                // For number inputs
                document.querySelectorAll('input[type="number"]').forEach(input => {
                    input.addEventListener('input', function() {
                        if (this.value) {
                            clearValidation(this.id);
                        }
                    });
                });

                // For email inputs
                document.querySelectorAll('input[type="email"]').forEach(input => {
                    input.addEventListener('input', function() {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (emailRegex.test(this.value.trim())) {
                            clearValidation(this.id);
                        }
                    });
                });
            }

            function clearValidation(fieldId) {
                const errorId = fieldId + 'Error';
                const errorElement = document.getElementById(errorId);
                const inputElement = document.getElementById(fieldId);

                if (errorElement && errorElement.style.display !== 'none') {
                    // Check if the field now has valid value
                    let isValid = false;

                    if (inputElement) {
                        if (inputElement.type === 'radio' || inputElement.type === 'checkbox') {
                            // For radio groups, we use clearRadioValidation instead
                            return;
                        } else if (inputElement.type === 'email') {
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            isValid = emailRegex.test(inputElement.value.trim());
                        } else if (inputElement.type === 'number') {
                            const min = parseInt(inputElement.min) || 0;
                            const value = parseInt(inputElement.value) || 0;
                            isValid = !isNaN(value) && value >= min;
                        } else if (inputElement.type === 'date') {
                            isValid = inputElement.value !== '';
                        } else {
                            isValid = inputElement.value.trim() !== '';
                        }

                        if (isValid) {
                            errorElement.style.display = 'none';
                            inputElement.classList.remove('error');
                            inputElement.style.borderColor = '#ced4da';
                            inputElement.style.boxShadow = 'none';
                        }
                    }
                }
            }

            function clearRadioValidation(radioName) {
                const errorId = radioName + 'Error';
                const errorElement = document.getElementById(errorId);

                if (errorElement) {
                    // Check if any radio in this group is selected
                    const radios = document.querySelectorAll(`input[name="${radioName}"]`);
                    let hasSelection = false;
                    radios.forEach(r => {
                        if (r.checked) hasSelection = true;
                    });

                    if (hasSelection) {
                        errorElement.style.display = 'none';
                        // Remove error styling from all radios in group
                        radios.forEach(r => {
                            r.classList.remove('error');
                            const container = r.closest('.radio-option');
                            if (container) {
                                container.style.color = '';
                            }
                        });
                    }
                }
            }

            function validateStep(step) {
                let isValid = true;
                const errors = [];

                // Reset all errors for this step
                document.querySelectorAll('.validation-error').forEach(error => {
                    error.style.display = 'none';
                    // Reset specific error messages to defaults
                    if (error.id === 'expiryDateError') {
                        error.textContent = 'Expiry date is required';
                    }
                    if (error.id === 'residencyToError') {
                        error.textContent = 'End date is required';
                    }
                    if (error.id === 'licensureExplanationError') {
                        error.textContent = 'Please provide an explanation';
                    }
                    if (error.id === 'disciplinaryExplanationError') {
                        error.textContent = 'Please provide an explanation';
                    }
                    if (error.id === 'step1Error') {
                        error.textContent = 'Please select USMLE Step 1 status';
                    }
                    if (error.id === 'step2Error') {
                        error.textContent = 'Please select USMLE Step 2 status';
                    }
                });
                document.querySelectorAll('.error').forEach(input => {
                    input.classList.remove('error');
                    input.style.borderColor = '#ced4da';
                    input.style.boxShadow = 'none';

                    // Reset file input background
                    if (input.type === 'file') {
                        input.style.backgroundColor = '';
                    }

                    // Reset radio option styling
                    const container = input.closest('.radio-option');
                    if (container) {
                        container.style.color = '';
                    }
                    
                    // Reset table row styling for file inputs
                    const row = input.closest('tr');
                    if (row && input.type === 'file') {
                        row.style.backgroundColor = '';
                        row.style.borderLeft = '';
                    }
                });

                switch (step) {
                    case 1:
                        // Personal Information validation
                        if (!validateRequired('fullName')) {
                            isValid = false;
                            errors.push('fullNameError');
                        }
                        if (!validateRequired('dob')) {
                            isValid = false;
                            errors.push('dobError');
                        }
                        if (!validateRadioGroup('gender')) {
                            isValid = false;
                            errors.push('genderError');
                        }
                        if (!validateRequired('citizenship')) {
                            isValid = false;
                            errors.push('citizenshipError');
                        }
                        if (!validateRequired('passport')) {
                            isValid = false;
                            errors.push('passportError');
                        }
                        if (!validateEmail('email')) {
                            isValid = false;
                            errors.push('emailError');
                        }
                        if (!validateRequired('phone')) {
                            isValid = false;
                            errors.push('phoneError');
                        }
                        if (!validateRadioGroup('visaStatus')) {
                            isValid = false;
                            errors.push('visaStatusError');
                        }
                        // Handle other visa text
                        if (document.querySelector('input[name="visaStatus"]:checked')?.value === 'Other') {
                            if (!validateRequired('otherVisaText')) {
                                isValid = false;
                                errors.push('visaStatusError');
                            }
                        }
                        break;

                    case 2:
                        // Medical Education validation
                        if (!validateRequired('degree')) {
                            isValid = false;
                            errors.push('degreeError');
                        }
                        // If degree is Other, require specification
                        const degSel = document.getElementById('degree');
                        if (degSel && degSel.value === 'Other') {
                            if (!validateRequired('otherDegree')) {
                                isValid = false;
                                errors.push('otherDegreeError');
                            }
                        }
                        if (!validateRequired('medicalSchool')) {
                            isValid = false;
                            errors.push('medicalSchoolError');
                        }
                        if (!validateRequired('schoolCountry')) {
                            isValid = false;
                            errors.push('schoolCountryError');
                        }
                        if (!validateRequired('graduationYear')) {
                            isValid = false;
                            errors.push('graduationYearError');
                        }
                        if (!validateRadioGroup('ecfmg')) {
                            isValid = false;
                            errors.push('ecfmgError');
                        } else {
                            // Check if ECFMG is Yes
                            const ecfmgValue = document.querySelector('input[name="ecfmg"]:checked').value;
                            if (ecfmgValue === 'No') {
                                isValid = false;
                                errors.push('ecfmgError');
                            }
                        }
                        break;

                    case 3:
                        // Foreign Medical Licensure validation
                        if (!validateRequired('licenseCountry')) {
                            isValid = false;
                            errors.push('licenseCountryError');
                        }
                        if (!validateRequired('licenseNumber')) {
                            isValid = false;
                            errors.push('licenseNumberError');
                        }
                        if (!validateRequired('issueDate')) {
                            isValid = false;
                            errors.push('issueDateError');
                        }
                        if (!validateRequired('expiryDate')) {
                            isValid = false;
                            errors.push('expiryDateError');
                        }
                        // Validate that issue date is before expiry date
                        const issueDate = document.getElementById('issueDate').value;
                        const expiryDate = document.getElementById('expiryDate').value;
                        if (issueDate && expiryDate) {
                            const issue = new Date(issueDate);
                            const expiry = new Date(expiryDate);
                            if (issue >= expiry) {
                                isValid = false;
                                document.getElementById('expiryDateError').textContent = 'Expiry date must be after issue date';
                                errors.push('expiryDateError');
                            }
                        }
                        if (!validateRadioGroup('licensureStatus')) {
                            isValid = false;
                            errors.push('licensureStatusError');
                        } else {
                            // If Not in Good Standing, require explanation
                            const licensureValue = document.querySelector('input[name="licensureStatus"]:checked').value;
                            if (licensureValue === 'Not in Good Standing') {
                                if (!validateRequired('licensureExplanation')) {
                                    isValid = false;
                                    errors.push('licensureExplanationError');
                                }
                            }
                        }
                        if (!validateRadioGroup('disciplinary')) {
                            isValid = false;
                            errors.push('disciplinaryError');
                        } else {
                            // If Yes, require explanation
                            const disciplinaryValue = document.querySelector('input[name="disciplinary"]:checked').value;
                            if (disciplinaryValue === 'Yes') {
                                if (!validateRequired('disciplinaryExplanation')) {
                                    isValid = false;
                                    errors.push('disciplinaryExplanationError');
                                }
                            }
                        }
                        if (!document.getElementById('uploadDocument')?.files?.length) {
                            isValid = false;
                            document.getElementById('uploadDocumentError').style.display = 'block';
                            errors.push('uploadDocumentError');
                        }
                        break;

                    case 4:
                        // Postgraduate Training validation
                        if (!validateRadioGroup('pathway')) {
                            isValid = false;
                            errors.push('pathwayError');
                        }

                        const pathway = document.querySelector('input[name="pathway"]:checked');
                        if (pathway) {
                            if (pathway.value === 'Path A') {
                                if (!validateRadioGroup('residency')) {
                                    isValid = false;
                                    errors.push('residencyError');
                                }
                                if (!validateRequired('residencyInstitution')) {
                                    isValid = false;
                                    errors.push('residencyInstitutionError');
                                }
                                if (!validateRequired('residencyFrom')) {
                                    isValid = false;
                                    errors.push('residencyFromError');
                                }
                                if (!validateRequired('residencyTo')) {
                                    isValid = false;
                                    errors.push('residencyToError');
                                }

                                // Ensure residencyTo is after residencyFrom
                                const fromVal = document.getElementById('residencyFrom')?.value;
                                const toVal = document.getElementById('residencyTo')?.value;
                                if (fromVal && toVal) {
                                    const fromDate = new Date(fromVal);
                                    const toDate = new Date(toVal);
                                    if (toDate <= fromDate) {
                                        isValid = false;
                                        document.getElementById('residencyToError').textContent = 'End date must be after start date';
                                        errors.push('residencyToError');
                                    }
                                }

                                // postResidencyYears must be between 5 and 50
                                const postEl = document.getElementById('postResidencyYears');
                                if (postEl) {
                                    const postVal = parseInt(postEl.value) || 0;
                                    if (postVal < 5 || postVal > 50) {
                                        isValid = false;
                                        errors.push('postResidencyYearsError');
                                    }
                                }

                            } else if (pathway.value === 'Path B') {
                                // totalPracticeYears must be between 10 and 50
                                const totalEl = document.getElementById('totalPracticeYears');
                                if (totalEl) {
                                    const totalVal = parseInt(totalEl.value) || 0;
                                    if (totalVal < 10 || totalVal > 50) {
                                        isValid = false;
                                        errors.push('totalPracticeYearsError');
                                    }
                                }
                            }
                        }
                        break;

                    case 5:
                        // Exam Requirements validation
                        if (!validateRadioGroup('step1')) {
                            isValid = false;
                            errors.push('step1Error');
                        }
                        if (!validateRadioGroup('step2')) {
                            isValid = false;
                            errors.push('step2Error');
                        }
                        // Check if either USMLE step is "Not Attempted"
                        const step1Value = document.querySelector('input[name="step1"]:checked')?.value;
                        const step2Value = document.querySelector('input[name="step2"]:checked')?.value;
                        if (step1Value === 'Not Attempted' || step2Value === 'Not Attempted') {
                            isValid = false;
                            if (step1Value === 'Not Attempted') {
                                document.getElementById('step1Error').textContent = 'USMLE Step 1 must be attempted to proceed';
                                errors.push('step1Error');
                            }
                            if (step2Value === 'Not Attempted') {
                                document.getElementById('step2Error').textContent = 'USMLE Step 2 must be attempted to proceed';
                                errors.push('step2Error');
                            }
                        }
                        if (!validateRadioGroup('jurisprudence')) {
                            isValid = false;
                            errors.push('jurisprudenceError');
                        }
                        if (!validateRadioGroup('english')) {
                            isValid = false;
                            errors.push('englishError');
                        }
                        break;

                    case 6:
                        // Employment validation
                        if (!validateRadioGroup('jobOffer')) {
                            isValid = false;
                            errors.push('jobOfferError');
                        }

                        const jobOffer = document.querySelector('input[name="jobOffer"]:checked');
                        if (jobOffer && jobOffer.value === 'Yes') {
                            if (!validateRequired('employerName')) {
                                isValid = false;
                                errors.push('employerNameError');
                            }
                            if (!validateRadioGroup('facilityType')) {
                                isValid = false;
                                errors.push('facilityTypeError');
                            }
                            if (!validateRequired('employerAddress')) {
                                isValid = false;
                                errors.push('employerAddressError');
                            }
                            if (!validateRequired('contactPerson')) {
                                isValid = false;
                                errors.push('contactPersonError');
                            }
                            if (!validateRequired('designation')) {
                                isValid = false;
                                errors.push('designationError');
                            }
                            if (!validateRequired('contactPhone')) {
                                isValid = false;
                                errors.push('contactPhoneError');
                            }
                            if (!validateEmail('contactEmail')) {
                                isValid = false;
                                errors.push('contactEmailError');
                            }
                        }
                        break;

                    case 7:
                        // Security & Background validation
                        if (!validateRadioGroup('securityRisk')) {
                            isValid = false;
                            errors.push('securityRiskError');
                        } else {
                            // If Yes, prevent progression
                            const securityValue = document.querySelector('input[name="securityRisk"]:checked').value;
                            if (securityValue === 'Yes') {
                                isValid = false;
                                document.getElementById('securityRiskError').textContent = 'You are not eligible to apply if you are a citizen of a country on U.S. national security risk lists';
                                errors.push('securityRiskError');
                            }
                        }
                        if (!validateRadioGroup('itar')) {
                            isValid = false;
                            errors.push('itarError');
                        } else {
                            // If Yes, prevent progression
                            const itarValue = document.querySelector('input[name="itar"]:checked').value;
                            if (itarValue === 'Yes') {
                                isValid = false;
                                document.getElementById('itarError').textContent = 'You are not eligible to apply if you are a citizen of a country restricted under ITAR regulations';
                                errors.push('itarError');
                            }
                        }
                        if (!validateRadioGroup('criminal')) {
                            isValid = false;
                            errors.push('criminalError');
                        } else {
                            // If Yes, require explanation
                            const criminalValue = document.querySelector('input[name="criminal"]:checked').value;
                            if (criminalValue === 'Yes') {
                                if (!validateRequired('criminalExplanation')) {
                                    isValid = false;
                                    errors.push('criminalExplanationError');
                                }
                            }
                        }
                        if (!validateRadioGroup('military')) {
                            isValid = false;
                            errors.push('militaryError');
                        }
                        // Misconduct only required if military is Yes
                        const military = document.querySelector('input[name="military"]:checked');
                        if (military && military.value === 'Yes') {
                            if (!validateRadioGroup('misconduct')) {
                                isValid = false;
                                errors.push('militaryError'); // Use same error field
                            }
                        }
                        if (!validateRadioGroup('investigations')) {
                            isValid = false;
                            errors.push('investigationsError');
                        } else {
                            // If Yes, require details
                            const investigationsValue = document.querySelector('input[name="investigations"]:checked').value;
                            if (investigationsValue === 'Yes') {
                                if (!validateRequired('investigationsExplanation')) {
                                    isValid = false;
                                    errors.push('investigationsExplanationError');
                                }
                            }
                        }
                        break;

                    case 8:
                        // Final validation
                        if (!validateRequired('applicantSignature')) {
                            isValid = false;
                            errors.push('signatureError');
                        }
                        if (!validateRequired('signatureDate')) {
                            isValid = false;
                            errors.push('signatureDateError');
                        }
                        
                        // Validate all mandatory documents from Section H
                        const mandatoryDocuments = [
                            { id: 'doc_passport', name: 'Passport copy' },
                            { id: 'doc_diploma', name: 'Medical degree diploma' },
                            { id: 'doc_transcripts', name: 'Medical school transcripts' },
                            { id: 'doc_ecfmg', name: 'Proof of ECFMG eligibility' },
                            { id: 'doc_foreign_license', name: 'Copy of foreign medical license' },
                            { id: 'doc_good_standing', name: 'Good standing certificate' },
                            { id: 'doc_disciplinary', name: 'Disciplinary clearance letter' },
                            { id: 'doc_residency', name: 'Residency completion certificate' },
                            { id: 'doc_experience', name: 'Employment experience letters / Clinical practice verification' },
                            { id: 'doc_usmle1', name: 'USMLE Step 1 score report' },
                            { id: 'doc_usmle2', name: 'USMLE Step 2 score report' },
                            { id: 'doc_jurisprudence', name: 'Texas Jurisprudence Exam proof' },
                            { id: 'doc_english', name: 'English proficiency certificate' },
                            { id: 'doc_criminal', name: 'Criminal background check' }
                        ];

                        const hasJobOffer = document.querySelector('input[name="jobOffer"]:checked')?.value === 'Yes';
                        if (hasJobOffer) {
                            mandatoryDocuments.push({ id: 'doc_job_offer', name: 'Job offer letter from Texas facility' });
                        }

                        mandatoryDocuments.forEach(doc => {
                            const docInput = document.getElementById(doc.id);
                            const errorElement = document.getElementById(doc.id + 'Error');
                            
                            if (!docInput || !docInput.files || docInput.files.length === 0) {
                                isValid = false;
                                if (errorElement) {
                                    errorElement.textContent = `${doc.name} is required (PDF or image, max 2MB)`;
                                }
                                errors.push(doc.id + 'Error');
                            }
                        });
                        
                        // Check certification checkbox
                        const certifyCheckbox = document.getElementById('certifyCheckbox');
                        if (!certifyCheckbox || !certifyCheckbox.checked) {
                            isValid = false;
                            document.getElementById('certifyError').style.display = 'block';
                        }
                        break;
                }

                // Show errors with proper styling
                errors.forEach(errorId => {
                    document.getElementById(errorId).style.display = 'block';
                    const inputId = errorId.replace('Error', '');

                    // For radio groups
                    if (['gender', 'visaStatus', 'ecfmg', 'licensureStatus', 'disciplinary', 'pathway',
                            'residency', 'step1', 'step2', 'jurisprudence', 'english', 'jobOffer',
                            'facilityType', 'securityRisk', 'itar', 'criminal', 'military',
                            'misconduct', 'investigations'
                        ].includes(inputId)) {

                        const radios = document.querySelectorAll(`input[name="${inputId}"]`);
                        radios.forEach(radio => {
                            radio.classList.add('error');
                            const container = radio.closest('.radio-option');
                            if (container) {
                                container.style.color = '#dc3545';
                            }
                        });
                    } else {
                        // For regular inputs and file inputs
                        const input = document.getElementById(inputId);
                        if (input) {
                            input.classList.add('error');
                            input.style.borderColor = '#dc3545';
                            input.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
                            
                            // Add background highlight for file inputs
                            if (input.type === 'file') {
                                input.style.backgroundColor = '#fff5f5';
                                // Highlight the table row containing the file input
                                const row = input.closest('tr');
                                if (row) {
                                    row.style.backgroundColor = '#fff5f5';
                                    row.style.borderLeft = '4px solid #dc3545';
                                }
                            }
                        }
                    }
                });

                // Scroll to first error for better UX
                if (errors.length > 0) {
                    const firstErrorId = errors[0];
                    const firstErrorElement = document.getElementById(firstErrorId);
                    if (firstErrorElement) {
                        firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }

                return isValid;
            }

            function validateRequired(fieldId) {
                const element = document.getElementById(fieldId);
                if (!element) return true;

                if (element.type === 'radio' || element.type === 'checkbox') {
                    return document.querySelector(`input[name="${fieldId}"]:checked`) !== null;
                }

                return element.value.trim() !== '';
            }

            function validateEmail(fieldId) {
                const element = document.getElementById(fieldId);
                if (!element) return true;
                const email = element.value.trim();
                if (email === '') return false;
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function validateRadioGroup(name) {
                return document.querySelector(`input[name="${name}"]:checked`) !== null;
            }

            function validateMinNumber(fieldId, min) {
                const element = document.getElementById(fieldId);
                if (!element) return true;
                const value = parseInt(element.value);
                return !isNaN(value) && value >= min;
            }

            function nextStep(current) {
                if (validateStep(current)) {
                    // Save current step data
                    saveStepData(current);

                    // Move to next step
                    document.getElementById(`stepContent${current}`).classList.remove('active');
                    document.getElementById(`step${current}`).classList.remove('active');
                    document.getElementById(`step${current}`).classList.add('completed');

                    currentStep = current + 1;

                    document.getElementById(`stepContent${currentStep}`).classList.add('active');
                    document.getElementById(`step${currentStep}`).classList.remove('pending');
                    document.getElementById(`step${currentStep}`).classList.add('active');

                    updateProgressBar();
                    
                    // Generate form preview when moving to step 8
                    if (currentStep === 8) {
                        generateFormPreview();
                    }

                    // Scroll to top of form
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            }

            function prevStep(current) {
                // Move to previous step
                document.getElementById(`stepContent${current}`).classList.remove('active');
                document.getElementById(`step${current}`).classList.remove('active');

                currentStep = current - 1;

                document.getElementById(`stepContent${currentStep}`).classList.add('active');
                document.getElementById(`step${currentStep}`).classList.add('active');

                updateProgressBar();

                // Scroll to top of form
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            function saveStepData(step) {
                // Collect all form data for the step
                const form = document.getElementById(`stepContent${step}`);
                const inputs = form.querySelectorAll('input, select, textarea');

                inputs.forEach(input => {
                    if (input.type === 'radio') {
                        if (input.checked) {
                            formData[input.name] = input.value;
                            // Special handling for other visa text
                            if (input.name === 'visaStatus' && input.value === 'Other') {
                                formData['otherVisaText'] = document.getElementById('otherVisaText').value;
                            }
                        }
                    } else if (input.type === 'file') {
                        formData[input.name] = (input.files && input.files.length) ? input.files[0].name : '';
                    } else if (input.type !== 'radio') {
                        formData[input.name] = input.value;
                    }
                });
            }

            function updateProgressBar() {
                const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
                document.getElementById('progressBar').style.width = `${progress}%`;
            }

            function generateFormPreview() {
                saveAllFormData();
                // Ensure any conditional explanation fields are captured (defensive read)
                [
                    'licensureExplanation', 'disciplinaryExplanation', 'criminalExplanation',
                    'investigationsExplanation', 'step1Explanation', 'step2Explanation',
                    'genderExplanation', 'otherDegree', 'otherVisaText'
                ].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) {
                        formData[id] = el.value || '';
                    }
                });
                // debug log removed
                const previewContainer = document.getElementById('formPreviewContent');
                let previewHTML = '';

                // Section A - Personal Information
                previewHTML += '<div class="preview-section">';
                previewHTML += '<h5>Section A — Personal Information</h5>';
                previewHTML += createPreviewRow('Full Name', formData.fullName);
                previewHTML += createPreviewRow('Date of Birth', formData.dob ? new Date(formData.dob).toLocaleDateString() : '');
                previewHTML += createPreviewRow('Gender', formData.gender);
                previewHTML += createPreviewRow('Country of Citizenship', formData.citizenship);
                previewHTML += createPreviewRow('Passport Number', formData.passport);
                previewHTML += createPreviewRow('Email Address', formData.email);
                previewHTML += createPreviewRow('Phone Number', formData.phone);
                previewHTML += createPreviewRow('U.S. Address', formData.address);
                let visaStatus = formData.visaStatus;
                if (visaStatus === 'Other' && formData.otherVisaText) {
                    visaStatus += ': ' + formData.otherVisaText;
                }
                previewHTML += createPreviewRow('Visa/Work Status', visaStatus);
                previewHTML += '</div>';

                // Section B - Medical Education
                previewHTML += '<div class="preview-section">';
                previewHTML += '<h5>Section B — Medical Education</h5>';
                let medicalDegree = formData.degree;
                if (medicalDegree === 'Other' && formData.otherDegree) {
                    medicalDegree += ': ' + formData.otherDegree;
                }
                previewHTML += createPreviewRow('Medical Degree', medicalDegree);
                previewHTML += createPreviewRow('Medical School Name', formData.medicalSchool);
                previewHTML += createPreviewRow('Country of Medical School', formData.schoolCountry);
                previewHTML += createPreviewRow('Year of Graduation', formData.graduationYear);
                previewHTML += createPreviewRow('ECFMG Eligibility', formData.ecfmg);
                previewHTML += '</div>';

                // Section C - Foreign Medical Licensure
                previewHTML += '<div class="preview-section">';
                previewHTML += '<h5>Section C — Foreign Medical Licensure</h5>';
                previewHTML += createPreviewRow('Country of Current Medical License', formData.licenseCountry);
                previewHTML += createPreviewRow('License Number', formData.licenseNumber);
                previewHTML += createPreviewRow('Issue Date', formData.issueDate ? new Date(formData.issueDate).toLocaleDateString() : '');
                previewHTML += createPreviewRow('Expiry Date', formData.expiryDate ? new Date(formData.expiryDate).toLocaleDateString() : '');
                let licensureStatus = formData.licensureStatus;
                if (licensureStatus === 'Not in Good Standing' && formData.licensureExplanation) {
                    licensureStatus += ': ' + formData.licensureExplanation;
                }
                previewHTML += createPreviewRow('Licensure Status', licensureStatus);
                let disciplinaryHistory = formData.disciplinary;
                if (disciplinaryHistory === 'Yes' && formData.disciplinaryExplanation) {
                    disciplinaryHistory += ': ' + formData.disciplinaryExplanation;
                }
                previewHTML += createPreviewRow('Disciplinary History', disciplinaryHistory);
                previewHTML += createPreviewRow('Uploaded Document', formData.uploadDocument);
                previewHTML += '</div>';

                // Section D - Postgraduate Training & Experience
                previewHTML += '<div class="preview-section">';
                previewHTML += '<h5>Section D — Postgraduate Training & Experience</h5>';
                previewHTML += createPreviewRow('Pathway', formData.pathway);
                
                if (formData.pathway === 'Path A') {
                    previewHTML += createPreviewRow('Completed ACGME Residency', formData.residency);
                    previewHTML += createPreviewRow('Residency Institution', formData.residencyInstitution);
                    previewHTML += createPreviewRow('Residency Period', 
                        (formData.residencyFrom ? new Date(formData.residencyFrom).toLocaleDateString() : '') + ' to ' + 
                        (formData.residencyTo ? new Date(formData.residencyTo).toLocaleDateString() : ''));
                    previewHTML += createPreviewRow('Post-Residency Practice Years', formData.postResidencyYears);
                } else if (formData.pathway === 'Path B') {
                    previewHTML += createPreviewRow('Total Practice Years', formData.totalPracticeYears);
                }
                previewHTML += '</div>';

                // Section E - Exam Compliance
                previewHTML += '<div class="preview-section">';
                previewHTML += '<h5>Section E — Exam Compliance</h5>';
                
                let step1Display = formData.step1;
                if ((step1Display === 'Pending' || step1Display === 'Not Attempted') && formData.step1Explanation) {
                    step1Display += ': ' + formData.step1Explanation;
                }
                previewHTML += createPreviewRow('USMLE Step 1 Status', step1Display);
                
                let step2Display = formData.step2;
                if ((step2Display === 'Pending' || step2Display === 'Not Attempted') && formData.step2Explanation) {
                    step2Display += ': ' + formData.step2Explanation;
                }
                previewHTML += createPreviewRow('USMLE Step 2 CK Status', step2Display);
                
                previewHTML += createPreviewRow('Jurisprudence Exam', formData.jurisprudence);
                previewHTML += createPreviewRow('English Proficiency', formData.english);
                previewHTML += '</div>';

                // Section F - Employment Details
                previewHTML += '<div class="preview-section">';
                previewHTML += '<h5>Section F — Employment Details</h5>';
                previewHTML += createPreviewRow('Job Offer in Texas', formData.jobOffer);
                previewHTML += createPreviewRow('Job Offer Letter Requirement', formData.jobOffer === 'Yes' ? 'Required' : 'Not required');
                
                if (formData.jobOffer === 'Yes') {
                    previewHTML += createPreviewRow('Employer/Practice Name', formData.employerName);
                    previewHTML += createPreviewRow('Facility Type', formData.facilityType);
                    previewHTML += createPreviewRow('Employer Address', formData.employerAddress);
                    previewHTML += createPreviewRow('Contact Person', formData.contactPerson);
                    previewHTML += createPreviewRow('Designation', formData.designation);
                    previewHTML += createPreviewRow('Contact Phone', formData.contactPhone);
                    previewHTML += createPreviewRow('Contact Email', formData.contactEmail);
                }
                previewHTML += '</div>';

                // Section G - Background & Legal
                previewHTML += '<div class="preview-section">';
                previewHTML += '<h5>Section G — Background & Legal</h5>';
                previewHTML += createPreviewRow('Security Risk or ITAR Concerns', formData.securityRisk);
                previewHTML += createPreviewRow('ITAR Restricted Work', formData.itar);
                
                let criminalDisplay = formData.criminal;
                if (criminalDisplay === 'Yes' && formData.criminalExplanation) {
                    criminalDisplay += ': ' + formData.criminalExplanation;
                }
                previewHTML += createPreviewRow('Criminal Convictions', criminalDisplay);
                
                previewHTML += createPreviewRow('Military Service', formData.military);
                
                if (formData.military === 'Yes') {
                    previewHTML += createPreviewRow('Military Misconduct', formData.misconduct);
                }
                
                let investigationsDisplay = formData.investigations;
                if (formData.investigationsExplanation) {
                    investigationsDisplay += ': ' + formData.investigationsExplanation;
                }
                previewHTML += createPreviewRow('Professional Investigations', investigationsDisplay);
                previewHTML += '</div>';

                // Section H - Consolidated Documents Checklist
                previewHTML += '<div class="preview-section">';
                previewHTML += '<h5>Section H — Consolidated Documents Checklist</h5>';
                const hasJobOffer = formData.jobOffer === 'Yes';
                const docKeys = [
                    {key: 'doc_passport', label: 'Passport copy'},
                    {key: 'doc_diploma', label: 'Medical degree diploma'},
                    {key: 'doc_transcripts', label: 'Medical school transcripts'},
                    {key: 'doc_ecfmg', label: 'Proof of ECFMG eligibility'},
                    {key: 'doc_foreign_license', label: 'Copy of foreign medical license'},
                    {key: 'doc_good_standing', label: 'Good standing certificate'},
                    {key: 'doc_disciplinary', label: 'Disciplinary clearance letter'},
                    {key: 'doc_residency', label: 'Residency completion certificate'},
                    {key: 'doc_experience', label: 'Employment experience letters'},
                    {key: 'doc_usmle1', label: 'USMLE Step 1 score report'},
                    {key: 'doc_usmle2', label: 'USMLE Step 2 score report'},
                    {key: 'doc_jurisprudence', label: 'Texas Jurisprudence Exam proof'},
                    {key: 'doc_english', label: 'English proficiency certificate'},
                    {key: 'doc_contract', label: 'Contract (if available)'},
                    {key: 'doc_criminal', label: 'Criminal background check'},
                    {key: 'doc_police_clearance', label: 'Police clearance'},
                    {key: 'doc_military', label: 'Military documents'}
                ];
                docKeys.forEach(d => {
                    previewHTML += createPreviewRow(d.label, formData[d.key] || '');
                });
                previewHTML += createPreviewRow(
                    'Job offer letter from Texas facility',
                    hasJobOffer ? (formData.doc_job_offer || 'Required - not uploaded') : 'Not required'
                );
                previewHTML += '</div>';

                // Section I - Attestation
                previewHTML += '<div class="preview-section">';
                previewHTML += '<h5>Section I — Applicant Attestation</h5>';
                previewHTML += createPreviewRow('Applicant Signature', formData.applicantSignature);
                previewHTML += createPreviewRow('Signature Date', formData.signatureDate ? new Date(formData.signatureDate).toLocaleDateString() : '');
                previewHTML += '</div>';

                previewContainer.innerHTML = previewHTML;
            }

            function createPreviewRow(label, value) {
                if (!value || value === 'undefined' || value === 'null') {
                    value = '<span style="color: #6c757d; font-style: italic;">Not provided</span>';
                }
                return `
                    <div class="preview-row">
                        <div class="preview-label">${label}:</div>
                        <div class="preview-value">${value}</div>
                    </div>
                `;
            }

            function submitApplication() {
                if (validateStep(8)) {
                    // Collect all form data
                        saveAllFormData();

                        // Client-side pre-submit validation for conditional numeric fields
                        if (formData.pathway === 'Path A') {
                            const postEl = document.getElementById('postResidencyYears');
                            const postVal = postEl ? parseInt(postEl.value || '') : NaN;
                            if (!postEl || isNaN(postVal) || postVal < 5 || postVal > 50) {
                                const err = document.getElementById('postResidencyYearsError');
                                if (err) err.style.display = 'block';
                                if (postEl) {
                                    postEl.classList.add('error');
                                    postEl.style.borderColor = '#dc3545';
                                    postEl.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
                                    postEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    postEl.focus();
                                }
                                // Reset submit button UI if present
                                return finishSubmitEarly(submitBtn, loadingDiv, originalText);
                            }
                        }

                        if (formData.pathway === 'Path B') {
                            const totalEl = document.getElementById('totalPracticeYears');
                            const totalVal = totalEl ? parseInt(totalEl.value || '') : NaN;
                            if (!totalEl || isNaN(totalVal) || totalVal < 10 || totalVal > 50) {
                                const err = document.getElementById('totalPracticeYearsError');
                                if (err) err.style.display = 'block';
                                if (totalEl) {
                                    totalEl.classList.add('error');
                                    totalEl.style.borderColor = '#dc3545';
                                    totalEl.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
                                    totalEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    totalEl.focus();
                                }
                                return finishSubmitEarly(submitBtn, loadingDiv, originalText);
                            }
                        }

                        // Additional pre-submit check: residency dates must be valid when Path A
                        if (formData.pathway === 'Path A') {
                            const fromVal = document.getElementById('residencyFrom')?.value;
                            const toVal = document.getElementById('residencyTo')?.value;
                            if (!fromVal || !toVal) {
                                const err = document.getElementById('residencyToError');
                                if (err) err.style.display = 'block';
                                return; // no submit button UI to reset yet
                            }
                            const fromDate = new Date(fromVal);
                            const toDate = new Date(toVal);
                            if (toDate <= fromDate) {
                                const err = document.getElementById('residencyToError');
                                if (err) err.style.display = 'block';
                                const toEl = document.getElementById('residencyTo');
                                if (toEl) {
                                    toEl.classList.add('error');
                                    toEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    toEl.focus();
                                }
                                return;
                            }
                        }

                    // Show loading state
                    const submitBtn = document.querySelector('.btn-submit');
                    const originalText = submitBtn.textContent;
                    submitBtn.textContent = 'Submitting...';
                    submitBtn.disabled = true;

                    // Add loading animation
                    submitBtn.style.position = 'relative';
                    const loadingDiv = document.createElement('div');
                    loadingDiv.innerHTML =
                        '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 20px; height: 20px; border: 2px solid #ffffff; border-top: 2px solid transparent; border-radius: 50%; animation: spin 1s linear infinite;"></div>';
                    submitBtn.appendChild(loadingDiv);

                    // Build request: if any file input has a selected file, send multipart FormData so backend receives the files
                    const fileInputs = document.querySelectorAll('input[type="file"]');
                    let useFormData = false;
                    fileInputs.forEach(fi => {
                        if (fi.files && fi.files.length > 0) useFormData = true;
                    });

                    let fetchOptions = {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    };

                    if (useFormData) {
                        const fd = new FormData();
                        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                        const token = csrfMeta ? csrfMeta.getAttribute('content') : null;

                        // Ensure the CSRF token is present in the FormData as well
                        if (token) fd.append('_token', token);

                        // Append all inputs directly to FormData so files are included
                        document.querySelectorAll('input, select, textarea').forEach(input => {
                            if (!input.name) return;
                            if (input.type === 'file') {
                                if (input.files && input.files.length) {
                                    fd.append(input.name, input.files[0]);
                                }
                            } else if (input.type === 'checkbox') {
                                fd.append(input.name, input.checked ? 1 : 0);
                            } else if (input.type === 'radio') {
                                if (input.checked) fd.append(input.name, input.value);
                            } else {
                                fd.append(input.name, input.value);
                            }
                        });

                        fetchOptions.body = fd;
                        // Do NOT set Content-Type header for FormData; browser will set with boundary
                    } else {
                        fetchOptions.headers['Content-Type'] = 'application/json';
                        fetchOptions.body = JSON.stringify(formData);
                    }

                    // Send data to backend and handle validation errors (422) inline
                    fetch('/application/submit', fetchOptions)
                        .then(async response => {
                            // Try to parse JSON, but guard against non-JSON responses
                            let data;
                            try {
                                data = await response.json();
                            } catch (e) {
                                const text = await response.text();
                                throw new Error('Invalid server response');
                            }

                            if (!response.ok) {
                                // Handle server-side validation errors (HTTP 422) and display them inline
                                if (response.status === 422 && data.errors) {
                                    let fallbackMessage = 'Please fix the following errors:\n';
                                    Object.keys(data.errors).forEach(field => {
                                        const msg = Array.isArray(data.errors[field]) ? data.errors[field][0] : data.errors[field];

                                        // Try to show inline error element if present
                                        const errorEl = document.getElementById(field + 'Error');
                                        const inputEl = document.getElementById(field) || document.querySelector(`input[name="${field}"]`);

                                        if (errorEl) {
                                            errorEl.textContent = msg;
                                            errorEl.style.display = 'block';
                                        } else {
                                            fallbackMessage += `\n• ${msg}`;
                                        }

                                        // Add error styling to input or radio group
                                        if (inputEl) {
                                            if (inputEl.length) { // radio NodeList
                                                inputEl.forEach(r => {
                                                    r.classList.add('error');
                                                    const container = r.closest('.radio-option');
                                                    if (container) container.style.color = '#dc3545';
                                                });
                                            } else {
                                                inputEl.classList.add('error');
                                                inputEl.style.borderColor = '#dc3545';
                                                inputEl.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
                                            }
                                        }
                                    });

                                    // Show fallback alert for any errors without inline targets
                                    if (fallbackMessage !== 'Please fix the following errors:\n') {
                                        alert(fallbackMessage);
                                    }

                                    // Reset submit button and remove loader
                                    submitBtn.textContent = originalText;
                                    submitBtn.disabled = false;
                                    if (submitBtn.contains(loadingDiv)) submitBtn.removeChild(loadingDiv);

                                    // Scroll to first error field if present
                                    const firstField = Object.keys(data.errors)[0];
                                    const firstEl = document.getElementById(firstField) || document.querySelector(`input[name="${firstField}"]`);
                                    if (firstEl) {
                                        firstEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                        firstEl.focus();
                                    }

                                    // Return a rejected promise to stop the success flow
                                    return Promise.reject(new Error('validation'));
                                }

                                // Other non-validation errors
                                throw new Error(data.message || 'Server error');
                            }

                            return data;
                        })
                        .then(data => {
                            if (data && data.success) {
                                window.location.href = data.redirectUrl || '{{ route('user.dashboard') }}';
                                return;
                            } else if (data && data.errors) {
                                // In case server returned success=false with errors (defensive)
                                let errorMessage = 'Please fix the following errors:\n';
                                Object.keys(data.errors).forEach(field => {
                                    errorMessage += `\n• ${data.errors[field][0]}`;
                                });
                                alert(errorMessage);
                            }
                        })
                        .catch(error => {
                            if (error && error.message === 'validation') {
                                // validation errors already shown inline; no further action
                                return;
                            }
                            alert('Error submitting application: ' + (error.message || error) + '\nPlease try again or contact support.');

                            // Reset button
                            submitBtn.textContent = originalText;
                            submitBtn.disabled = false;
                            if (submitBtn.contains(loadingDiv)) {
                                submitBtn.removeChild(loadingDiv);
                            }
                        });
                }
            }

            function saveAllFormData() {
                formData = {};

                // Collect all form data
                const allInputs = document.querySelectorAll('input, select, textarea');
                allInputs.forEach(input => {
                    if (input.type === 'radio') {
                        if (input.checked) {
                            formData[input.name] = input.value;
                            if (input.name === 'visaStatus' && input.value === 'Other') {
                                formData['otherVisaText'] = document.getElementById('otherVisaText').value;
                            }
                        }
                    } else if (input.type === 'checkbox') {
                        formData[input.name] = input.checked;
                    } else if (input.type === 'file') {
                        formData[input.name] = (input.files && input.files.length) ? input.files[0].name : '';
                    } else if (input.type !== 'radio') {
                        formData[input.name] = input.value;
                    }
                });

                // Get select values
                const selects = document.querySelectorAll('select');
                selects.forEach(select => {
                    formData[select.name] = select.value;
                });
            }

            // Add CSS for loading spinner
            const style = document.createElement('style');
            style.textContent = `
        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
    `;
            document.head.appendChild(style);

            function resetForm() {
                // Reset form
                document.querySelectorAll('input, select, textarea').forEach(element => {
                    if (element.type === 'radio' || element.type === 'checkbox') {
                        element.checked = false;
                    } else {
                        element.value = '';
                    }
                    // Clear validation styling
                    element.classList.remove('error');
                    element.style.borderColor = '#ced4da';
                    element.style.boxShadow = 'none';
                });

                // Clear all validation errors
                document.querySelectorAll('.validation-error').forEach(error => {
                    error.style.display = 'none';
                });

                // Clear radio group styling
                document.querySelectorAll('.radio-option').forEach(option => {
                    option.style.color = '';
                });

                // Reset progress
                currentStep = 1;
                formData = {};

                // Reset steps
                for (let i = 1; i <= totalSteps; i++) {
                    document.getElementById(`step${i}`).className = 'step';
                    document.getElementById(`stepContent${i}`).className = 'step-content';

                    if (i === 1) {
                        document.getElementById(`step${i}`).classList.add('active');
                        document.getElementById(`stepContent${i}`).classList.add('active');
                    } else {
                        document.getElementById(`step${i}`).classList.add('pending');
                    }
                }

                // Reset progress bar
                updateProgressBar();

                // Show form again
                document.querySelector('.form-container').style.display = 'block';
                document.getElementById('successMessage').style.display = 'none';

                // Hide conditional fields
                document.getElementById('pathAFields').classList.add('hidden');
                document.getElementById('pathBFields').classList.add('hidden');
                document.getElementById('jobOfferFields').classList.add('hidden');
                document.getElementById('militaryFields').classList.add('hidden');

                // Enable/disable other visa text
                document.getElementById('otherVisaText').disabled = true;

                // Scroll to top
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Helper to reset submit button and remove loading when we abort submission early
            function finishSubmitEarly(submitBtn, loadingDiv, originalText) {
                if (submitBtn) {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    if (submitBtn.contains(loadingDiv)) submitBtn.removeChild(loadingDiv);
                }
                return;
            }
        </script>
    </body>

    </html>
@endsection
