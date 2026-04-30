<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class AdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {
        $mail = $this->from(config('app.notifications_email'), config('app.notifications_name'))
            ->subject('NEW Application Submission - '.$this->data['applicationId'])
            ->view('emails.admin_notification')
            ->with(['data' => $this->data]);

        // Attach any uploaded documents present in the payload (no storage required)
        $docFields = [
            'uploadDocument', 'doc_passport', 'doc_diploma', 'doc_transcripts', 'doc_ecfmg',
            'doc_foreign_license', 'doc_good_standing', 'doc_disciplinary', 'doc_residency',
            'doc_experience', 'doc_usmle1', 'doc_usmle2', 'doc_jurisprudence', 'doc_english',
            'doc_job_offer', 'doc_contract', 'doc_criminal', 'doc_police_clearance', 'doc_military'
        ];

        foreach ($docFields as $field) {
            try {
                if (!empty($this->data[$field.'_raw'])) {
                    $raw = $this->data[$field.'_raw'];
                    $name = $this->data[$field] ?? ($field . '.dat');
                    $mime = $this->data[$field.'_mime'] ?? null;
                    if ($mime) {
                        $mail->attachData($raw, $name, ['mime' => $mime]);
                    } else {
                        $mail->attachData($raw, $name);
                    }
                }
            } catch (\Exception $e) {
                Log::warning('AdminNotification: failed to attach '.$field.': '.$e->getMessage());
            }
        }

        return $mail;
    }
}
