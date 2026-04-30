<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display user dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get user's applications
        $applications = Application::where('email', $user->email)
            ->latest('submission_date')
            ->get();

        // Calculate statistics
        $stats = [
            'total_applications' => $applications->count(),
            'pending_applications' => $applications->where('status', 'submitted')->count(),
            'approved_applications' => $applications->where('status', 'approved')->count(),
            'rejected_applications' => $applications->where('status', 'rejected')->count(),
            'under_review' => $applications->where('status', 'under_review')->count(),
            'objection_pending' => $applications->where('objection_pending', true)->count(),
        ];

        return view('user.dashboard', compact('applications', 'stats'));
    }

    /**
     * Show specific application details
     */
    public function showApplication($id)
    {
        $application = Application::where('id', $id)
            ->where('email', Auth::user()->email)
            ->firstOrFail();

        return view('user.application-details', compact('application'));
    }
}
