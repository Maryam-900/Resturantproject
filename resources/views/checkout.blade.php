@extends('layouts.app')

@section('title', 'Checkout - Rustic Eats')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Delivery Information</h5>
                    
                    <form action="{{ route('orders.place') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="delivery_address" class="form-label">Delivery Address *</label>
                            <textarea class="form-control @error('delivery_address') is-invalid @enderror" 
                                      id="delivery_address" name="delivery_address" rows="3" required>{{ old('delivery_address', auth()->user()->address) }}</textarea>
                            @error('delivery_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="delivery_phone" class="form-label">Phone Number *</label>
                            <input type="text" class="form-control @error('delivery_phone') is-invalid @enderror" 
                                   id="delivery_phone" name="delivery_phone" value="{{ old('delivery_phone', auth()->user()->phone) }}" required>
                            @error('delivery_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="delivery_note" class="form-label">Delivery Note (Optional)</label>
                            <textarea class="form-control" id="delivery_note" name="delivery_note" rows="2">{{ old('delivery_note') }}</textarea>
                        </div>

                        <h5 class="card-title mb-3">Payment Method</h5>
                        
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash" checked>
                            <label class="form-check-label" for="cash">
                                <i class="bi bi-cash-coin me-2"></i> Cash on Delivery
                            </label>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="payment_method" id="online" value="online">
                            <label class="form-check-label" for="online">
                                <i class="bi bi-credit-card me-2"></i> Online Payment
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle me-2"></i> Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Order Summary</h5>
                    
                    @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item->foodItem->name }} x{{ $item->quantity }}</span>
                        <span>${{ number_format($item->subtotal, 2) }}</span>
                    </div>
                    @endforeach

                    <hr>

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
                    
                    <div class="d-flex justify-content-between mb-0">
                        <strong>Total:</strong>
                        <strong class="text-primary">${{ number_format($total, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
