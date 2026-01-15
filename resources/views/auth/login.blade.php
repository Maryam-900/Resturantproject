@extends('layouts.app')

@section('title', 'Login - Rustic Eats')

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
        max-width: 450px;
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
            <h2>Welcome Back</h2>
            <p>Sign in to your Rustic Eats account</p>
        </div>

        <div class="auth-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary btn-auth w-100 mb-3">Sign In</button>

                <div class="text-center">
                    <p class="text-muted">Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary">Sign up here</a>
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
