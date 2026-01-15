@extends('layouts.app')

@section('title', 'Admin Dashboard - Rustic Eats')

@push('styles')
<style>
    .stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(107, 142, 35, 0.2);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .order-table {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
    }

    .status-select {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <a href="{{ route('admin.reports') }}" class="btn btn-outline-primary">
            <i class="bi bi-graph-up"></i> View Reports
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-number text-info">{{ $stats['new_orders'] }}</div>
                <div class="stat-label">New Orders</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-number text-warning">{{ $stats['preparing'] }}</div>
                <div class="stat-label">Preparing</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-number text-primary">{{ $stats['out_for_delivery'] }}</div>
                <div class="stat-label">Out for Delivery</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-number text-success">{{ $stats['completed_today'] }}</div>
                <div class="stat-label">Completed Today</div>
            </div>
        </div>
    </div>

    <!-- Revenue Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Today's Revenue</h5>
                    <h2 class="text-primary">${{ number_format($stats['total_revenue_today'], 2) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Recent Orders</h5>
                <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->orderItems->count() }} items</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>
                                @if($order->status === 'placed')
                                    <span class="badge bg-info">Placed</span>
                                @elseif($order->status === 'preparing')
                                    <span class="badge bg-warning">Preparing</span>
                                @elseif($order->status === 'out_for_delivery')
                                    <span class="badge bg-primary">Out for Delivery</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm status-select" onchange="this.form.submit()">
                                        <option value="placed" {{ $order->status === 'placed' ? 'selected' : '' }}>Placed</option>
                                        <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                                        <option value="out_for_delivery" {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No recent orders</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
