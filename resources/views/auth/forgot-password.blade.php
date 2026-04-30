@extends('layouts.app')

@section('title', 'Forgot Password - Ibn Sina Foundation')

@section('content')
<section class="contact-us section" style="padding: 80px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fa fa-lock" style="font-size: 48px; color: #0054a4;"></i>
                            <h2 class="mb-2 mt-3">Forgot Password?</h2>
                            <p class="text-muted">Enter your email to reset your password</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fa fa-check-circle"></i> {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->has('email'))
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-circle"></i> {{ $errors->first('email') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Enter your registered email" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    We'll send you a password reset link
                                </small>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-lg mt-3">
                                <i class="fa fa-envelope"></i> Send Reset Link
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0">Remember your password? 
                                <a href="{{ route('login') }}" class="text-primary font-weight-bold">Login here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
