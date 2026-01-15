@extends('layouts.app')

@section('title', 'Home - Rustic Eats')

@push('styles')
<style>
    .hero-section {
        height: 80vh;
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                    url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1350');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        position: relative;
        margin-bottom: 4rem;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: white;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
    }

    .section-title {
        position: relative;
        margin-bottom: 3rem;
        text-align: center;
        color: var(--text-light);
        font-size: 2.5rem;
        font-weight: 700;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: var(--primary);
    }

    .food-card {
        height: 100%;
    }

    .food-card img {
        height: 250px;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
    }

    .price-tag {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="hero-title">Freshly Made. Naturally Served.</h1>
                <p class="hero-subtitle">Experience the taste of nature with our organic ingredients and rustic cooking methods.</p>
                <a href="{{ route('menu') }}" class="btn btn-primary btn-lg">Order Now</a>
            </div>
        </div>
    </div>
</div>

<!-- Featured Dishes -->
<div class="container my-5">
    <h2 class="section-title">Featured Dishes</h2>
    <div class="row g-4">
        @foreach($featuredItems as $item)
        <div class="col-md-6 col-lg-3">
            <div class="card food-card">
                <img src="{{ $item->image }}" class="card-img-top" alt="{{ $item->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text">{{ Str::limit($item->description, 60) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="price-tag">${{ number_format($item->price, 2) }}</span>
                        @auth
                            @if(auth()->user()->role === 'user')
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="food_item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-cart-plus"></i> Add
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-cart-plus"></i> Add
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Why Choose Us -->
<div class="container my-5 py-5">
    <h2 class="section-title">Why Choose Us</h2>
    <div class="row g-4">
        <div class="col-md-4 text-center">
            <div class="card p-4">
                <i class="bi bi-leaf" style="font-size: 3rem; color: var(--primary);"></i>
                <h4 class="mt-3">100% Organic</h4>
                <p class="text-muted">All our ingredients are sourced from certified organic farms</p>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card p-4">
                <i class="bi bi-clock-history" style="font-size: 3rem; color: var(--primary);"></i>
                <h4 class="mt-3">Fast Delivery</h4>
                <p class="text-muted">Hot and fresh food delivered to your doorstep in 30-45 minutes</p>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card p-4">
                <i class="bi bi-award" style="font-size: 3rem; color: var(--primary);"></i>
                <h4 class="mt-3">Quality Guaranteed</h4>
                <p class="text-muted">We ensure the highest quality in every dish we prepare</p>
            </div>
        </div>
    </div>
</div>
@endsection
