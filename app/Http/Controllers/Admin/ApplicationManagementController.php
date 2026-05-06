<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationStatusChanged;
use App\Mail\AdditionalDocumentRequest;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Exports\ApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ApplicationManagementController extends Controller
{
    /**
     * Display all applications
     */
    public function index(Request $request)
    {
        $query = Application::query();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search by name, email, or application ID
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('application_id', 'like', '%'.$search.'%');
            });
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('submission_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('submission_date', '<=', $request->date_to);
        }

        $applications = $query->latest('submission_date')->paginate(20)->withQueryString();

        return view('admin.applications.index', compact('applications'));
    }

    /**
     * Show single application details
     */
    public function show($id)
    {
        $application = Application::findOrFail($id);
        return view('admin.applications.show', compact('application'));
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $application = Application::findOrFail($id);
        return view('admin.applications.edit', compact('application'));
    }

    /**
     * Update application
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'citizenship' => 'required|string',
            'passport' => 'required|string',
            'visa_status' => 'required|string',
            'degree' => 'required|string',
            'medical_school' => 'required|string',
            'school_country' => 'required|string',
            'graduation_year' => 'required|integer',
            'license_country' => 'required|string',
            'license_number' => 'required|string',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'licensure_status' => 'required|string',
            'disciplinary' => 'required|string',
        ]);

        $application = Application::findOrFail($id);
        $application->update($request->all());

        return redirect()->route('admin.applications.show', $id)
            ->with('success', 'Application updated successfully.');
    }

    /**
     * Update application status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:submitted,under_review,approved,rejected',
            'notes' => 'nullable|string',
            'rejection_reason' => 'required_if:status,rejected|nullable|string',
        ]);

        $application = Application::findOrFail($id);
        $oldStatus = $application->status;
        
        $application->status = $request->status;
        $application->admin_notes = $request->notes;
        $application->status_updated_at = now();
        $application->updated_by = Auth::id();
        
        if ($request->status === 'rejected') {
            $application->rejection_reason = $request->rejection_reason;
        }
        
        $application->save();

        // Send email notification
        try {
            Mail::to($application->email)->send(
                new ApplicationStatusChanged($application, $oldStatus, $request->status, $request->notes)
            );
            
            Log::info('Status change email sent successfully', [
                'application_id' => $application->application_id,
                'old_status' => $oldStatus,
                'new_status' => $request->status,
                'email' => $application->email,
                'sent_at' => now()
            ]);
            
            return back()->with('success', 'Application status updated and email notification sent successfully to ' . $application->email);
            
        } catch (\Exception $e) {
            Log::error('Failed to send status change email', [
                'application_id' => $application->application_id,
                'email' => $application->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('warning', 'Application status updated but email notification failed. Error: ' . $e->getMessage());
        }
    }

    /**
     * Request objected documents/fields
     */
    public function requestAdditionalDocuments(Request $request, $id)
    {
        $request->validate([
            'objected_fields' => 'required|array',
            'objected_fields.*' => 'string',
            'objection_message' => 'required|string',
        ]);

        $application = Application::findOrFail($id);
        
        $application->objection_pending = true;
        $application->objected_fields = json_encode($request->objected_fields);
        $application->objection_message = $request->objection_message;
        $application->updated_by = Auth::id();
        $application->save();

        $userEmailSent = false;
        $adminEmailSent = false;
        $emailErrors = [];

        // Send email notification to user
        try {
            Mail::to($application->email)->send(
                new \App\Mail\ObjectedFieldsNotificationUser(
                    $application,
                    $request->objected_fields,
                    $request->objection_message
                )
            );
            
            $userEmailSent = true;
            
            Log::info('Objected fields email sent to user', [
                'application_id' => $application->application_id,
                'email' => $application->email,
                'fields' => $request->objected_fields,
                'message' => $request->objection_message
            ]);
        } catch (\Exception $e) {
            $emailErrors[] = 'User email failed: ' . $e->getMessage();
            Log::error('Failed to send objected fields email to user', [
                'error' => $e->getMessage(),
                'application_id' => $application->application_id,
                'email' => $application->email
            ]);
        }

        // Send email notification to admin
        try {
            $adminEmails = explode(',', env('ADMIN_EMAIL', 'admin@ibnsinafoundation.org'));
            $adminEmails = array_map('trim', $adminEmails);
            
            Mail::to($adminEmails)->send(
                new \App\Mail\ObjectedFieldsNotificationAdmin(
                    $application,
                    $request->objected_fields,
                    $request->objection_message
                )
            );
            
            $adminEmailSent = true;
            
            Log::info('Objected fields notification sent to admin', [
                'application_id' => $application->application_id,
                'admin_emails' => $adminEmails,
                'fields' => $request->objected_fields,
                'message' => $request->objection_message
            ]);
        } catch (\Exception $e) {
            $emailErrors[] = 'Admin email failed: ' . $e->getMessage();
            Log::error('Failed to send objected fields email to admin', [
                'error' => $e->getMessage(),
                'application_id' => $application->application_id,
                'admin_emails' => $adminEmails ?? []
            ]);
        }

        // Return with appropriate message
        if ($userEmailSent && $adminEmailSent) {
            return back()->with('success', 'Objection request saved and email notifications sent successfully to applicant (' . $application->email . ') and admin team.');
        } elseif ($userEmailSent || $adminEmailSent) {
            $message = 'Objection request saved. ';
            if ($userEmailSent) {
                $message .= 'Email sent to applicant (' . $application->email . '). ';
            }
            if ($adminEmailSent) {
                $message .= 'Email sent to admin team. ';
            }
            if (!empty($emailErrors)) {
                $message .= 'However, some emails failed: ' . implode(', ', $emailErrors);
            }
            return back()->with('warning', $message);
        } else {
            return back()->with('warning', 'Objection request saved but email notifications failed. Errors: ' . implode(', ', $emailErrors));
        }
    }

    /**
     * Delete application
     */
    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application deleted successfully.');
    }

    /**
     * Export single application using the supported format.
     */
    public function export($id)
    {
        return $this->exportSinglePdf($id);
    }

    /**
     * Bulk delete applications
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'application_ids' => 'required|array',
            'application_ids.*' => 'exists:applications,id',
        ]);

        Application::whereIn('id', $request->application_ids)->delete();

        return back()->with('success', count($request->application_ids) . ' applications deleted successfully.');
    }

    /**
     * Bulk update status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'application_ids' => 'required|array',
            'application_ids.*' => 'exists:applications,id',
            'status' => 'required|in:submitted,under_review,approved,rejected',
        ]);

        Application::whereIn('id', $request->application_ids)
            ->update(['status' => $request->status]);

        return back()->with('success', count($request->application_ids) . ' applications updated successfully.');
    }

    /**
     * Export all applications to Excel
     */
    public function exportExcel(Request $request)
    {
        $query = Application::query();

        // Apply filters if present
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('application_id', 'like', '%'.$search.'%');
            });
        }

        $filename = 'applications_' . date('Y-m-d_His') . '.xlsx';
        return Excel::download(new ApplicationsExport($query), $filename);
    }

    /**
     * Export all applications to PDF
     */
    public function exportPdf(Request $request)
    {
        $query = Application::query();

        // Apply filters if present
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('application_id', 'like', '%'.$search.'%');
            });
        }

        $applications = $query->get();
        $pdf = Pdf::loadView('admin.applications.pdf', compact('applications'));
        
        $filename = 'applications_' . date('Y-m-d_His') . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Export single application to PDF
     */
    public function exportSinglePdf($id)
    {
        $application = Application::findOrFail($id);
        $pdf = Pdf::loadView('admin.applications.single-pdf', compact('application'));
        
        $filename = 'application_' . $application->application_id . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Download document file
     */
    public function downloadDocument($id, $field)
    {
        $application = Application::findOrFail($id);

        if (!in_array($field, $application->getFillable(), true)) {
            abort(404);
        }

        $filePath = $application->$field;
        if (!$filePath) {
            return back()->with('error', 'Document not found.');
        }

        $download = $this->resolveStoredDocument($filePath);
        if (!$download) {
            return back()->with('error', 'Document not found.');
        }

        return response()->download($download['path'], $download['name']);
    }

    private function resolveStoredDocument(string $storedValue): ?array
    {
        $publicCandidates = [
            $storedValue,
            'applications/'.$storedValue,
            'applications/'.basename($storedValue),
            'applications/'.trim($storedValue, '/'),
        ];

        foreach (array_unique($publicCandidates) as $candidate) {
            if (Storage::disk('public')->exists($candidate)) {
                return [
                    'path' => Storage::disk('public')->path($candidate),
                    'name' => basename($candidate),
                ];
            }
        }

        $localCandidates = [
            storage_path('app/public/'.ltrim($storedValue, '/')),
            storage_path('app/public/applications/'.basename($storedValue)),
            storage_path('app/'.ltrim($storedValue, '/')),
        ];

        foreach ($localCandidates as $candidate) {
            if (is_file($candidate)) {
                return [
                    'path' => $candidate,
                    'name' => basename($candidate),
                ];
            }
        }

        return null;
    }
}
