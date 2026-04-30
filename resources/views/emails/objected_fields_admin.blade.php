<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        .content { background: #f8f9fa; padding: 30px; margin: 20px 0; }
        .info-box { background: white; padding: 15px; margin: 15px 0; border-radius: 5px; border: 1px solid #ddd; }
        .field-list { background: #fff3cd; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .field-item { padding: 8px 0; border-bottom: 1px solid #eee; }
        .field-item:last-child { border-bottom: none; }
        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px; }
        .message-box { background: white; padding: 15px; border-left: 4px solid #f39c12; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ibn Sina Foundation</h1>
            <p>Objected Fields Notification</p>
        </div>
        
        <div class="content">
            <h2>Objection Request Sent</h2>
            
            <p>This is a confirmation that objected fields notification has been sent to the applicant.</p>
            
            <div class="info-box">
                <p><strong>Application ID:</strong> {{ $application->application_id }}</p>
                <p><strong>Applicant Name:</strong> {{ $application->full_name }}</p>
                <p><strong>Email:</strong> {{ $application->email }}</p>
                <p><strong>Date Sent:</strong> {{ date('M d, Y h:i A') }}</p>
            </div>
            
            <h3>Objected Fields/Documents:</h3>
            <div class="field-list">
                @foreach($objectedFields as $field)
                    <div class="field-item">
                        <strong>• {{ ucfirst(str_replace(['_', 'doc '], [' ', 'Document: '], $field)) }}</strong>
                    </div>
                @endforeach
            </div>
            
            <h3>Message Sent to Applicant:</h3>
            <div class="message-box">
                <p>{{ $objectionMessage }}</p>
            </div>
            
            <p style="margin-top: 30px;">The applicant has been notified and can now edit these fields in their application.</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Ibn Sina Foundation. All rights reserved.</p>
            <p>This is an automated notification from the admin panel.</p>
        </div>
    </div>
</body>
</html>
