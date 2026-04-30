@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Change Password</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="stat-card">
            <form method="POST" action="{{ route('password.change.post') }}" id="changePasswordForm">
                @csrf
                
                <div class="form-group">
                    <label for="current_password">Current Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" name="current_password" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="toggleCurrent">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('current_password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">

                <div class="form-group">
                    <label for="password">New Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" minlength="6" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="toggleNew">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Minimum 6 characters</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                               id="password_confirmation" name="password_confirmation" minlength="6" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirm">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ auth()->user()->role === 'user' ? route('user.dashboard') : route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-lock"></i> Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility functions
    function setupPasswordToggle(toggleBtnId, inputId) {
        document.getElementById(toggleBtnId).addEventListener('click', function() {
            const input = document.getElementById(inputId);
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    }

    setupPasswordToggle('toggleCurrent', 'current_password');
    setupPasswordToggle('toggleNew', 'password');
    setupPasswordToggle('toggleConfirm', 'password_confirmation');

    // Password confirmation validation
    const form = document.getElementById('changePasswordForm');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');

    confirmPassword.addEventListener('input', function() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Passwords do not match');
        } else {
            confirmPassword.setCustomValidity('');
        }
    });

    password.addEventListener('input', function() {
        if (confirmPassword.value && password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Passwords do not match');
        } else {
            confirmPassword.setCustomValidity('');
        }
    });
</script>
@endsection
