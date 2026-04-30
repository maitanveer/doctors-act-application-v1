<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #0054a4; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #e9ecef; border-top: 0; }
        .button { display: inline-block; padding: 12px 30px; background: #0054a4; color: white; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .button:hover { background: #003d7a; }
        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px; }
        .alert-box { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset Request</h1>
        </div>
        
        <div class="content">
            <h2>Hello {{ $user->name }},</h2>
            
            <p>We received a request to reset your password for your Ibn Sina Foundation account.</p>
            
            <div class="alert-box">
                <strong>⚠️ Security Notice:</strong> If you did not request a password reset, please ignore this email or contact support immediately.
            </div>
            
            <p>To reset your password, click the button below:</p>
            
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="button">Reset Password</a>
            </div>
            
            <p>Or copy and paste this link into your browser:</p>
            <p style="word-break: break-all; background: #f8f9fa; padding: 10px; border-radius: 3px;">
                {{ $resetUrl }}
            </p>
            
            <div style="background: #e7f3ff; border: 1px solid #bee5eb; padding: 15px; margin: 20px 0; border-radius: 5px;">
                <p style="margin: 0;"><strong>This link will expire in 1 hour</strong> for your security.</p>
            </div>
            
            <p>If you're having trouble, please contact our support team.</p>
            
            <p style="margin-top: 30px;">
                Best regards,<br>
                <strong>Ibn Sina Foundation Team</strong>
            </p>
        </div>
        
        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
            <p>&copy; {{ date('Y') }} Ibn Sina Foundation. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
