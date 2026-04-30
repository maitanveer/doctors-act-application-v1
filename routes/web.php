<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApplicationManagementController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// About Us Routes
Route::get('/aboutus', function () {
    return view('pages.aboutus');
})->name('aboutus');

Route::get('/mentalhealthteam', function () {
    return view('pages.mentalhealthteam');
})->name('mentalhealthteam');

Route::get('/specialistteam', function () {
    return view('pages.specialistteam');
})->name('specialistteam');

Route::get('/medicalteam', function () {
    return view('pages.medicalteam');
})->name('medicalteam');

Route::get('/dentalteam', function () {
    return view('pages.dentalteam');
})->name('dentalteam');

Route::get('/partners', function () {
    return view('pages.partners');
})->name('partners');

Route::get('/proclamations', function () {
    return view('pages.proclamations');
})->name('proclamations');

// News and Media Routes
Route::get('/upcomingevents', function () {
    return view('pages.upcomingevents');
})->name('upcomingevents');

Route::get('/news', function () {
    return view('pages.news');
})->name('news');

Route::get('/eventvideos', function () {
    return view('pages.eventvideos');
})->name('eventvideos');

Route::get('/photogallery', function () {
    return view('pages.photogallery');
})->name('photogallery');

// Leadership Routes
Route::get('/boardofdirectors', function () {
    return view('pages.boardofdirectors');
})->name('boardofdirectors');

Route::get('/managementteam', function () {
    return view('pages.managementteam');
})->name('managementteam');

// Services Routes
Route::get('/mentalhealthservices', function () {
    return view('services.mentalhealth');
})->name('mentalhealthservices');

// Medical Routes
Route::prefix('medical')->group(function () {
    Route::get('/', function () {
        return view('services.medical.index');
    })->name('medical.index');

    Route::get('/medical-healthcare-discounts-program', function () {
        return view('services.medical.discounts');
    })->name('medical.discounts');

    Route::get('/immigrationphysical', function () {
        return view('services.medical.immigration');
    })->name('medical.immigration');
});

    // Local-only test route to submit with a real file from disk (for developer testing)
    Route::get('/test-submit-file', function () {
        $data = [
            'fullName' => 'File Test User',
            'dob' => '1990-01-01',
            'gender' => 'Male',
            'citizenship' => 'United States',
            'passport' => 'P1234567',
            'email' => 'filetest@example.com',
            'phone' => '+15555555555',
            'countryCode' => '+1',
            'address' => '123 Test St',
            'visaStatus' => 'U.S. Citizen',

            'degree' => 'MD',
            'medicalSchool' => 'Test Medical School',
            'schoolCountry' => 'United States',
            'graduationYear' => 2010,
            'ecfmg' => 'Yes',

            'licenseCountry' => 'United States',
            'licenseNumber' => 'LIC123',
            'issueDate' => '2015-01-01',
            'expiryDate' => '2025-01-01',
            'licensureStatus' => 'Active and in Good Standing',
            'disciplinary' => 'None',

            'pathway' => 'Path B',
            'totalPracticeYears' => 12,

            'step1' => 'Passed',
            'step2' => 'Passed',
            'jurisprudence' => 'Passed',
            'english' => 'Native English Speaker',

            'jobOffer' => 'No',

            'securityRisk' => 'No',
            'itar' => 'No',
            'criminal' => 'None',
            'military' => 'None',
            'investigations' => 'No',

            'applicantSignature' => 'File Test User',
            'signatureDate' => date('Y-m-d'),
        ];

        // Create a Symfony UploadedFile from a test file in storage/tmp
        $testPath = storage_path('tmp/test_passport.pdf');
        if (!file_exists($testPath)) {
            return response()->json(['success' => false, 'message' => 'Test file not found: '.$testPath], 500);
        }

        $uploaded = new \Illuminate\Http\UploadedFile($testPath, 'test_passport.pdf', 'application/pdf', null, true);

        $request = \Illuminate\Http\Request::create('/application/submit', 'POST', $data);
        // Attach file to request
        $request->files->set('doc_passport', $uploaded);

        $controller = app()->make(\App\Http\Controllers\ApplicationController::class);
        return $controller->submitApplication($request);
    })->name('test.submit.file');

// Dental Routes
Route::prefix('dental')->group(function () {
    Route::get('/', function () {
        return view('services.dental.index');
    })->name('dental.index');

    Route::get('/dentures-implants', function () {
        return view('services.dental.dentures');
    })->name('dental.dentures-implants');

    Route::get('/dental-annual-discount-program', function () {
        return view('services.dental.discounts');
    })->name('dental.discounts');
});

// Title V Routes
Route::get('/titlevChild', function () {
    return view('services.titlev.children');
})->name('titlev.children');

Route::get('/titlevPrenatal', function () {
    return view('services.titlev.prenatal');
})->name('titlev.prenatal');

// Other Services
Route::get('/diagnostic', function () {
    return view('services.diagnostic');
})->name('diagnostic');

Route::get('/speciality', function () {
    return view('services.speciality');
})->name('speciality');

Route::get('/children', function () {
    return view('services.children');
})->name('children');

// Other Pages
Route::get('/clinicalrotations', function () {
    return view('pages.clinicalrotations');
})->name('clinicalrotations');

Route::get('/locations', function () {
    return view('pages.locations');
})->name('locations');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/doc-act', function () {
    return view('doc-act');
})->name('doc-act');

// ========== TEXAS DOCTOR'S ACT APPLICATION ROUTES ==========
// Main application form
Route::get('/application', [ApplicationController::class, 'showApplicationForm'])->name('application');

// Form submission endpoint
Route::post('/application/submit', [ApplicationController::class, 'submitApplication'])->name('application.submit');

// Thank you page after successful submission
Route::get('/application/thank-you', function () {
    return view('thank_you');
})->name('application.thankyou');

// Temporary local-only test route for email debugging
if (app()->environment('local')) {
    Route::get('/test-email', [\App\Http\Controllers\TestEmailController::class, 'testEmail'])->name('test.email');
}

// Temporary local-only test submit route to exercise validation and email sending
if (app()->environment('local')) {
    Route::get('/test-submit', function () {
        $data = [
            'fullName' => 'Test User',
            'dob' => '1990-01-01',
            'gender' => 'Male',
            'citizenship' => 'United States',
            'passport' => 'P1234567',
            'email' => 'test@example.com',
            'phone' => '+15555555555',
            'address' => '123 Test St',
            'visaStatus' => 'U.S. Citizen',

            'degree' => 'MD',
            'medicalSchool' => 'Test Medical School',
            'schoolCountry' => 'United States',
            'graduationYear' => 2010,
            'ecfmg' => 'Yes',

            'licenseCountry' => 'United States',
            'licenseNumber' => 'LIC123',
            'issueDate' => '2015-01-01',
            'expiryDate' => '2025-01-01',
            'licensureStatus' => 'Active and in Good Standing',
            'disciplinary' => 'None',

            'pathway' => 'Path B',
            'totalPracticeYears' => 12,

            'step1' => 'Passed',
            'step2' => 'Passed',
            'jurisprudence' => 'Passed',
            'english' => 'Native English Speaker',

            'jobOffer' => 'No',

            'securityRisk' => 'No',
            'itar' => 'No',
            'criminal' => 'None',
            'military' => 'None',
            'investigations' => 'No',

            'applicantSignature' => 'Test User',
            'signatureDate' => date('Y-m-d'),
        ];

        $request = \Illuminate\Http\Request::create('/application/submit', 'POST', $data);

        $controller = app()->make(\App\Http\Controllers\ApplicationController::class);
        return $controller->submitApplication($request);
    })->name('test.submit');

    // Local test route to intentionally trigger validation errors
    Route::get('/test-submit-invalid', function () {
        $data = [
            'fullName' => 'Invalid User',
            'dob' => '1990-01-01',
            'gender' => 'Male',
            'citizenship' => 'Country X',
            'passport' => 'P000',
            'email' => 'invalid@example.com',
            'phone' => '+10000000000',
            'address' => 'Nowhere',
            'visaStatus' => 'U.S. Citizen',

            'degree' => 'MD',
            'medicalSchool' => 'Test School',
            'schoolCountry' => 'Country X',
            'graduationYear' => 2010,
            'ecfmg' => 'Yes',

            'licenseCountry' => 'Country X',
            'licenseNumber' => 'LIC000',
            'issueDate' => '2010-01-01',
            'expiryDate' => '2025-01-01',
            'licensureStatus' => 'Active and in Good Standing',
            'disciplinary' => 'None',

            // Path A with invalid residency dates and out-of-range years
            'pathway' => 'Path A',
            'residency' => 'Yes',
            'residencyInstitution' => 'Some Hospital',
            'residencyFrom' => '2020-01-01',
            'residencyTo' => '2019-01-01', // invalid: end before start
            'postResidencyYears' => 60, // invalid: greater than max 50

            'step1' => 'Passed',
            'step2' => 'Passed',
            'jurisprudence' => 'Passed',
            'english' => 'Native English Speaker',

            'jobOffer' => 'No',

            'securityRisk' => 'No',
            'itar' => 'No',
            'criminal' => 'None',
            'military' => 'None',
            'investigations' => 'No',

            'applicantSignature' => 'Invalid User',
            'signatureDate' => date('Y-m-d'),
        ];

        $request = \Illuminate\Http\Request::create('/application/submit', 'POST', $data);

        $controller = app()->make(\App\Http\Controllers\ApplicationController::class);
        return $controller->submitApplication($request);
    })->name('test.submit.invalid');
}

// ========== Authentication Routes ==========
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Change Password (Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change.post');
});

// ========== User Dashboard Routes (Protected by Auth) ==========
Route::middleware(['role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/applications/{id}', [UserDashboardController::class, 'showApplication'])->name('user.applications.show');
    Route::get('/application/{application_id}/edit', [ApplicationController::class, 'editApplication'])->name('application.edit');
    Route::post('/application/{application_id}/update', [ApplicationController::class, 'updateApplication'])->name('application.update');
});

// ========== Admin Routes (Protected by Role Middleware) ==========
Route::prefix('admin')->middleware(['role:admin,superadmin'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Application Management
    Route::prefix('applications')->group(function () {
        // Export all applications to PDF and Excel (with optional filters)
        Route::get('/export/pdf', [ApplicationManagementController::class, 'exportPdf'])->name('admin.applications.export.pdf');
        Route::get('/export/excel', [ApplicationManagementController::class, 'exportExcel'])->name('admin.applications.export.excel');
        Route::get('/', [ApplicationManagementController::class, 'index'])->name('admin.applications.index');
        Route::get('/{id}', [ApplicationManagementController::class, 'show'])->name('admin.applications.show');

        // Edit and update application
        Route::get('/{id}/edit', [ApplicationManagementController::class, 'edit'])->name('admin.applications.edit');
        Route::match(['put', 'patch'], '/{id}', [ApplicationManagementController::class, 'update'])->name('admin.applications.update');
        Route::post('/{id}/status', [ApplicationManagementController::class, 'updateStatus'])->name('admin.applications.update-status');
        // Request additional documents / objected fields
        Route::post('/{id}/request-documents', [ApplicationManagementController::class, 'requestAdditionalDocuments'])->name('admin.applications.request-documents');
        Route::delete('/{id}', [ApplicationManagementController::class, 'destroy'])->name('admin.applications.destroy');
        Route::get('/{id}/export', [ApplicationManagementController::class, 'export'])->name('admin.applications.export');
        Route::get('/{id}/export-pdf', [ApplicationManagementController::class, 'exportSinglePdf'])->name('admin.applications.export-pdf');
        // Download individual uploaded document files
        Route::get('/{id}/download/{field}', [ApplicationManagementController::class, 'downloadDocument'])->name('admin.applications.download-document');
        Route::post('/bulk-delete', [ApplicationManagementController::class, 'bulkDelete'])->name('admin.applications.bulk-delete');
        Route::post('/bulk-update-status', [ApplicationManagementController::class, 'bulkUpdateStatus'])->name('admin.applications.bulk-update-status');
    });
    
    // User Management (Admin and Superadmin only)
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('admin.users.index');
        Route::get('/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::post('/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('admin.users.toggle-status');
        Route::post('/{id}/update-role', [AdminController::class, 'updateUserRole'])->name('admin.users.update-role');
        Route::delete('/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    });
});

