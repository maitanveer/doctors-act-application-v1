@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Dashboard</h1>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('application') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle mr-2"></i>Submit New Application
        </a>
        <span class="text-muted">{{ now()->format('l, F j, Y') }}</span>
    </div>
</div>

@if(Auth::user()->role === 'user')
<div class="alert alert-info mb-4">
    <i class="fa fa-info-circle mr-2"></i>
    <strong>Welcome!</strong> You can submit a new application using the button above or view your existing applications below.
</div>
@endif

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
                    <p class="text-muted mb-1">Pending</p>
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
                    <p class="text-muted mb-1">Rejected</p>
                    <h3 class="text-danger">{{ $stats['rejected_applications'] }}</h3>
                </div>
                <i class="fa fa-times-circle fa-3x text-danger"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-md-4">
        <a href="{{ route('application') }}" class="text-decoration-none">
            <div class="stat-card border-primary" style="border: 2px solid; cursor: pointer; transition: all 0.3s;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-primary mb-1"><strong>Submit Application</strong></p>
                        <p class="text-muted mb-0 small">Start a new application</p>
                    </div>
                    <i class="fa fa-file-text fa-3x text-primary"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Users</p>
                    <h3>{{ $stats['total_users'] }}</h3>
                </div>
                <i class="fa fa-users fa-3x text-info"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Admins</p>
                    <h3>{{ $stats['total_admins'] }}</h3>
                </div>
                <i class="fa fa-user-secret fa-3x text-secondary"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Applications -->
<div class="stat-card mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Recent Applications</h4>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>

    @if($recentApplications->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Application ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentApplications as $app)
                    <tr>
                        <td><code>{{ $app->application_id }}</code></td>
                        <td>{{ $app->full_name }}</td>
                        <td>{{ $app->email }}</td>
                        <td>
                            @if($app->status === 'submitted')
                                <span class="badge badge-warning">Submitted</span>
                            @elseif($app->status === 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif($app->status === 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @else
                                <span class="badge badge-info">{{ ucfirst($app->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $app->submission_date ? $app->submission_date->format('M d, Y') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.applications.show', $app->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-muted py-4">No applications yet.</p>
    @endif
</div>
@endsection

@section('styles')
<style>
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .border-primary:hover {
        background-color: rgba(0, 123, 255, 0.05);
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.2);
    }
</style>
@endsection
