@extends('layouts.admin')

@section('title', 'Application Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary mb-2">
            <i class="fa fa-arrow-left"></i> Back to Dashboard
        </a>
        <h1>Application Details</h1>
        <p class="text-muted">ID: <code>{{ $application->application_id }}</code></p>
    </div>
    <div>
        <span class="badge badge-{{$application->status==='approved'?'success':($application->status==='rejected'?'danger':'warning')}}" style="font-size:1.1rem;padding:10px 20px;">
            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
        </span>
    </div>
</div>

@if($application->objection_pending)
<div class="alert alert-warning">
    <h5><i class="fa fa-exclamation-triangle"></i> Action Required</h5>
    <p><strong>Admin's Comment:</strong> {{ $application->objection_message }}</p>
    <p class="mb-0">
        <a href="{{ route('application.edit', $application->application_id) }}" class="btn btn-warning">
            <i class="fa fa-edit"></i> Update Objected Fields
        </a>
    </p>
</div>
@endif

<!-- Personal Information -->
<div class="stat-card mb-4">
    <h4 class="mb-3"><i class="fa fa-user"></i> Personal Information</h4>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Full Name:</strong> {{$application->full_name}}</p>
            <p><strong>Email:</strong> {{$application->email}}</p>
            <p><strong>Phone:</strong> {{$application->phone}}</p>
            <p><strong>Date of Birth:</strong> {{$application->date_of_birth ? $application->date_of_birth->format('F d, Y') : 'N/A'}}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Gender:</strong> {{ucfirst($application->gender ?? 'N/A')}}</p>
            <p><strong>Nationality:</strong> {{$application->nationality ?? 'N/A'}}</p>
            <p><strong>Passport:</strong> {{$application->passport}}</p>
            <p><strong>Submission Date:</strong> {{$application->submission_date ? $application->submission_date->format('F d, Y h:i A') : 'N/A'}}</p>
        </div>
    </div>
</div>

<!-- Medical Education -->
<div class="stat-card mb-4">
    <h4 class="mb-3"><i class="fa fa-graduation-cap"></i> Medical Education</h4>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Medical School:</strong> {{$application->medical_school}}</p>
            <p><strong>Graduation Year:</strong> {{$application->graduation_year}}</p>
            <p><strong>Degree:</strong> {{$application->degree ?? 'N/A'}}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Specialty:</strong> {{$application->specialty}}</p>
            <p><strong>School Country:</strong> {{$application->school_country ?? 'N/A'}}</p>
        </div>
    </div>
</div>

<!-- Licensure Information -->
<div class="stat-card mb-4">
    <h4 class="mb-3"><i class="fa fa-certificate"></i> Licensure Information</h4>
    <div class="row">
        <div class="col-md-6">
            <p><strong>License Number:</strong> {{$application->license_number}}</p>
            <p><strong>License Country:</strong> {{$application->license_country ?? 'N/A'}}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Issue Date:</strong> {{$application->issue_date ?? 'N/A'}}</p>
            <p><strong>Expiry Date:</strong> {{$application->license_expiry ?? 'N/A'}}</p>
        </div>
    </div>
</div>

<!-- Status History -->
@if($application->admin_notes)
<div class="stat-card mb-4">
    <h4 class="mb-3"><i class="fa fa-comments"></i> Admin Notes</h4>
    <div class="alert alert-info">
        {{ $application->admin_notes }}
    </div>
</div>
@endif

<!-- Application Timeline -->
<div class="stat-card">
    <h4 class="mb-3"><i class="fa fa-clock-o"></i> Timeline</h4>
    <ul class="list-unstyled">
        <li class="mb-2">
            <i class="fa fa-check-circle text-success"></i>
            <strong>Submitted:</strong> {{ $application->submission_date ? $application->submission_date->format('F d, Y h:i A') : 'N/A' }}
        </li>
        @if($application->updated_at != $application->created_at)
        <li class="mb-2">
            <i class="fa fa-refresh text-info"></i>
            <strong>Last Updated:</strong> {{ $application->updated_at->format('F d, Y h:i A') }}
        </li>
        @endif
        @if($application->status === 'approved')
        <li class="mb-2">
            <i class="fa fa-thumbs-up text-success"></i>
            <strong>Status:</strong> Application Approved
        </li>
        @elseif($application->status === 'rejected')
        <li class="mb-2">
            <i class="fa fa-thumbs-down text-danger"></i>
            <strong>Status:</strong> Application Rejected
        </li>
        @elseif($application->status === 'under_review')
        <li class="mb-2">
            <i class="fa fa-search text-info"></i>
            <strong>Status:</strong> Under Review
        </li>
        @else
        <li class="mb-2">
            <i class="fa fa-hourglass-half text-warning"></i>
            <strong>Status:</strong> Pending Review
        </li>
        @endif
    </ul>
</div>
@endsection
