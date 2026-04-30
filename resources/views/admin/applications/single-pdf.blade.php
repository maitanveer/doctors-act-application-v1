<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application {{ $application->application_id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; line-height: 1.6; }
        .header { text-align: center; background: #f39c12; color: white; padding: 20px; margin-bottom: 30px; }
        .section { margin-bottom: 25px; }
        .section-title { background: #f8f9fa; padding: 10px; font-weight: bold; border-left: 4px solid #f39c12; margin-bottom: 10px; }
        .field { margin-bottom: 8px; }
        .field-label { font-weight: bold; display: inline-block; width: 180px; }
        .field-value { display: inline-block; }
        .status-badge { padding: 5px 10px; border-radius: 3px; color: white; font-weight: bold; }
        .status-submitted { background: #f39c12; }
        .status-approved { background: #28a745; }
        .status-rejected { background: #dc3545; }
        .status-under_review { background: #17a2b8; }
        .footer { margin-top: 40px; text-align: center; color: #666; font-size: 9px; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Ibn Sina Foundation</h1>
        <h2>Application Details</h2>
    </div>

    <div class="section">
        <div class="field">
            <span class="field-label">Application ID:</span>
            <span class="field-value"><strong>{{ $application->application_id }}</strong></span>
        </div>
        <div class="field">
            <span class="field-label">Status:</span>
            <span class="status-badge status-{{ $application->status }}">{{ ucfirst($application->status) }}</span>
        </div>
        <div class="field">
            <span class="field-label">Submission Date:</span>
            <span class="field-value">{{ $application->submission_date ? $application->submission_date->format('F d, Y h:i A') : 'N/A' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Personal Information</div>
        <div class="field">
            <span class="field-label">Full Name:</span>
            <span class="field-value">{{ $application->full_name }}</span>
        </div>
        <div class="field">
            <span class="field-label">Email:</span>
            <span class="field-value">{{ $application->email }}</span>
        </div>
        <div class="field">
            <span class="field-label">Phone:</span>
            <span class="field-value">{{ $application->phone }}</span>
        </div>
        <div class="field">
            <span class="field-label">Date of Birth:</span>
            <span class="field-value">{{ $application->date_of_birth ? $application->date_of_birth->format('F d, Y') : 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Gender:</span>
            <span class="field-value">{{ ucfirst($application->gender ?? 'N/A') }}</span>
        </div>
        <div class="field">
            <span class="field-label">Nationality:</span>
            <span class="field-value">{{ $application->nationality ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Contact Information</div>
        <div class="field">
            <span class="field-label">Address:</span>
            <span class="field-value">{{ $application->address ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">City:</span>
            <span class="field-value">{{ $application->city }}</span>
        </div>
        <div class="field">
            <span class="field-label">State/Province:</span>
            <span class="field-value">{{ $application->state_province }}</span>
        </div>
        <div class="field">
            <span class="field-label">Country:</span>
            <span class="field-value">{{ $application->country }}</span>
        </div>
        <div class="field">
            <span class="field-label">Postal Code:</span>
            <span class="field-value">{{ $application->postal_code ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Medical Education</div>
        <div class="field">
            <span class="field-label">Medical School:</span>
            <span class="field-value">{{ $application->medical_school }}</span>
        </div>
        <div class="field">
            <span class="field-label">Graduation Year:</span>
            <span class="field-value">{{ $application->graduation_year }}</span>
        </div>
        <div class="field">
            <span class="field-label">Degree:</span>
            <span class="field-value">{{ $application->degree ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Specialty:</span>
            <span class="field-value">{{ $application->specialty }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Licensure Information</div>
        <div class="field">
            <span class="field-label">License Number:</span>
            <span class="field-value">{{ $application->license_number }}</span>
        </div>
        <div class="field">
            <span class="field-label">License Country:</span>
            <span class="field-value">{{ $application->license_country ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">License Expiry:</span>
            <span class="field-value">{{ $application->license_expiry ?? 'N/A' }}</span>
        </div>
    </div>

    @if($application->admin_notes)
    <div class="section">
        <div class="section-title">Admin Notes</div>
        <p>{{ $application->admin_notes }}</p>
    </div>
    @endif

    <div class="footer">
        <p>Generated on {{ date('F d, Y h:i A') }}</p>
        <p>&copy; {{ date('Y') }} Ibn Sina Foundation. All rights reserved.</p>
    </div>
</body>
</html>
