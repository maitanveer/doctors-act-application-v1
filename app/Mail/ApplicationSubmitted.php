<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $mail = $this->from(config('app.licensing_email'), config('app.licensing_name'))
            ->subject('Texas Doctor’s Act Application Received - '.$this->data['applicationId'])
            ->view('emails.application_submitted')
            ->with(['data' => $this->data]);

        // Attach uploaded file if provided
        if (!empty($this->data['uploadedFilePath'])) {
            try {
                $path = $this->data['uploadedFilePath'];
                if (file_exists($path) && is_readable($path)) {
                    $name = $this->data['uploadedFileName'] ?? basename($path);
                    $mime = function_exists('mime_content_type') ? mime_content_type($path) : null;
                    $options = ['as' => $name];
                    if ($mime) $options['mime'] = $mime;
                    $mail->attach($path, $options);
                } else {
                    $relative = str_replace(storage_path('app') . DIRECTORY_SEPARATOR, '', $this->data['uploadedFilePath']);
                    if (Storage::disk('local')->exists($relative)) {
                        $name = $this->data['uploadedFileName'] ?? basename($relative);
                        $mime = Storage::disk('local')->mimeType($relative);
                        $mail->attachFromStorageDisk('local', $relative, $name, ['mime' => $mime]);
                    } else {
                        Log::warning('ApplicationSubmitted: uploaded file not found for attachment', ['path' => $this->data['uploadedFilePath']]);
                    }
                }
            } catch (\Exception $e) {
                Log::warning('ApplicationSubmitted: failed to attach uploaded file: '.$e->getMessage(), ['path' => $this->data['uploadedFilePath']]);
            }
        }

        return $mail;
    }
}
