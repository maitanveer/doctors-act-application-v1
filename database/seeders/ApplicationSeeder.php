<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $statuses = ['submitted', 'under_review', 'approved', 'rejected'];
        
        for ($i = 1; $i <= 20; $i++) {
            Application::create([
                'application_id' => 'APP-2026-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                
                // Personal Information
                'full_name' => $faker->name(),
                'dob' => $faker->date('Y-m-d', '-25 years'),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'citizenship' => $faker->country(),
                'passport' => strtoupper($faker->bothify('??######')),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->numerify('##########'),
                'country_code' => $faker->randomElement(['+1', '+44', '+91', '+86', '+81']),
                'address' => $faker->address(),
                'visa_status' => $faker->randomElement(['F-1', 'J-1', 'H-1B', 'Green Card', 'Citizen']),
                'other_visa_text' => null,
                
                // Medical Education
                'degree' => $faker->randomElement(['MD', 'MBBS', 'DO']),
                'other_degree' => null,
                'medical_school' => $faker->randomElement([
                    'Harvard Medical School',
                    'Johns Hopkins University',
                    'Stanford University',
                    'University of Pennsylvania',
                    'Mayo Clinic School of Medicine',
                    'Duke University School of Medicine'
                ]),
                'school_country' => $faker->randomElement(['United States', 'United Kingdom', 'Canada', 'India', 'China']),
                'graduation_year' => $faker->numberBetween(2010, 2023),
                'ecfmg' => $faker->randomElement(['Yes', 'No', 'Pending']),
                
                // Foreign Medical Licensure
                'license_country' => $faker->randomElement(['United States', 'United Kingdom', 'Canada', 'India']),
                'license_number' => strtoupper($faker->bothify('LIC-#####??')),
                'issue_date' => $faker->date('Y-m-d', '-5 years'),
                'expiry_date' => $faker->date('Y-m-d', '+2 years'),
                'licensure_status' => $faker->randomElement(['Active', 'Inactive', 'Suspended']),
                'disciplinary' => $faker->randomElement(['Yes', 'No']),
                
                // Postgraduate Training
                'pathway' => $faker->randomElement(['Standard', 'J-1 Waiver']),
                'residency' => $faker->randomElement(['Yes', 'No']),
                'residency_institution' => $faker->randomElement([
                    'Massachusetts General Hospital',
                    'Cleveland Clinic',
                    'Mayo Clinic',
                    'UCSF Medical Center',
                    null
                ]),
                'residency_from' => $faker->optional()->date('Y-m-d', '-8 years'),
                'residency_to' => $faker->optional()->date('Y-m-d', '-4 years'),
                'post_residency_years' => $faker->optional()->numberBetween(0, 10),
                'total_practice_years' => $faker->numberBetween(1, 15),
                
                // Exam Requirements
                'step1' => $faker->randomElement(['Passed', 'Failed', 'Not Taken']),
                'step2' => $faker->randomElement(['Passed', 'Failed', 'Not Taken']),
                'jurisprudence' => $faker->randomElement(['Passed', 'Failed', 'Not Taken']),
                'english' => $faker->randomElement(['TOEFL', 'IELTS', 'Native Speaker', 'Not Required']),
                
                // Employment in Texas
                'job_offer' => $faker->randomElement(['Yes', 'No']),
                'employer_name' => $faker->optional()->company(),
                'facility_type' => $faker->optional()->randomElement(['Hospital', 'Clinic', 'Private Practice', 'Academic']),
                'employer_address' => $faker->optional()->address(),
                'contact_person' => $faker->optional()->name(),
                'designation' => $faker->optional()->randomElement(['HR Manager', 'Medical Director', 'Chief of Staff']),
                'contact_phone' => $faker->optional()->numerify('##########'),
                'contact_email' => $faker->optional()->safeEmail(),
                
                // Security & Background Check
                'security_risk' => $faker->randomElement(['Yes', 'No']),
                'itar' => $faker->randomElement(['Yes', 'No']),
                'criminal' => $faker->randomElement(['Yes', 'No', 'Pending']),
                'military' => $faker->randomElement(['Yes', 'No', 'Exempt']),
                'misconduct' => $faker->optional()->randomElement(['Yes', 'No']),
                'investigations' => $faker->randomElement(['Yes', 'No']),
                
                // Applicant Attestation
                'applicant_signature' => $faker->name(),
                'signature_date' => $faker->date('Y-m-d', 'now'),
                
                // Document uploads (dummy filenames)
                'upload_document' => 'uploads/application_' . $i . '_doc.pdf',
                'doc_passport' => 'uploads/passport_' . $i . '.pdf',
                'doc_diploma' => 'uploads/diploma_' . $i . '.pdf',
                'doc_transcripts' => 'uploads/transcripts_' . $i . '.pdf',
                'doc_ecfmg' => $faker->optional()->bothify('uploads/ecfmg_#.pdf'),
                'doc_foreign_license' => 'uploads/license_' . $i . '.pdf',
                'doc_good_standing' => $faker->optional()->bothify('uploads/standing_#.pdf'),
                'doc_disciplinary' => $faker->optional()->bothify('uploads/disciplinary_#.pdf'),
                'doc_residency' => $faker->optional()->bothify('uploads/residency_#.pdf'),
                'doc_experience' => $faker->optional()->bothify('uploads/experience_#.pdf'),
                'doc_usmle1' => $faker->optional()->bothify('uploads/usmle1_#.pdf'),
                'doc_usmle2' => $faker->optional()->bothify('uploads/usmle2_#.pdf'),
                'doc_jurisprudence' => $faker->optional()->bothify('uploads/juris_#.pdf'),
                'doc_english' => $faker->optional()->bothify('uploads/english_#.pdf'),
                'doc_job_offer' => $faker->optional()->bothify('uploads/job_#.pdf'),
                'doc_contract' => $faker->optional()->bothify('uploads/contract_#.pdf'),
                'doc_criminal' => $faker->optional()->bothify('uploads/criminal_#.pdf'),
                'doc_police_clearance' => $faker->optional()->bothify('uploads/police_#.pdf'),
                'doc_military' => $faker->optional()->bothify('uploads/military_#.pdf'),
                
                // Metadata
                'status' => $statuses[array_rand($statuses)],
                'ip_address' => $faker->ipv4(),
                'user_agent' => $faker->userAgent(),
                'submission_date' => $faker->dateTimeBetween('-30 days', 'now'),
                
                'created_at' => $faker->dateTimeBetween('-30 days', 'now'),
                'updated_at' => now(),
            ]);
        }

        echo "✅ 20 dummy applications created successfully!\n";
    }
}
