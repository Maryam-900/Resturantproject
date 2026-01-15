@extends('layouts.app')

@section('title', 'Menu - Rustic Eats')

@push('styles')
<style>
    .menu-header {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                    url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1350');
        background-size: cover;
        background-position: center;
        padding: 5rem 0;
        margin-bottom: 3rem;
        text-align: center;
    }

    .menu-header h1 {
        font-size: 3rem;
        font-weight: 700;
        color: white;
    }

    .category-btn {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-light);
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        font-weight: 600;
    }

    .category-btn:hover, .category-btn.active {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .food-item-card {
        height: 100%;
    }

    .food-item-card img {
        height: 220px;
        object-fit: cover;
    }

    .price-tag {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    .badge-featured {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: var(--accent);
        color: var(--bg-dark);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<!-- Menu Header -->
<div class="menu-header">
    <div class="container">
        <h1>Our Menu</h1>
        <p class="lead text-light">Discover our delicious selection of organic dishes</p>
    </div>
</div>

<!-- Menu Content -->
<div class="container my-5">
    <div class="row">
        <!-- Categories Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="category-btn {{ !request('category') || request('category') === 'all' ? 'active' : '' }}" 
                 onclick="window.location.href='{{ route('menu') }}'">
                All Items
            </div>
            @foreach($categories as $category)
            <div class="category-btn {{ request('category') === $category->slug ? 'active' : '' }}" 
                 onclick="window.location.href='{{ route('menu', ['category' => $category->slug]) }}'">
                {{ $category->name }}
            </div>
            @endforeach
        </div>

        <!-- Food Items -->
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse($foodItems as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card food-item-card position-relative">
                        @if($item->is_featured)
                            <span class="badge-featured">Featured</span>
                        @endif
                        <img src="{{ $item->image }}" class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text small">{{ Str::limit($item->description, 70) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="price-tag">${{ number_format($item->price, 2) }}</span>
                                @auth
                                    @if(auth()->user()->role === 'user')
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="food_item_id" value="{{ $item->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-cart-plus"></i> Add to Cart
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No items found in this category.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
