@extends('layouts.app')

@section('title', 'Reports - Admin')

@push('styles')
<style>
    .revenue-card {
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: white;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
    }

    .revenue-amount {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .revenue-label {
        font-size: 1rem;
        opacity: 0.9;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Sales Reports</h2>

    <!-- Revenue Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="revenue-card">
                <div class="revenue-amount">${{ number_format($dailyRevenue, 2) }}</div>
                <div class="revenue-label">Today's Revenue</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="revenue-card" style="background: linear-gradient(135deg, #6366f1, #4f46e5);">
                <div class="revenue-amount">${{ number_format($weeklyRevenue, 2) }}</div>
                <div class="revenue-label">This Week's Revenue</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="revenue-card" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                <div class="revenue-amount">${{ number_format($monthlyRevenue, 2) }}</div>
                <div class="revenue-label">This Month's Revenue</div>
            </div>
        </div>
    </div>

    <!-- Top Selling Items -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Top Selling Items</h5>
            
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Total Sold</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->food_name }}</td>
                            <td>{{ $item->total_sold }} units</td>
                            <td class="text-primary">${{ number_format($item->revenue, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
