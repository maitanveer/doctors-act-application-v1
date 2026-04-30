<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query;
    }

    public function collection()
    {
        if ($this->query) {
            return $this->query->get();
        }
        return Application::all();
    }

    public function headings(): array
    {
        return [
            'Application ID',
            'Full Name',
            'Email',
            'Phone',
            'Date of Birth',
            'Country',
            'State/Province',
            'City',
            'Status',
            'Submission Date',
            'Medical School',
            'Graduation Year',
            'License Number',
            'Specialty',
            'Objection Pending',
            'Admin Notes',
        ];
    }

    public function map($application): array
    {
        return [
            $application->application_id,
            $application->full_name,
            $application->email,
            $application->phone,
            $application->date_of_birth ? $application->date_of_birth->format('Y-m-d') : 'N/A',
            $application->country,
            $application->state_province,
            $application->city,
            ucfirst($application->status),
            $application->submission_date ? $application->submission_date->format('Y-m-d H:i') : 'N/A',
            $application->medical_school,
            $application->graduation_year,
            $application->license_number,
            $application->specialty,
            $application->objection_pending ? 'Yes' : 'No',
            $application->admin_notes ?? 'N/A',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
