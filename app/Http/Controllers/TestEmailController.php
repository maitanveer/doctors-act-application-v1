<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function testEmail()
    {
        try {
            Log::info('Starting email test...');

            // Check current mail configuration
            $config = [
                'mail_driver' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
                'mail_username' => config('mail.mailers.smtp.username'),
                'mail_from_address' => config('mail.from.address'),
                'mail_from_name' => config('mail.from.name'),
            ];

            Log::info('Mail config:', $config);

            // Test 1: Send simple text email
            $recipient = 'your-email@gmail.com'; // Replace with your email

            Mail::raw('This is a simple test email from Laravel application.', function ($message) use ($recipient) {
                $message->to($recipient)
                    ->subject('Simple Test Email - '.date('Y-m-d H:i:s'));
            });

            Log::info('Simple email sent successfully');

            // Test 2: Send HTML email using view
            $testData = [
                'fullName' => 'John Doe',
                'email' => $recipient,
                'applicationId' => 'TDA-TEST-'.time(),
                'submissionDate' => now()->format('F d, Y'),
                'submissionTime' => now()->format('h:i A'),
                'dob' => '1990-01-01',
                'citizenship' => 'United States',
                'passport' => 'TEST123456',
                'phone' => '+1234567890',
                'visaStatus' => 'U.S. Citizen',
            ];

            // Check if view exists
            if (! view()->exists('emails.application_submitted')) {
                throw new \Exception('Email view not found: emails.application_submitted');
            }

            Mail::to($recipient)->send(new \App\Mail\ApplicationSubmitted($testData));

            Log::info('HTML email sent successfully');

            return response()->json([
                'success' => true,
                'message' => 'Test emails sent successfully!',
                'config' => $config,
                'view_exists' => view()->exists('emails.application_submitted'),
            ]);

        } catch (\Exception $e) {
            Log::error('Email test failed: '.$e->getMessage());
            Log::error('Trace: '.$e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Email test failed: '.$e->getMessage(),
                'config' => $config ?? [],
                'view_exists' => view()->exists('emails.application_submitted') ?? false,
            ], 500);
        }
    }
}
