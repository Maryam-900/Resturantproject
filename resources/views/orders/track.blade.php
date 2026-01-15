@extends('layouts.app')

@section('title', 'Track Order - Rustic Eats')

@push('styles')
<style>
    .timeline {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }

    .timeline-step {
        display: flex;
        align-items: flex-start;
        margin-bottom: 2rem;
        position: relative;
    }

    .timeline-step:before {
        content: '';
        position: absolute;
        left: 25px;
        top: 50px;
        height: calc(100% + 10px);
        width: 3px;
        background-color: var(--border-color);
    }

    .timeline-step:last-child:before {
        display: none;
    }

    .timeline-step.active:before {
        background-color: var(--primary);
    }

    .timeline-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: var(--bg-card);
        border: 3px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
        z-index: 2;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .timeline-step.active .timeline-icon {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .timeline-content h5 {
        margin-bottom: 0.5rem;
        color: var(--text-light);
    }

    .timeline-content p {
        color: var(--text-muted);
    }

    .timeline-content small {
        color: var(--text-muted);
    }

    .card-body h3, .card-body h5, .card-body h6 {
        color: var(--text-light);
    }

    .card-body p, .card-body span, .card-body div {
        color: var(--text-light);
    }

    .lead {
        color: var(--text-light);
    }

    .order-items {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h3 style="color: var(--text-light);">Order #{{ $order->order_number }}</h3>
                    <p style="color: var(--text-muted);">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                    <p class="lead" style="color: var(--text-light);">
                        @if($order->status === 'placed')
                            Estimated delivery: 45-60 minutes
                        @elseif($order->status === 'preparing')
                            Your food is being prepared
                        @elseif($order->status === 'out_for_delivery')
                            Your order is on the way!
                        @else
                            Order delivered
                        @endif
                    </p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4" style="color: var(--text-light);">Order Status</h5>
                    
                    <div class="timeline">
                        <div class="timeline-step {{ in_array($order->status, ['placed', 'preparing', 'out_for_delivery', 'delivered']) ? 'active' : '' }}">
                            <div class="timeline-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="timeline-content">
                                <h5 style="color: var(--text-light);">Order Placed</h5>
                                <p style="color: var(--text-muted);">Your order has been received</p>
                                @if($order->placed_at)
                                    <small>{{ $order->placed_at->format('h:i A') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="timeline-step {{ in_array($order->status, ['preparing', 'out_for_delivery', 'delivered']) ? 'active' : '' }}">
                            <div class="timeline-icon">
                                <i class="bi bi-egg-fried"></i>
                            </div>
                            <div class="timeline-content">
                                <h5 style="color: var(--text-light);">Preparing</h5>
                                <p style="color: var(--text-muted);">Our chef is preparing your food</p>
                                @if($order->preparing_at)
                                    <small>{{ $order->preparing_at->format('h:i A') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="timeline-step {{ in_array($order->status, ['out_for_delivery', 'delivered']) ? 'active' : '' }}">
                            <div class="timeline-icon">
                                <i class="bi bi-bicycle"></i>
                            </div>
                            <div class="timeline-content">
                                <h5 style="color: var(--text-light);">Out for Delivery</h5>
                                <p style="color: var(--text-muted);">Your order is on the way</p>
                                @if($order->out_for_delivery_at)
                                    <small>{{ $order->out_for_delivery_at->format('h:i A') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="timeline-step {{ $order->status === 'delivered' ? 'active' : '' }}">
                            <div class="timeline-icon">
                                <i class="bi bi-house-check"></i>
                            </div>
                            <div class="timeline-content">
                                <h5 style="color: var(--text-light);">Delivered</h5>
                                <p style="color: var(--text-muted);">Your order has been delivered</p>
                                @if($order->delivered_at)
                                    <small>{{ $order->delivered_at->format('h:i A') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4" style="color: var(--text-light);">Order Details</h5>
                    
                    <div class="order-items mb-4">
                        @foreach($order->orderItems as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: var(--text-light);">{{ $item->food_name }} x{{ $item->quantity }}</span>
                            <span style="color: var(--text-light);">${{ number_format($item->subtotal, 2) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: var(--text-light);">Subtotal:</span>
                        <span style="color: var(--text-light);">${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: var(--text-light);">Tax:</span>
                        <span style="color: var(--text-light);">${{ number_format($order->tax, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span style="color: var(--text-light);">Delivery Fee:</span>
                        <span style="color: var(--text-light);">${{ number_format($order->delivery_fee, 2) }}</span>
                    </div>
                    <hr style="border-color: var(--border-color);">
                    <div class="d-flex justify-content-between">
                        <strong style="color: var(--text-light);">Total:</strong>
                        <strong class="text-primary">${{ number_format($order->total, 2) }}</strong>
                    </div>

                    <hr style="border-color: var(--border-color);">

                    <div class="mt-3">
                        <h6 style="color: var(--text-light);">Delivery Address:</h6>
                        <p style="color: var(--text-muted);">{{ $order->delivery_address }}</p>
                        
                        <h6 style="color: var(--text-light);">Phone:</h6>
                        <p style="color: var(--text-muted);">{{ $order->delivery_phone }}</p>

                        @if($order->delivery_note)
                        <h6 style="color: var(--text-light);">Note:</h6>
                        <p style="color: var(--text-muted);">{{ $order->delivery_note }}</p>
                        @endif

                        <h6 style="color: var(--text-light);">Payment Method:</h6>
                        <p style="color: var(--text-muted);">{{ ucfirst($order->payment_method) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
