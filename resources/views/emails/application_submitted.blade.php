<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; color:#333; }
        .wrapper { max-width:600px; margin:0 auto; padding:20px; }
        .header { background:#0054a4; color:#fff; padding:20px; text-align:center; border-radius:6px 6px 0 0; }
        .content { background:#fff; padding:20px; border:1px solid #e9ecef; border-top:0; }
        .footer { font-size:12px; color:#666; padding:16px; text-align:center; }
        .button { background:#28a745; color:#fff; padding:10px 16px; border-radius:4px; text-decoration:none; display:inline-block; }
        .meta { font-size:13px; color:#555; margin:12px 0; }
        .field { margin-bottom:8px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h2>Texas Doctor's Act — Application Received</h2>
        </div>

        <div class="content">
            <p>Dear {{ $data['fullName'] ?? 'Applicant' }},</p>

            <p>Thank you for submitting your Texas Doctor's Act (HB 2038) Provisional Medical License application.</p>

            <div class="meta">
                <div class="field"><strong>Application ID:</strong> {{ $data['applicationId'] ?? 'N/A' }}</div>
                <div class="field"><strong>Submitted:</strong> {{ $data['submissionDate'] ?? now()->format('F d, Y') }} at {{ $data['submissionTime'] ?? now()->format('h:i A') }}</div>
            </div>

            <p>We have received your application and will review it. Please keep this email for your records. If you need to contact support, provide your Application ID above.</p>

            @if(!empty($data['email']))
            <p>If you did not receive this email or have questions, reply to this message or contact our support team at {{ config('app.admin_email', 'support@example.com') }}.</p>
            @endif

            <p style="margin-top:18px">Sincerely,<br>The Texas Medical Board — Licensing Department</p>

        </div>

        <div class="footer">
            <div>This message was sent from {{ config('app.name') }}.</div>
            <div>If you believe you received this message in error, please contact support.</div>
        </div>
    </div>
</body>
</html>
