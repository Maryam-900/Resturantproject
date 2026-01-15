<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\FoodItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@rusticeats.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '555-0100',
            'address' => '123 Admin Street',
        ]);

        // Create Test Customer
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '555-0101',
            'address' => '456 Customer Avenue',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Starters', 'slug' => 'starters', 'description' => 'Appetizers and starters'],
            ['name' => 'Main Course', 'slug' => 'main', 'description' => 'Main dishes'],
            ['name' => 'Desserts', 'slug' => 'desserts', 'description' => 'Sweet treats'],
            ['name' => 'Drinks', 'slug' => 'drinks', 'description' => 'Beverages'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Food Items
        $foodItems = [
            // Starters
            [
                'category_id' => 1,
                'name' => 'Organic Garden Salad',
                'slug' => 'organic-garden-salad',
                'description' => 'Fresh greens with seasonal vegetables and house dressing',
                'price' => 12.99,
                'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500',
                'is_featured' => true,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Bruschetta',
                'slug' => 'bruschetta',
                'description' => 'Toasted bread with tomatoes, garlic, and basil',
                'price' => 9.99,
                'image' => 'https://images.unsplash.com/photo-1572695157366-5e585ab2b69f?w=500',
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Soup of the Day',
                'slug' => 'soup-of-the-day',
                'description' => 'Chef\'s special homemade soup',
                'price' => 7.99,
                'image' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=500',
                'is_available' => true,
            ],
            // Main Course
            [
                'category_id' => 2,
                'name' => 'Wood-Fired Pizza',
                'slug' => 'wood-fired-pizza',
                'description' => 'Artisan pizza with organic toppings and homemade sauce',
                'price' => 16.99,
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=500',
                'is_featured' => true,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Grilled Salmon',
                'slug' => 'grilled-salmon',
                'description' => 'Wild-caught salmon with herbs and lemon butter sauce',
                'price' => 22.99,
                'image' => 'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?w=500',
                'is_featured' => true,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Organic Pasta Primavera',
                'slug' => 'organic-pasta-primavera',
                'description' => 'Fresh pasta with seasonal vegetables in garlic olive oil',
                'price' => 18.99,
                'image' => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=500',
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Grass-Fed Beef Burger',
                'slug' => 'grass-fed-beef-burger',
                'description' => 'Juicy burger with organic toppings and rustic fries',
                'price' => 15.99,
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500',
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Roasted Chicken',
                'slug' => 'roasted-chicken',
                'description' => 'Free-range chicken with herbs and roasted vegetables',
                'price' => 19.99,
                'image' => 'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=500',
                'is_available' => true,
            ],
            // Desserts
            [
                'category_id' => 3,
                'name' => 'Berry Delight',
                'slug' => 'berry-delight',
                'description' => 'Seasonal berries with honey yogurt and crushed nuts',
                'price' => 8.99,
                'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500',
                'is_featured' => true,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Chocolate Lava Cake',
                'slug' => 'chocolate-lava-cake',
                'description' => 'Warm chocolate cake with molten center',
                'price' => 9.99,
                'image' => 'https://images.unsplash.com/photo-1624353365286-3f8d62daad51?w=500',
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Tiramisu',
                'slug' => 'tiramisu',
                'description' => 'Classic Italian dessert with coffee and mascarpone',
                'price' => 10.99,
                'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=500',
                'is_available' => true,
            ],
            // Drinks
            [
                'category_id' => 4,
                'name' => 'Fresh Lemonade',
                'slug' => 'fresh-lemonade',
                'description' => 'Homemade lemonade with organic lemons',
                'price' => 4.99,
                'image' => 'https://images.unsplash.com/photo-1523677011781-c91d1bbe2f9d?w=500',
                'is_available' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Organic Coffee',
                'slug' => 'organic-coffee',
                'description' => 'Freshly brewed organic coffee',
                'price' => 3.99,
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=500',
                'is_available' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Herbal Tea',
                'slug' => 'herbal-tea',
                'description' => 'Selection of organic herbal teas',
                'price' => 3.49,
                'image' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=500',
                'is_available' => true,
            ],
        ];

        foreach ($foodItems as $item) {
            FoodItem::create($item);
        }
    }
}
