@extends('layouts.app')

@section('title', 'All Orders - Admin')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">All Orders</h2>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->delivery_phone }}</td>
                            <td>{{ $order->orderItems->count() }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($order->payment_method) }}</span>
                            </td>
                            <td>
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
                            </td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
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
                            <td colspan="9" class="text-center">No orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
