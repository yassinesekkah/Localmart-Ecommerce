<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller = User::where('email', 'seller@localmart.com')->first();

        if (! $seller) {
            $this->command->error('Seller not found!');
            return;
        }

        $categories = Category::all();

        foreach (range(1, 12) as $i) {
            $name = "Product $i";

            Product::create([
                'name' => $name,
                'slug' => Str::slug($name . '-' . $i),
                'price' => rand(50, 500),
                'description' => 'Sample description for ' . $name,
                'image' => null,
                'user_id' => $seller->id,
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
