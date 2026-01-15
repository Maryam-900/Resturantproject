<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\FoodItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'new_orders' => Order::where('status', 'placed')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'out_for_delivery' => Order::where('status', 'out_for_delivery')->count(),
            'completed_today' => Order::where('status', 'delivered')
                ->whereDate('delivered_at', today())
                ->count(),
            'total_revenue_today' => Order::where('status', 'delivered')
                ->whereDate('delivered_at', today())
                ->sum('total'),
        ];

        $recentOrders = Order::with(['user', 'orderItems'])
            ->whereIn('status', ['placed', 'preparing', 'out_for_delivery'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }

    public function orders()
    {
        $orders = Order::with(['user', 'orderItems'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:placed,preparing,out_for_delivery,delivered,cancelled',
        ]);

        $order->status = $validated['status'];

        switch ($validated['status']) {
            case 'preparing':
                $order->preparing_at = now();
                break;
            case 'out_for_delivery':
                $order->out_for_delivery_at = now();
                break;
            case 'delivered':
                $order->delivered_at = now();
                $order->payment_status = 'paid';
                break;
        }

        $order->save();

        return back()->with('success', 'Order status updated successfully');
    }

    public function reports()
    {
        $dailyRevenue = Order::where('status', 'delivered')
            ->whereDate('delivered_at', today())
            ->sum('total');

        $weeklyRevenue = Order::where('status', 'delivered')
            ->whereBetween('delivered_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total');

        $monthlyRevenue = Order::where('status', 'delivered')
            ->whereMonth('delivered_at', now()->month)
            ->sum('total');

        $topItems = DB::table('order_items')
            ->select('food_name', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(subtotal) as revenue'))
            ->groupBy('food_name')
            ->orderBy('total_sold', 'desc')
            ->take(10)
            ->get();

        return view('admin.reports', compact('dailyRevenue', 'weeklyRevenue', 'monthlyRevenue', 'topItems'));
    }

    public function foodItems()
    {
        $foodItems = FoodItem::with('category')->paginate(20);
        $categories = Category::all();

        return view('admin.food-items', compact('foodItems', 'categories'));
    }
}
