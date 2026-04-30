<?php

namespace App\Http\Controllers;

use App\Mail\AdminNotification;
use App\Mail\ApplicationSubmitted;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
 public function showApplicationForm()
{
    // Complete country list (249 countries)
    $countries = [
        'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda',
        'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain',
        'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan',
        'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria',
        'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon', 'Canada',
        'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros',
        'Congo, Democratic Republic of the', 'Congo, Republic of the', 'Costa Rica',
        'Cote d\'Ivoire', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark',
        'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador',
        'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Fiji',
        'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece',
        'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras',
        'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel',
        'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati',
        'Korea, North', 'Korea, South', 'Kosovo', 'Kuwait', 'Kyrgyzstan', 'Laos',
        'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania',
        'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta',
        'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia', 'Moldova',
        'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia',
        'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria',
        'North Macedonia', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama',
        'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal',
        'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia',
        'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe',
        'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore',
        'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Sudan',
        'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria',
        'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tonga',
        'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda',
        'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay',
        'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia',
        'Zimbabwe'
    ];
    
    sort($countries); // Optional: Sort alphabetically

    // Complete country codes
    $countryCodes = [
        '+93' => '+93 (Afghanistan)',
        '+355' => '+355 (Albania)',
        '+213' => '+213 (Algeria)',
        '+376' => '+376 (Andorra)',
        '+244' => '+244 (Angola)',
        '+1-268' => '+1-268 (Antigua and Barbuda)',
        '+54' => '+54 (Argentina)',
        '+374' => '+374 (Armenia)',
        '+61' => '+61 (Australia)',
        '+43' => '+43 (Austria)',
        '+994' => '+994 (Azerbaijan)',
        '+1-242' => '+1-242 (Bahamas)',
        '+973' => '+973 (Bahrain)',
        '+880' => '+880 (Bangladesh)',
        '+1-246' => '+1-246 (Barbados)',
        '+375' => '+375 (Belarus)',
        '+32' => '+32 (Belgium)',
        '+501' => '+501 (Belize)',
        '+229' => '+229 (Benin)',
        '+975' => '+975 (Bhutan)',
        '+591' => '+591 (Bolivia)',
        '+387' => '+387 (Bosnia and Herzegovina)',
        '+267' => '+267 (Botswana)',
        '+55' => '+55 (Brazil)',
        '+673' => '+673 (Brunei)',
        '+359' => '+359 (Bulgaria)',
        '+226' => '+226 (Burkina Faso)',
        '+257' => '+257 (Burundi)',
        '+238' => '+238 (Cabo Verde)',
        '+855' => '+855 (Cambodia)',
        '+237' => '+237 (Cameroon)',
        '+1' => '+1 (Canada/United States)',
        '+236' => '+236 (Central African Republic)',
        '+235' => '+235 (Chad)',
        '+56' => '+56 (Chile)',
        '+86' => '+86 (China)',
        '+57' => '+57 (Colombia)',
        '+269' => '+269 (Comoros)',
        '+243' => '+243 (Congo, DR)',
        '+242' => '+242 (Congo, Republic)',
        '+506' => '+506 (Costa Rica)',
        '+225' => '+225 (Côte d\'Ivoire)',
        '+385' => '+385 (Croatia)',
        '+53' => '+53 (Cuba)',
        '+357' => '+357 (Cyprus)',
        '+420' => '+420 (Czech Republic)',
        '+45' => '+45 (Denmark)',
        '+253' => '+253 (Djibouti)',
        '+1-767' => '+1-767 (Dominica)',
        '+1-809' => '+1-809 (Dominican Republic)',
        '+593' => '+593 (Ecuador)',
        '+20' => '+20 (Egypt)',
        '+503' => '+503 (El Salvador)',
        '+240' => '+240 (Equatorial Guinea)',
        '+291' => '+291 (Eritrea)',
        '+372' => '+372 (Estonia)',
        '+268' => '+268 (Eswatini)',
        '+251' => '+251 (Ethiopia)',
        '+679' => '+679 (Fiji)',
        '+358' => '+358 (Finland)',
        '+33' => '+33 (France)',
        '+241' => '+241 (Gabon)',
        '+220' => '+220 (Gambia)',
        '+995' => '+995 (Georgia)',
        '+49' => '+49 (Germany)',
        '+233' => '+233 (Ghana)',
        '+30' => '+30 (Greece)',
        '+1-473' => '+1-473 (Grenada)',
        '+502' => '+502 (Guatemala)',
        '+224' => '+224 (Guinea)',
        '+245' => '+245 (Guinea-Bissau)',
        '+592' => '+592 (Guyana)',
        '+509' => '+509 (Haiti)',
        '+504' => '+504 (Honduras)',
        '+36' => '+36 (Hungary)',
        '+354' => '+354 (Iceland)',
        '+91' => '+91 (India)',
        '+62' => '+62 (Indonesia)',
        '+98' => '+98 (Iran)',
        '+964' => '+964 (Iraq)',
        '+353' => '+353 (Ireland)',
        '+972' => '+972 (Israel)',
        '+39' => '+39 (Italy)',
        '+1-876' => '+1-876 (Jamaica)',
        '+81' => '+81 (Japan)',
        '+962' => '+962 (Jordan)',
        '+7' => '+7 (Kazakhstan/Russia)',
        '+254' => '+254 (Kenya)',
        '+686' => '+686 (Kiribati)',
        '+850' => '+850 (North Korea)',
        '+82' => '+82 (South Korea)',
        '+383' => '+383 (Kosovo)',
        '+965' => '+965 (Kuwait)',
        '+996' => '+996 (Kyrgyzstan)',
        '+856' => '+856 (Laos)',
        '+371' => '+371 (Latvia)',
        '+961' => '+961 (Lebanon)',
        '+266' => '+266 (Lesotho)',
        '+231' => '+231 (Liberia)',
        '+218' => '+218 (Libya)',
        '+423' => '+423 (Liechtenstein)',
        '+370' => '+370 (Lithuania)',
        '+352' => '+352 (Luxembourg)',
        '+261' => '+261 (Madagascar)',
        '+265' => '+265 (Malawi)',
        '+60' => '+60 (Malaysia)',
        '+960' => '+960 (Maldives)',
        '+223' => '+223 (Mali)',
        '+356' => '+356 (Malta)',
        '+692' => '+692 (Marshall Islands)',
        '+222' => '+222 (Mauritania)',
        '+230' => '+230 (Mauritius)',
        '+52' => '+52 (Mexico)',
        '+691' => '+691 (Micronesia)',
        '+373' => '+373 (Moldova)',
        '+377' => '+377 (Monaco)',
        '+976' => '+976 (Mongolia)',
        '+382' => '+382 (Montenegro)',
        '+212' => '+212 (Morocco)',
        '+258' => '+258 (Mozambique)',
        '+95' => '+95 (Myanmar)',
        '+264' => '+264 (Namibia)',
        '+674' => '+674 (Nauru)',
        '+977' => '+977 (Nepal)',
        '+31' => '+31 (Netherlands)',
        '+64' => '+64 (New Zealand)',
        '+505' => '+505 (Nicaragua)',
        '+227' => '+227 (Niger)',
        '+234' => '+234 (Nigeria)',
        '+389' => '+389 (North Macedonia)',
        '+47' => '+47 (Norway)',
        '+968' => '+968 (Oman)',
        '+92' => '+92 (Pakistan)',
        '+680' => '+680 (Palau)',
        '+970' => '+970 (Palestine)',
        '+507' => '+507 (Panama)',
        '+675' => '+675 (Papua New Guinea)',
        '+595' => '+595 (Paraguay)',
        '+51' => '+51 (Peru)',
        '+63' => '+63 (Philippines)',
        '+48' => '+48 (Poland)',
        '+351' => '+351 (Portugal)',
        '+974' => '+974 (Qatar)',
        '+40' => '+40 (Romania)',
        '+250' => '+250 (Rwanda)',
        '+1-869' => '+1-869 (Saint Kitts and Nevis)',
        '+1-758' => '+1-758 (Saint Lucia)',
        '+1-784' => '+1-784 (Saint Vincent and the Grenadines)',
        '+685' => '+685 (Samoa)',
        '+378' => '+378 (San Marino)',
        '+239' => '+239 (Sao Tome and Principe)',
        '+966' => '+966 (Saudi Arabia)',
        '+221' => '+221 (Senegal)',
        '+381' => '+381 (Serbia)',
        '+248' => '+248 (Seychelles)',
        '+232' => '+232 (Sierra Leone)',
        '+65' => '+65 (Singapore)',
        '+421' => '+421 (Slovakia)',
        '+386' => '+386 (Slovenia)',
        '+677' => '+677 (Solomon Islands)',
        '+252' => '+252 (Somalia)',
        '+27' => '+27 (South Africa)',
        '+211' => '+211 (South Sudan)',
        '+34' => '+34 (Spain)',
        '+94' => '+94 (Sri Lanka)',
        '+249' => '+249 (Sudan)',
        '+597' => '+597 (Suriname)',
        '+46' => '+46 (Sweden)',
        '+41' => '+41 (Switzerland)',
        '+963' => '+963 (Syria)',
        '+886' => '+886 (Taiwan)',
        '+992' => '+992 (Tajikistan)',
        '+255' => '+255 (Tanzania)',
        '+66' => '+66 (Thailand)',
        '+670' => '+670 (Timor-Leste)',
        '+228' => '+228 (Togo)',
        '+676' => '+676 (Tonga)',
        '+1-868' => '+1-868 (Trinidad and Tobago)',
        '+216' => '+216 (Tunisia)',
        '+90' => '+90 (Turkey)',
        '+993' => '+993 (Turkmenistan)',
        '+688' => '+688 (Tuvalu)',
        '+256' => '+256 (Uganda)',
        '+380' => '+380 (Ukraine)',
        '+971' => '+971 (United Arab Emirates)',
        '+44' => '+44 (United Kingdom)',
        '+598' => '+598 (Uruguay)',
        '+998' => '+998 (Uzbekistan)',
        '+678' => '+678 (Vanuatu)',
        '+379' => '+379 (Vatican City)',
        '+58' => '+58 (Venezuela)',
        '+84' => '+84 (Vietnam)',
        '+967' => '+967 (Yemen)',
        '+260' => '+260 (Zambia)',
        '+263' => '+263 (Zimbabwe)'
    ];

    $degrees = [
        'Doctor',
        'Nurse',
        'Paramedic',
        'Medical Technician',
        'Pharmacist',
        'Mental Health Professional',
        'Dental Staff',
        'Emergency Medical Staff',
        'Community Health Staff',
        'Medical Administration',
        'Other'
    ];

    return view('application_form', compact('countries', 'countryCodes', 'degrees'));
}
    public function submitApplication(Request $request)
    {
        Log::info('Application submission started', [
            'applicant_email' => $request->email,
            'ip' => $request->ip(),
        ]);

        // Comprehensive validation rules
        $validator = Validator::make($request->all(), [
            // Personal Information
            'fullName' => 'required|string|max:255',
            'dob' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:Male,Female',
            'citizenship' => 'required|string|max:100',
            'passport' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'countryCode' => 'required|string|max:8',
            'address' => 'nullable|string|max:500',
            'visaStatus' => 'required|in:U.S. Citizen,Permanent Resident,H-1B,O-1,J-1,Other',
            'otherVisaText' => 'required_if:visaStatus,Other|nullable|string|max:100',

            // Medical Education
            'degree' => 'required|string|max:255',
            'otherDegree' => 'required_if:degree,Other|nullable|string|max:255',
            'medicalSchool' => 'required|string|max:255',
            'schoolCountry' => 'required|string|max:100',
            'graduationYear' => 'required|integer|min:1900|max:'.date('Y'),
            'ecfmg' => 'required|in:Yes,No',

            // Foreign Medical Licensure
            'licenseCountry' => 'required|string|max:100',
            'licenseNumber' => 'required|string|max:100',
            'issueDate' => 'required|date',
            'expiryDate' => 'required|date|after:issueDate',
            'licensureStatus' => 'required|in:Active and in Good Standing,Not in Good Standing',
            'disciplinary' => 'required|in:None,Yes',

            // Postgraduate Training
            'pathway' => 'required|in:Path A,Path B',
            'residency' => 'required_if:pathway,Path A|nullable|in:Yes,No',
            'residencyInstitution' => 'required_if:pathway,Path A|nullable|string|max:255',
            'residencyFrom' => 'required_if:pathway,Path A|nullable|date',
            'residencyTo' => 'required_if:pathway,Path A|nullable|date|after:residencyFrom',
            'postResidencyYears' => 'required_if:pathway,Path A|nullable|integer|min:5|max:50',
            'totalPracticeYears' => 'required_if:pathway,Path B|nullable|integer|min:10|max:50',

            // Exam Requirements
            'step1' => 'required|in:Passed,Pending,Not Attempted',
            'step2' => 'required|in:Passed,Pending,Not Attempted',
            'jurisprudence' => 'required|in:Passed,Pending',
            'english' => 'required|in:IELTS,TOEFL,OET,Native English Speaker',

            // Employment in Texas
            'jobOffer' => 'required|in:Yes,No',
            'employerName' => 'required_if:jobOffer,Yes|nullable|string|max:255',
            'facilityType' => 'required_if:jobOffer,Yes|nullable|in:Hospital,Facility-Based Practice,Group Medical Practice',
            'employerAddress' => 'required_if:jobOffer,Yes|nullable|string|max:500',
            'contactPerson' => 'required_if:jobOffer,Yes|nullable|string|max:255',
            'designation' => 'required_if:jobOffer,Yes|nullable|string|max:100',
            'contactPhone' => 'required_if:jobOffer,Yes|nullable|string|max:20',
            'contactEmail' => 'required_if:jobOffer,Yes|nullable|email|max:255',

            // Security & Background Check
            'securityRisk' => 'required|in:No,Yes',
            'itar' => 'required|in:No,Yes',
            'criminal' => 'required|in:None,Yes',
            'military' => 'required|in:None,Yes',
            'misconduct' => 'required_if:military,Yes|nullable|in:No,Yes',
            'investigations' => 'required|in:No,Yes',

            // Applicant Attestation
            'applicantSignature' => 'required|string|max:255',
            'signatureDate' => 'required|date',
            // Optional uploaded documents (each max 2MB)
            'uploadDocument' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:5120',
            'doc_passport' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_diploma' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_transcripts' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_ecfmg' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_foreign_license' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_good_standing' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_disciplinary' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_residency' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_experience' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_usmle1' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_usmle2' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_jurisprudence' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_english' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_job_offer' => 'required_if:jobOffer,Yes|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_contract' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_criminal' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_police_clearance' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
            'doc_military' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,txt,xls,xlsx,csv|max:2048',
        ], [
            // Custom error messages
            'dob.before_or_equal' => 'Date of birth cannot be in the future.',
            'dob.before' => 'Date of birth must be in the past.',
            'expiryDate.after' => 'Expiry date must be after issue date.',
            'residencyTo.after' => 'Residency end date must be after start date.',
            'postResidencyYears.min' => 'Post-residency years must be at least 5 years.',
            'totalPracticeYears.min' => 'Total practice years must be at least 10 years.',
            'required_if' => 'This field is required when :other is selected.',
            'email' => 'Please enter a valid email address.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            Log::warning('Application validation failed', [
                'errors' => $validator->errors()->toArray(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Please fix the validation errors.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // // Additional validation: Security restrictions
        // if ($request->securityRisk === 'Yes' || $request->itar === 'Yes') {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Application cannot be submitted due to security restrictions.',
        //         'errors' => [
        //             'securityRisk' => ['Citizenship from restricted countries is not eligible.'],
        //             'itar' => ['Citizenship from ITAR restricted countries is not eligible.'],
        //         ],
        //     ], 422);
        // }

        // Generate application ID
        $applicationId = 'TDA-'.date('Y').'-'.strtoupper(Str::random(8));

        // Prepare data
        $data = $validator->validated();
        // Normalize degree: if 'Other' is selected and otherDegree provided, combine for storage/preview
        if (isset($data['degree']) && $data['degree'] === 'Other') {
            $other = $data['otherDegree'] ?? null;
            if (!empty($other)) {
                $data['degree'] = 'Other: ' . $other;
            }
        }
        // Handle uploaded files if present: store under storage/app/applications/{applicationId}/
        $docFields = [
            'uploadDocument', 'doc_passport', 'doc_diploma', 'doc_transcripts', 'doc_ecfmg',
            'doc_foreign_license', 'doc_good_standing', 'doc_disciplinary', 'doc_residency',
            'doc_experience', 'doc_usmle1', 'doc_usmle2', 'doc_jurisprudence', 'doc_english',
            'doc_job_offer', 'doc_contract', 'doc_criminal', 'doc_police_clearance', 'doc_military'
        ];

        foreach ($docFields as $field) {
            if ($request->hasFile($field)) {
                try {
                    $file = $request->file($field);
                    $originalName = $file->getClientOriginalName();
                    $storedPath = $file->storeAs(
                        'applications/'.$applicationId,
                        Str::uuid().'_'.$originalName,
                        'public'
                    );

                    // Keep original filename for preview/email and store the persisted path for downloads
                    $data[$field] = $originalName;
                    $data[$field.'_path'] = $storedPath;
                    // Keep raw file contents and mime type so we can attach without persisting to disk
                    $data[$field.'_raw'] = $file->get();
                    $data[$field.'_mime'] = $file->getClientMimeType();
                    $data[$field.'_size'] = $file->getSize();
                } catch (\Exception $e) {
                    Log::warning('Failed to read uploaded file ('.$field.'): '.$e->getMessage());
                }
            }
        }
        $data['applicationId'] = $applicationId;
        $data['submissionDate'] = now()->format('F d, Y');
        $data['submissionTime'] = now()->format('h:i A');
        $data['ipAddress'] = $request->ip();
        $data['userAgent'] = $request->userAgent();

        try {
            Log::info('Attempting to send applicant email', [
                'to' => $data['email'],
                'application_id' => $applicationId,
            ]);

            // Send email to applicant (do not include raw binary contents)
            $sanitizedForApplicant = $data;
            foreach (array_keys($sanitizedForApplicant) as $k) {
                if (is_string($k) && str_ends_with($k, '_raw')) {
                    unset($sanitizedForApplicant[$k]);
                }
            }
            Mail::to($data['email'])->send(new ApplicationSubmitted($sanitizedForApplicant));
            Log::info('Applicant email sent successfully');

            // Send email to admin(s). `ADMIN_EMAIL` may contain comma-separated addresses.
            $adminEmails = config('app.admin_emails', [env('ADMIN_EMAIL', 'waztechnologies@gmail.com')]);
            Log::info('Attempting to send admin email', [
                'to' => $adminEmails,
                'application_id' => $applicationId,
            ]);

            Mail::to($adminEmails)->send(new AdminNotification($data));
            Log::info('Admin email sent successfully');

            // Save application to database
            $this->saveApplicationToDatabase($data);

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!',
                'applicationId' => $applicationId,
                'emailSent' => true,
                'redirectUrl' => route('user.dashboard'),
            ]);

        } catch (\Exception $e) {
            Log::error('Application submission failed: '.$e->getMessage(), [
                'application_id' => $applicationId,
                'applicant' => $data['fullName'] ?? 'Unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Save application to file as backup
            $this->saveApplicationToFile($data, $applicationId);

            return response()->json([
                'success' => true, // Still success for application submission
                'message' => 'Application submitted but email notification failed. Please save your Application ID: '.$applicationId,
                'applicationId' => $applicationId,
                'emailSent' => false,
                'note' => 'Application has been saved. Please contact support with your Application ID.',
                'redirectUrl' => route('user.dashboard'),
            ]);
        }
    }

    /**
     * Save application to file as backup
     */
    private function saveApplicationToFile($data, $applicationId)
    {
        try {
            // Sanitize data before writing to disk: remove raw binary blobs
            $sanitized = $data;
            foreach (array_keys($sanitized) as $key) {
                if (is_string($key) && str_ends_with($key, '_raw')) {
                    $sanitized[$key] = '[REDACTED_BINARY]';
                }
                // Optionally redact very large strings
                if (is_string($sanitized[$key]) && strlen($sanitized[$key]) > 100000) {
                    $sanitized[$key] = '[REDACTED_LARGE_CONTENT]';
                }
            }

            $logData = [
                'application_id' => $applicationId,
                'timestamp' => now()->toDateTimeString(),
                'data' => $sanitized,
            ];

            $filename = storage_path('logs/applications/'.$applicationId.'.json');

            // Create directory if it doesn't exist
            if (! is_dir(dirname($filename))) {
                mkdir(dirname($filename), 0755, true);
            }

            file_put_contents($filename, json_encode($logData, JSON_PRETTY_PRINT));

            Log::info('Application saved to file', ['application_id' => $applicationId]);

        } catch (\Exception $e) {
            Log::error('Failed to save application to file: '.$e->getMessage());
        }
    }

    /**
     * Save application to database
     */
    private function saveApplicationToDatabase($data)
    {
        try {
            // Prepare data for database (convert camelCase to snake_case)
            $dbData = [
                'application_id' => $data['applicationId'],
                'full_name' => $data['fullName'],
                'dob' => $data['dob'],
                'gender' => $data['gender'],
                'citizenship' => $data['citizenship'],
                'passport' => $data['passport'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'country_code' => $data['countryCode'],
                'address' => $data['address'] ?? null,
                'visa_status' => $data['visaStatus'],
                'other_visa_text' => $data['otherVisaText'] ?? null,
                'degree' => $data['degree'],
                'other_degree' => $data['otherDegree'] ?? null,
                'medical_school' => $data['medicalSchool'],
                'school_country' => $data['schoolCountry'],
                'graduation_year' => $data['graduationYear'],
                'ecfmg' => $data['ecfmg'],
                'license_country' => $data['licenseCountry'],
                'license_number' => $data['licenseNumber'],
                'issue_date' => $data['issueDate'],
                'expiry_date' => $data['expiryDate'],
                'licensure_status' => $data['licensureStatus'],
                'disciplinary' => $data['disciplinary'],
                'pathway' => $data['pathway'],
                'residency' => $data['residency'] ?? null,
                'residency_institution' => $data['residencyInstitution'] ?? null,
                'residency_from' => $data['residencyFrom'] ?? null,
                'residency_to' => $data['residencyTo'] ?? null,
                'post_residency_years' => $data['postResidencyYears'] ?? null,
                'total_practice_years' => $data['totalPracticeYears'] ?? null,
                'step1' => $data['step1'],
                'step2' => $data['step2'],
                'jurisprudence' => $data['jurisprudence'],
                'english' => $data['english'],
                'job_offer' => $data['jobOffer'],
                'employer_name' => $data['employerName'] ?? null,
                'facility_type' => $data['facilityType'] ?? null,
                'employer_address' => $data['employerAddress'] ?? null,
                'contact_person' => $data['contactPerson'] ?? null,
                'designation' => $data['designation'] ?? null,
                'contact_phone' => $data['contactPhone'] ?? null,
                'contact_email' => $data['contactEmail'] ?? null,
                'security_risk' => $data['securityRisk'],
                'itar' => $data['itar'],
                'criminal' => $data['criminal'],
                'military' => $data['military'],
                'misconduct' => $data['misconduct'] ?? null,
                'investigations' => $data['investigations'],
                'applicant_signature' => $data['applicantSignature'],
                'signature_date' => $data['signatureDate'],
                'status' => 'submitted',
                'ip_address' => $data['ipAddress'],
                'user_agent' => $data['userAgent'],
                'submission_date' => now(),
            ];

            // Add document filenames if uploaded
            $docFields = [
                'uploadDocument' => 'upload_document',
                'doc_passport' => 'doc_passport',
                'doc_diploma' => 'doc_diploma',
                'doc_transcripts' => 'doc_transcripts',
                'doc_ecfmg' => 'doc_ecfmg',
                'doc_foreign_license' => 'doc_foreign_license',
                'doc_good_standing' => 'doc_good_standing',
                'doc_disciplinary' => 'doc_disciplinary',
                'doc_residency' => 'doc_residency',
                'doc_experience' => 'doc_experience',
                'doc_usmle1' => 'doc_usmle1',
                'doc_usmle2' => 'doc_usmle2',
                'doc_jurisprudence' => 'doc_jurisprudence',
                'doc_english' => 'doc_english',
                'doc_job_offer' => 'doc_job_offer',
                'doc_contract' => 'doc_contract',
                'doc_criminal' => 'doc_criminal',
                'doc_police_clearance' => 'doc_police_clearance',
                'doc_military' => 'doc_military',
            ];

            foreach ($docFields as $camelCase => $snakeCase) {
                if (isset($data[$camelCase]) && !str_ends_with($camelCase, '_raw')) {
                    $dbData[$snakeCase] = $data[$camelCase.'_path'] ?? $data[$camelCase];
                }
            }

            Application::create($dbData);
            
            Log::info('Application saved to database', ['application_id' => $data['applicationId']]);
        } catch (\Exception $e) {
            Log::error('Failed to save application to database: '.$e->getMessage(), [
                'application_id' => $data['applicationId'] ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Show edit form for application with objected fields
     */
    public function editApplication($application_id)
    {
        $application = Application::where('application_id', $application_id)
            ->where('objection_pending', true)
            ->firstOrFail();

        // Decode objected fields
        $objectedFields = json_decode($application->objected_fields, true) ?? [];

        // Get countries list (same as showApplicationForm)
        $countries = [
            'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda',
            'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain',
            'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan',
            'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria',
            'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon', 'Canada',
            'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros',
            'Congo, Democratic Republic of the', 'Congo, Republic of the', 'Costa Rica',
            'Cote d\'Ivoire', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark',
            'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador',
            'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Fiji',
            'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece',
            'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras',
            'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel',
            'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati',
            'Korea, North', 'Korea, South', 'Kosovo', 'Kuwait', 'Kyrgyzstan', 'Laos',
            'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania',
            'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta',
            'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia', 'Moldova',
            'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia',
            'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria',
            'North Macedonia', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama',
            'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal',
            'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia',
            'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe',
            'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore',
            'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Sudan',
            'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria',
            'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tonga',
            'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda',
            'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay',
            'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia',
            'Zimbabwe'
        ];

        return view('application_edit', compact('application', 'objectedFields', 'countries'));
    }

    /**
     * Update application with corrected objected fields
     */
    public function updateApplication(Request $request, $application_id)
    {
        $application = Application::where('application_id', $application_id)
            ->where('objection_pending', true)
            ->firstOrFail();

        $objectedFields = json_decode($application->objected_fields, true) ?? [];

        // Build validation rules only for objected fields
        $rules = [];
        foreach ($objectedFields as $field) {
            // Text fields
            if (in_array($field, ['full_name', 'email', 'passport', 'medical_school', 'license_number', 
                'citizenship', 'country_code', 'phone', 'degree', 'other_degree', 'school_country', 
                'license_country', 'residency_institution', 'employer_name', 'facility_type', 
                'contact_person', 'designation', 'contact_phone', 'contact_email', 'applicant_signature'])) {
                $rules[$field] = in_array($field, ['full_name', 'email', 'passport', 'medical_school', 'license_number']) 
                    ? 'required|string|max:255' 
                    : 'nullable|string|max:255';
            }
            // Date fields
            elseif (in_array($field, ['dob', 'issue_date', 'expiry_date', 'residency_from', 'residency_to', 'signature_date'])) {
                $rules[$field] = in_array($field, ['dob', 'issue_date', 'expiry_date']) ? 'required|date' : 'nullable|date';
            }
            // Number fields
            elseif (in_array($field, ['graduation_year', 'post_residency_years', 'total_practice_years'])) {
                $rules[$field] = $field === 'graduation_year' 
                    ? 'required|integer|min:1950|max:' . (date('Y') + 10)
                    : 'nullable|integer';
            }
            // Select fields
            elseif (in_array($field, ['gender', 'visa_status', 'ecfmg', 'licensure_status', 'disciplinary', 
                'pathway', 'residency', 'step1', 'step2', 'jurisprudence', 'english', 'job_offer', 
                'security_risk', 'itar', 'criminal', 'military', 'misconduct', 'investigations'])) {
                $rules[$field] = 'nullable|string';
            }
            // Textarea fields
            elseif (in_array($field, ['address', 'employer_address'])) {
                $rules[$field] = 'nullable|string';
            }
            // Document fields
            elseif (str_starts_with($field, 'doc_')) {
                $rules[$field] = 'nullable|file|max:5120';
            }
        }

        $validated = $request->validate($rules);

        // Update only objected fields
        foreach ($objectedFields as $field) {
            if (str_starts_with($field, 'doc_') && $request->hasFile($field)) {
                // Handle file upload
                $file = $request->file($field);
                $filename = time() . '_' . $application_id . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->move(storage_path('app/public/applications'), $filename);
                $application->$field = $filename;
            } elseif (isset($validated[$field])) {
                $application->$field = $validated[$field];
            }
        }

        // Clear objection status
        $application->objection_pending = false;
        $application->objected_fields = null;
        $application->objection_message = null;
        $application->save();

        return redirect()->route('user.dashboard')
            ->with('success', 'Your application has been updated successfully. We will review your changes.');
    }
}
