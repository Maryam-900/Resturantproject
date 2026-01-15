<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = FoodItem::where('is_featured', true)
            ->where('is_available', true)
            ->with('category')
            ->take(4)
            ->get();

        return view('home', compact('featuredItems'));
    }

    public function menu(Request $request)
    {
        $categories = Category::where('is_active', true)->get();
        
        $query = FoodItem::where('is_available', true)->with('category');

        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $foodItems = $query->get();

        return view('menu', compact('foodItems', 'categories'));
    }
}
