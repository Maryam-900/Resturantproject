<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('foodItem')
            ->get();

        $subtotal = $cartItems->sum('subtotal');
        $tax = $subtotal * 0.08;
        $deliveryFee = 2.99;
        $total = $subtotal + $tax + $deliveryFee;

        return view('cart.index', compact('cartItems', 'subtotal', 'tax', 'deliveryFee', 'total'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'food_item_id' => 'required|exists:food_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $foodItem = FoodItem::findOrFail($validated['food_item_id']);

        if (!$foodItem->is_available) {
            return back()->with('error', 'This item is currently unavailable');
        }

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('food_item_id', $foodItem->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'food_item_id' => $foodItem->id,
                'quantity' => $validated['quantity'],
                'price' => $foodItem->price,
            ]);
        }

        return back()->with('success', 'Item added to cart!');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update(['quantity' => $validated['quantity']]);

        return back()->with('success', 'Cart updated!');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Item removed from cart');
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();

        return back()->with('success', 'Cart cleared');
    }
}
