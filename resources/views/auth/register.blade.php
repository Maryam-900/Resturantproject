@extends('layouts.app')

@section('title', 'Register - Rustic Eats')

@push('styles')
<style>
    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 0;
    }

    .auth-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        max-width: 500px;
        width: 100%;
        overflow: hidden;
    }

    .auth-header {
        background-color: var(--primary);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .auth-logo {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .auth-body {
        padding: 2rem;
    }

    .form-control {
        padding: 0.75rem;
        border-radius: 8px;
    }

    .btn-auth {
        padding: 0.75rem;
        border-radius: 8px;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="bi bi-tree-fill"></i>
            </div>
            <h2>Create Account</h2>
            <p>Join the Rustic Eats community</p>
        </div>

        <div class="auth-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number (Optional)</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                           id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required>
                    <div class="form-text">Password must be at least 8 characters long</div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary btn-auth w-100 mb-3">Create Account</button>

                <div class="text-center">
                    <p class="text-muted">Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary">Sign in here</a>
                    </p>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('home') }}" class="text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Back to Home
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
