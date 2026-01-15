<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('foodItem')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum('subtotal');
        $tax = $subtotal * 0.08;
        $deliveryFee = 2.99;
        $total = $subtotal + $tax + $deliveryFee;

        return view('checkout', compact('cartItems', 'subtotal', 'tax', 'deliveryFee', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'delivery_address' => 'required|string',
            'delivery_phone' => 'required|string',
            'delivery_note' => 'nullable|string',
            'payment_method' => 'required|in:cash,online',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())
            ->with('foodItem')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        DB::beginTransaction();
        try {
            $subtotal = $cartItems->sum('subtotal');
            $tax = $subtotal * 0.08;
            $deliveryFee = 2.99;
            $total = $subtotal + $tax + $deliveryFee;

            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'status' => 'placed',
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_method'] === 'cash' ? 'pending' : 'paid',
                'delivery_address' => $validated['delivery_address'],
                'delivery_phone' => $validated['delivery_phone'],
                'delivery_note' => $validated['delivery_note'] ?? null,
                'placed_at' => now(),
            ]);

            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_item_id' => $cartItem->food_item_id,
                    'food_name' => $cartItem->foodItem->name,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'subtotal' => $cartItem->subtotal,
                ]);
            }

            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return redirect()->route('orders.track', $order->order_number)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function track($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->with('orderItems.foodItem')
            ->firstOrFail();

        return view('orders.track', compact('order'));
    }

    public function history()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('orderItems')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.history', compact('orders'));
    }
}
