@extends('layouts.admin')

@section('title', 'My Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>My Dashboard</h1>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('application') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle mr-2"></i>Submit New Application
        </a>
        <span class="text-muted">{{ now()->format('l, F j, Y') }}</span>
    </div>
</div>

<!-- Welcome Message -->
<div class="alert alert-info mb-4">
    <i class="fa fa-info-circle mr-2"></i>
    <strong>Welcome, {{ Auth::user()->name }}!</strong> You can submit a new application or track your existing applications below.
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Applications</p>
                    <h3>{{ $stats['total_applications'] }}</h3>
                </div>
                <i class="fa fa-file-text fa-3x text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Pending Review</p>
                    <h3 class="text-warning">{{ $stats['pending_applications'] }}</h3>
                </div>
                <i class="fa fa-clock-o fa-3x text-warning"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Approved</p>
                    <h3 class="text-success">{{ $stats['approved_applications'] }}</h3>
                </div>
                <i class="fa fa-check-circle fa-3x text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Action Required</p>
                    <h3 class="text-danger">{{ $stats['objection_pending'] }}</h3>
                </div>
                <i class="fa fa-exclamation-triangle fa-3x text-danger"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-md-12">
        <a href="{{ route('application') }}" class="text-decoration-none">
            <div class="stat-card border-primary" style="border: 2px solid; cursor: pointer; transition: all 0.3s;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-primary mb-1"><strong><i class="fa fa-plus-circle"></i> Submit New Application</strong></p>
                        <p class="text-muted mb-0 small">Start a new application for medical licensure</p>
                    </div>
                    <i class="fa fa-file-text fa-3x text-primary"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- My Applications -->
<div class="stat-card mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fa fa-list"></i> My Applications</h4>
    </div>

    @if($applications->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Application ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Submission Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    <tr>
                        <td><strong>{{ $app->application_id }}</strong></td>
                        <td>{{ $app->full_name }}</td>
                        <td>
                            @if($app->objection_pending)
                                <span class="badge badge-danger">
                                    <i class="fa fa-exclamation-triangle"></i> Action Required
                                </span>
                            @elseif($app->status === 'submitted')
                                <span class="badge badge-warning">Pending Review</span>
                            @elseif($app->status === 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif($app->status === 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @elseif($app->status === 'under_review')
                                <span class="badge badge-info">Under Review</span>
                            @else
                                <span class="badge badge-secondary">{{ ucfirst($app->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $app->submission_date ? $app->submission_date->format('M d, Y h:i A') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('user.applications.show', $app->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i> View
                            </a>
                           @if($app->objection_pending)
                              <a href="{{ route('application.edit', $app->application_id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> Update
                                </a>
                                
                           @endif
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fa fa-inbox fa-5x text-muted mb-3"></i>
            <p class="text-muted">You haven't submitted any applications yet.</p>
            <a href="{{ route('application') }}" class="btn btn-primary mt-3">
                <i class="fa fa-plus-circle"></i> Submit Your First Application
            </a>
        </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .stat-card {
        transition: all 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .border-primary:hover {
        background-color: rgba(0, 123, 255, 0.05);
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.2);
    }
    
    .gap-3 {
        gap: 1rem;
    }
</style>
@endsection
