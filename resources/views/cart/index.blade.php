@extends('layouts.app')

@section('title', 'Shopping Cart - Rustic Eats')

@push('styles')
<style>
    .cart-item {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
    }

    .cart-item-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quantity-btn {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        border: 1px solid var(--border-color);
        background-color: var(--bg-darker);
        color: var(--text-light);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .quantity-btn:hover {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .summary-card {
        position: sticky;
        top: 100px;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Your Shopping Cart</h2>

    @if($cartItems->isEmpty())
        <div class="alert alert-info">
            Your cart is empty. <a href="{{ route('menu') }}" class="alert-link">Browse our menu</a>
        </div>
    @else
        <div class="row">
            <div class="col-lg-8">
                @foreach($cartItems as $item)
                <div class="cart-item">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="{{ $item->foodItem->image }}" class="cart-item-img" alt="{{ $item->foodItem->name }}">
                        </div>
                        <div class="col-md-4">
                            <h5>{{ $item->foodItem->name }}</h5>
                            <p class="text-muted small mb-0">{{ Str::limit($item->foodItem->description, 50) }}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="mb-0">${{ number_format($item->price, 2) }}</p>
                        </div>
                        <div class="col-md-3">
                            <div class="quantity-control">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                    <button type="submit" class="quantity-btn" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                        <i class="bi bi-dash"></i>
                                    </button>
                                </form>
                                <span class="mx-2">{{ $item->quantity }}</span>
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" class="quantity-btn">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Clear Cart
                    </button>
                </form>
            </div>

            <div class="col-lg-4">
                <div class="card summary-card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Order Summary</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax (8%):</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Delivery Fee:</span>
                            <span>${{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total:</strong>
                            <strong class="text-primary">${{ number_format($total, 2) }}</strong>
                        </div>

                        <a href="{{ route('checkout') }}" class="btn btn-primary w-100">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
