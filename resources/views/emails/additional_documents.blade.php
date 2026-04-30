<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        .content { background: #f8f9fa; padding: 30px; margin: 20px 0; }
        .alert { background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; margin: 20px 0; border-radius: 5px; }
        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px; }
        .field-list { background: white; padding: 15px; margin: 15px 0; border: 1px solid #ddd; }
        .field-list li { margin: 5px 0; }
        .btn { display: inline-block; padding: 12px 30px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ibn Sina Foundation</h1>
            <p>Additional Documents Required</p>
        </div>
        
        <div class="content">
            <h2>Dear {{ $application->full_name }},</h2>
            
            <div class="alert">
                <strong>⚠️ Action Required</strong>
                <p>Additional documents are needed to process your application.</p>
            </div>
            
            <p><strong>Application ID:</strong> {{ $application->application_id }}</p>
            
            <p><strong>Message from Administrator:</strong></p>
            <div style="background: white; padding: 15px; border-left: 4px solid #2c3e50; margin: 15px 0;">
                {{ $message }}
            </div>
            
            <p><strong>Required Documents/Information:</strong></p>
            <div class="field-list">
                <ul>
                    @foreach($requestedFields as $field)
                        <li>
                            @if($field === 'doc_passport') ✓ Passport Copy
                            @elseif($field === 'doc_diploma') ✓ Medical Diploma
                            @elseif($field === 'doc_transcripts') ✓ Academic Transcripts
                            @elseif($field === 'doc_ecfmg') ✓ ECFMG Certificate
                            @elseif($field === 'doc_foreign_license') ✓ Foreign Medical License
                            @elseif($field === 'doc_good_standing') ✓ Good Standing Certificate
                            @elseif($field === 'doc_residency') ✓ Residency Completion Certificate
                            @elseif($field === 'doc_experience') ✓ Experience Letters
                            @elseif($field === 'doc_usmle1') ✓ USMLE Step 1 Score Report
                            @elseif($field === 'doc_usmle2') ✓ USMLE Step 2 Score Report
                            @elseif($field === 'doc_jurisprudence') ✓ Jurisprudence Exam Certificate
                            @elseif($field === 'doc_english') ✓ English Proficiency Test Results
                            @else ✓ {{ ucfirst(str_replace('_', ' ', str_replace('doc_', '', $field))) }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <p><strong>Next Steps:</strong></p>
            <ol>
                <li>Prepare the requested documents</li>
                <li>Contact us via email with the documents attached</li>
                <li>Reference your Application ID: <strong>{{ $application->application_id }}</strong></li>
            </ol>
            
            <p style="text-align: center;">
                <a href="mailto:admin@ibnsinafoundation.org?subject=Additional Documents - {{ $application->application_id }}" class="btn">
                    Send Documents via Email
                </a>
            </p>
            
            <p>Please submit the requested documents at your earliest convenience to avoid delays in processing your application.</p>
            
            <p>If you have any questions, please contact us at <a href="mailto:admin@ibnsinafoundation.org">admin@ibnsinafoundation.org</a></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Ibn Sina Foundation. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
