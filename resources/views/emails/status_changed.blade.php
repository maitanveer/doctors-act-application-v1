<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        .content { background: #f8f9fa; padding: 30px; margin: 20px 0; }
        .status-badge { display: inline-block; padding: 8px 15px; border-radius: 5px; font-weight: bold; }
        .approved { background: #28a745; color: white; }
        .rejected { background: #dc3545; color: white; }
        .under-review { background: #17a2b8; color: white; }
        .submitted { background: #ffc107; color: #333; }
        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px; }
        .notes { background: white; padding: 15px; border-left: 4px solid #2c3e50; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ibn Sina Foundation</h1>
            <p>Application Status Update</p>
        </div>
        
        <div class="content">
            <h2>Dear {{ $application->full_name }},</h2>
            
            <p>Your application status has been updated.</p>
            
            <p><strong>Application ID:</strong> {{ $application->application_id }}</p>
            
            <p>
                <strong>Previous Status:</strong> 
                <span class="status-badge {{ $oldStatus }}">{{ ucfirst(str_replace('_', ' ', $oldStatus)) }}</span>
            </p>
            
            <p>
                <strong>New Status:</strong> 
                <span class="status-badge {{ $newStatus }}">{{ ucfirst(str_replace('_', ' ', $newStatus)) }}</span>
            </p>
            
            @if($newStatus === 'approved')
                <div style="background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; margin: 20px 0; border-radius: 5px;">
                    <h3 style="color: #155724; margin-top: 0;">🎉 Congratulations!</h3>
                    <p style="color: #155724;">Your application has been approved. We will contact you shortly with next steps.</p>
                </div>
            @elseif($newStatus === 'rejected')
                <div style="background: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; margin: 20px 0; border-radius: 5px;">
                    <h3 style="color: #721c24; margin-top: 0;">Application Update</h3>
                    <p style="color: #721c24;">Unfortunately, your application has been rejected.</p>
                    @if($application->rejection_reason)
                        <p style="color: #721c24;"><strong>Reason:</strong><br>{{ $application->rejection_reason }}</p>
                    @endif
                </div>
            @elseif($newStatus === 'under_review')
                <div style="background: #d1ecf1; border: 1px solid #bee5eb; padding: 15px; margin: 20px 0; border-radius: 5px;">
                    <h3 style="color: #0c5460; margin-top: 0;">Under Review</h3>
                    <p style="color: #0c5460;">Your application is currently being reviewed by our team. We will update you soon.</p>
                </div>
            @endif
            
            @if($notes)
                <div class="notes">
                    <strong>Admin Notes:</strong>
                    <p>{{ $notes }}</p>
                </div>
            @endif
            
            <p>If you have any questions, please contact us at <a href="mailto:admin@ibnsinafoundation.org">admin@ibnsinafoundation.org</a></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Ibn Sina Foundation. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
