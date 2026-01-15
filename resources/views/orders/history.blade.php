@extends('layouts.app')

@section('title', 'Order History - Rustic Eats')

@push('styles')
<style>
    h2, h5, p, span, div {
        color: var(--text-light);
    }

    .card-body p, .card-body span {
        color: var(--text-light);
    }

    small {
        color: var(--text-muted);
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <h2 class="mb-4" style="color: var(--text-light);">Order History</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            You haven't placed any orders yet. <a href="{{ route('menu') }}" class="alert-link">Browse our menu</a>
        </div>
    @else
        @foreach($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <h5 class="mb-1" style="color: var(--text-light);">{{ $order->order_number }}</h5>
                        <small style="color: var(--text-muted);">{{ $order->created_at->format('M d, Y') }}</small>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-0" style="color: var(--text-light);">{{ $order->orderItems->count() }} items</p>
                        <strong class="text-primary">${{ number_format($order->total, 2) }}</strong>
                    </div>
                    <div class="col-md-3">
                        @if($order->status === 'placed')
                            <span class="badge bg-info">Placed</span>
                        @elseif($order->status === 'preparing')
                            <span class="badge bg-warning">Preparing</span>
                        @elseif($order->status === 'out_for_delivery')
                            <span class="badge bg-primary">Out for Delivery</span>
                        @elseif($order->status === 'delivered')
                            <span class="badge bg-success">Delivered</span>
                        @else
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </div>
                    <div class="col-md-3 text-end">
                        <a href="{{ route('orders.track', $order->order_number) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
