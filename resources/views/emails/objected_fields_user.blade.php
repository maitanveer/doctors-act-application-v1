<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f39c12; color: white; padding: 20px; text-align: center; }
        .content { background: #f8f9fa; padding: 30px; margin: 20px 0; }
        .alert-box { background: #fff3cd; border-left: 4px solid #f39c12; padding: 15px; margin: 20px 0; }
        .field-list { background: white; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .field-item { padding: 8px 0; border-bottom: 1px solid #eee; }
        .field-item:last-child { border-bottom: none; }
        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px; }
        .btn { display: inline-block; padding: 12px 30px; background: #f39c12; color: white; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .message-box { background: white; padding: 15px; border-left: 4px solid #f39c12; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚠️ Action Required</h1>
            <p>Objected Fields in Your Application</p>
        </div>
        
        <div class="content">
            <h2>Dear {{ $application->full_name }},</h2>
            
            <div class="alert-box">
                <strong>Important Notice:</strong> Some fields in your application require correction or resubmission.
            </div>
            
            <p><strong>Application ID:</strong> {{ $application->application_id }}</p>
            
            <h3>Objected Fields/Documents:</h3>
            <div class="field-list">
                @foreach($objectedFields as $field)
                    <div class="field-item">
                        <strong>• {{ ucfirst(str_replace(['_', 'doc '], [' ', 'Document: '], $field)) }}</strong>
                    </div>
                @endforeach
            </div>
            
            <h3>Admin's Comment:</h3>
            <div class="message-box">
                <p>{{ $objectionMessage }}</p>
            </div>
            
            <div style="background: #d1ecf1; border: 1px solid #bee5eb; padding: 15px; margin: 20px 0; border-radius: 5px;">
                <h3 style="color: #0c5460; margin-top: 0;">📝 What You Need to Do:</h3>
                <p style="color: #0c5460;">
                    1. Review the objected fields/documents listed above<br>
                    2. Make the necessary corrections or prepare updated documents<br>
                    3. Log in to your application portal to update these fields<br>
                    4. Resubmit your application
                </p>
            </div>
            
            <center>
                <a href="{{ route('application.edit', $application->application_id) }}" class="btn">
                    Update Application Now
                </a>
            </center>
            
            <p style="margin-top: 30px;">If you have any questions, please contact us at <a href="mailto:admin@ibnsinafoundation.org">admin@ibnsinafoundation.org</a></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Ibn Sina Foundation. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
