<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Application Submission</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .header h2 {
            margin: 10px 0 0 0;
            font-size: 20px;
            font-weight: 400;
        }

        .urgent-alert {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px 20px;
            margin: 20px;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }

        .content {
            padding: 30px;
        }

        .section {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .section h3 {
            color: #0054a4;
            margin-top: 0;
            border-bottom: 2px solid #0054a4;
            padding-bottom: 10px;
            font-size: 18px;
        }

        .data-row {
            display: flex;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .data-label {
            font-weight: 600;
            color: #495057;
            width: 250px;
            flex-shrink: 0;
        }

        .data-value {
            color: #212529;
            flex: 1;
        }

        .security-flag {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
        }

        .footer {
            background: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            .data-row {
                flex-direction: column;
            }

            .data-label {
                width: 100%;
                margin-bottom: 5px;
            }

            .container {
                margin: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>NEW APPLICATION SUBMISSION</h1>
            <h2>Texas Doctor's Act (HB 2038)</h2>
        </div>

        <div class="urgent-alert">
            ⚠️ IMMEDIATE ATTENTION REQUIRED: New application submitted
        </div>

        <div class="content">
            <!-- Application Details Section -->
            <div class="section">
                <h3>📋 APPLICATION DETAILS</h3>
                <div class="data-row">
                    <div class="data-label">Application ID:</div>
                    <div class="data-value"><strong>{{ $data['applicationId'] }}</strong></div>
                </div>
                <div class="data-row">
                    <div class="data-label">Submission Date & Time:</div>
                    <div class="data-value">{{ $data['submissionDate'] }} at {{ $data['submissionTime'] }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">IP Address:</div>
                    <div class="data-value">{{ $data['ipAddress'] ?? 'N/A' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">User Agent:</div>
                    <div class="data-value" style="font-size: 11px;">
                        {{ substr($data['userAgent'] ?? 'N/A', 0, 100) }}...</div>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="section">
                <h3>👤 PERSONAL INFORMATION</h3>
                <div class="data-row">
                    <div class="data-label">Full Name:</div>
                    <div class="data-value">{{ $data['fullName'] }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Date of Birth:</div>
                    <div class="data-value">{{ $data['dob'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Gender:</div>
                    <div class="data-value">
                        {{ $data['gender'] ?? 'Not provided' }}
                        @if (isset($data['genderExplanation']) && $data['genderExplanation'])
                            ({{ $data['genderExplanation'] }})
                        @endif
                    </div>
                </div>
                <div class="data-row">
                    <div class="data-label">Country of Citizenship:</div>
                    <div class="data-value">{{ $data['citizenship'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Passport Number:</div>
                    <div class="data-value">{{ $data['passport'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Email Address:</div>
                    <div class="data-value">{{ $data['email'] }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Phone Number:</div>
                    <div class="data-value">
                        @php
                            $phoneDisplay = '';
                            if (!empty($data['countryCode'])) {
                                // normalize country code display
                                $code = ltrim($data['countryCode'], '+');
                                $phoneDisplay .= '+' . $code . ' ';
                            }
                            $phoneDisplay .= $data['phone'] ?? '';
                        @endphp
                        {{ $phoneDisplay }}
                    </div>
                </div>
                <div class="data-row">
                    <div class="data-label">U.S. Address:</div>
                    <div class="data-value">{{ $data['address'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Visa/Work Status:</div>
                    <div class="data-value">
                        {{ $data['visaStatus'] ?? 'Not provided' }}
                        @if (isset($data['otherVisaText']) && $data['otherVisaText'])
                            ({{ $data['otherVisaText'] }})
                        @endif
                    </div>
                </div>
            </div>

            <!-- Medical Education Section -->
            <div class="section">
                <h3>🎓 MEDICAL EDUCATION</h3>
                <div class="data-row">
                    <div class="data-label">Medical Degree:</div>
                    <div class="data-value">
                        {{ $data['degree'] ?? 'Not provided' }}
                        @if (isset($data['otherDegree']) && $data['otherDegree'])
                            ({{ $data['otherDegree'] }})
                        @endif
                    </div>
                </div>
                <div class="data-row">
                    <div class="data-label">Medical School:</div>
                    <div class="data-value">{{ $data['medicalSchool'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">School Country:</div>
                    <div class="data-value">{{ $data['schoolCountry'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Graduation Year:</div>
                    <div class="data-value">{{ $data['graduationYear'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">ECFMG Eligibility:</div>
                    <div class="data-value">{{ $data['ecfmg'] ?? 'Not provided' }}</div>
                </div>
            </div>

            <!-- Foreign Medical Licensure Section -->
            <div class="section">
                <h3>📜 FOREIGN MEDICAL LICENSURE</h3>
                <div class="data-row">
                    <div class="data-label">License Country:</div>
                    <div class="data-value">{{ $data['licenseCountry'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">License Number:</div>
                    <div class="data-value">{{ $data['licenseNumber'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Issue Date:</div>
                    <div class="data-value">{{ $data['issueDate'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Expiry Date:</div>
                    <div class="data-value">{{ $data['expiryDate'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Licensure Status:</div>
                    <div class="data-value">
                        {{ $data['licensureStatus'] ?? 'Not provided' }}
                        @if (isset($data['licensureExplanation']) && $data['licensureExplanation'])
                            ({{ $data['licensureExplanation'] }})
                        @endif
                    </div>
                </div>
                <div class="data-row">
                    <div class="data-label">Disciplinary History:</div>
                    <div class="data-value">
                        {{ $data['disciplinary'] ?? 'Not provided' }}
                        @if (isset($data['disciplinaryExplanation']) && $data['disciplinaryExplanation'])
                            ({{ $data['disciplinaryExplanation'] }})
                        @endif
                    </div>
                </div>
            </div>

            <!-- Postgraduate Training Section -->
            <div class="section">
                <h3>🏥 POSTGRADUATE TRAINING & EXPERIENCE</h3>
                <div class="data-row">
                    <div class="data-label">Selected Pathway:</div>
                    <div class="data-value">{{ $data['pathway'] ?? 'Not provided' }}</div>
                </div>

                @if (isset($data['pathway']) && $data['pathway'] == 'Path A')
                    <div class="data-row">
                        <div class="data-label">Residency Completed:</div>
                        <div class="data-value">{{ $data['residency'] ?? 'Not provided' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">Residency Institution:</div>
                        <div class="data-value">{{ $data['residencyInstitution'] ?? 'Not provided' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">Residency Period:</div>
                        <div class="data-value">
                            {{ $data['residencyFrom'] ?? 'N/A' }} to {{ $data['residencyTo'] ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">Post-Residency Years:</div>
                        <div class="data-value">{{ $data['postResidencyYears'] ?? 'Not provided' }} years</div>
                    </div>
                @endif

                @if (isset($data['pathway']) && $data['pathway'] == 'Path B')
                    <div class="data-row">
                        <div class="data-label">Total Practice Years:</div>
                        <div class="data-value">{{ $data['totalPracticeYears'] ?? 'Not provided' }} years</div>
                    </div>
                @endif
            </div>

            <!-- Exam Requirements Section -->
            <div class="section">
                <h3>📝 EXAM REQUIREMENTS</h3>
                <div class="data-row">
                    <div class="data-label">USMLE Step 1:</div>
                    <div class="data-value">
                        {{ $data['step1'] ?? 'Not provided' }}
                        @if (isset($data['step1Explanation']) && $data['step1Explanation'])
                            ({{ $data['step1Explanation'] }})
                        @endif
                    </div>
                </div>
                <div class="data-row">
                    <div class="data-label">USMLE Step 2:</div>
                    <div class="data-value">
                        {{ $data['step2'] ?? 'Not provided' }}
                        @if (isset($data['step2Explanation']) && $data['step2Explanation'])
                            ({{ $data['step2Explanation'] }})
                        @endif
                    </div>
                </div>
                <div class="data-row">
                    <div class="data-label">Texas Jurisprudence Exam:</div>
                    <div class="data-value">{{ $data['jurisprudence'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">English Proficiency:</div>
                    <div class="data-value">{{ $data['english'] ?? 'Not provided' }}</div>
                </div>
            </div>

            <!-- Employment in Texas Section -->
            <div class="section">
                <h3>💼 EMPLOYMENT IN TEXAS</h3>
                <div class="data-row">
                    <div class="data-label">Job Offer in Texas:</div>
                    <div class="data-value">{{ $data['jobOffer'] ?? 'Not provided' }}</div>
                </div>

                @if (isset($data['jobOffer']) && $data['jobOffer'] == 'Yes')
                    <div class="data-row">
                        <div class="data-label">Employer Name:</div>
                        <div class="data-value">{{ $data['employerName'] ?? 'Not provided' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">Facility Type:</div>
                        <div class="data-value">{{ $data['facilityType'] ?? 'Not provided' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">Employer Address:</div>
                        <div class="data-value">{{ $data['employerAddress'] ?? 'Not provided' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">Contact Person:</div>
                        <div class="data-value">{{ $data['contactPerson'] ?? 'Not provided' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">Designation:</div>
                        <div class="data-value">{{ $data['designation'] ?? 'Not provided' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">Contact Phone:</div>
                        <div class="data-value">{{ $data['contactPhone'] ?? 'Not provided' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">Contact Email:</div>
                        <div class="data-value">{{ $data['contactEmail'] ?? 'Not provided' }}</div>
                    </div>
                @endif
            </div>

            <!-- Security & Background Check Section -->
            <div class="section">
                <h3>🔒 SECURITY & BACKGROUND CHECK</h3>
                <div class="data-row">
                    <div class="data-label">Security Risk Country:</div>
                    <div class="data-value">{{ $data['securityRisk'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">ITAR Restricted Country:</div>
                    <div class="data-value">{{ $data['itar'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Criminal History:</div>
                    <div class="data-value">
                        {{ $data['criminal'] ?? 'Not provided' }}
                        @if (isset($data['criminalExplanation']) && $data['criminalExplanation'])
                            ({{ $data['criminalExplanation'] }})
                        @endif
                    </div>
                </div>
                <div class="data-row">
                    <div class="data-label">Military Service:</div>
                    <div class="data-value">{{ $data['military'] ?? 'Not provided' }}</div>
                </div>
                @if (isset($data['military']) && $data['military'] == 'Yes')
                    <div class="data-row">
                        <div class="data-label">Discharged for Misconduct:</div>
                        <div class="data-value">{{ $data['misconduct'] ?? 'Not provided' }}</div>
                    </div>
                @endif
                <div class="data-row">
                    <div class="data-label">Ongoing Investigations:</div>
                    <div class="data-value">
                        {{ $data['investigations'] ?? 'Not provided' }}
                        @if (isset($data['investigationsExplanation']) && $data['investigationsExplanation'])
                            ({{ $data['investigationsExplanation'] }})
                        @endif
                    </div>
                </div>

                @if (isset($data['securityFlag']) && $data['securityFlag'])
                    <div class="security-flag">
                        ⚠️ <strong>SECURITY FLAG:</strong> This application requires additional security review
                    </div>
                @endif
            </div>

            <!-- Documents Section -->
            <div class="section">
                <h3>📁 UPLOADED DOCUMENTS</h3>
                @php
                    $documentLabels = [
                        'doc_passport' => 'Passport copy',
                        'doc_diploma' => 'Medical degree diploma',
                        'doc_transcripts' => 'Medical school transcripts',
                        'doc_ecfmg' => 'Proof of ECFMG eligibility',
                        'doc_foreign_license' => 'Copy of foreign medical license',
                        'doc_good_standing' => 'Good standing certificate',
                        'doc_disciplinary' => 'Disciplinary clearance letter',
                        'doc_residency' => 'Residency completion certificate',
                        'doc_experience' => 'Employment experience letters',
                        'doc_usmle1' => 'USMLE Step 1 score report',
                        'doc_usmle2' => 'USMLE Step 2 score report',
                        'doc_jurisprudence' => 'Texas Jurisprudence Exam proof',
                        'doc_english' => 'English proficiency certificate',
                        'doc_job_offer' => 'Job offer letter from Texas facility',
                        'doc_contract' => 'Contract (if available)',
                        'doc_criminal' => 'Criminal background check',
                        'doc_police_clearance' => 'Police clearance',
                        'doc_military' => 'Military documents',
                    ];
                @endphp

                @foreach($documentLabels as $field => $label)
                    <div class="data-row">
                        <div class="data-label">{{ $label }}:</div>
                        <div class="data-value">{{ $data[$field] ?? 'Not provided' }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Applicant Attestation Section -->
            <div class="section">
                <h3>✍️ APPLICANT ATTESTATION</h3>
                <div class="data-row">
                    <div class="data-label">Applicant Signature:</div>
                    <div class="data-value">{{ $data['applicantSignature'] ?? 'Not provided' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Signature Date:</div>
                    <div class="data-value">{{ $data['signatureDate'] ?? 'Not provided' }}</div>
                </div>
            </div>

            <!-- System Information -->
            <div class="section" style="background: #e8f4fd;">
                <h3>📊 SYSTEM INFORMATION</h3>
                <div class="data-row">
                    <div class="data-label">Total Fields Submitted:</div>
                    <div class="data-value">{{ count($data) }} fields</div>
                </div>
                <!-- Submission status row removed as requested -->
            </div>

            <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef;">
                <p style="color: #666; font-size: 14px;">
                    This application was automatically submitted through the Texas Doctor's Act online portal.<br>
                    <strong>Review Required:</strong> Please verify all information and initiate background check
                    process.
                </p>
            </div>
            <!-- Raw data dump removed as requested. Detailed fields are shown above. -->
        </div>

        <div class="footer">
            <p>Texas Medical Board Licensing System | Automated Notification</p>
            <p>© {{ date('Y') }} Texas Medical Board. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
