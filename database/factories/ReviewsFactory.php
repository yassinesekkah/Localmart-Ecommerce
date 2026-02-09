<?php

namespace Database\Factories;

use App\Models\Product;
use App\models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reviews>
 */
class ReviewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()?->id ?? Product::factory(),
            'user_id' => User::whereHas('roles', function($query) {
                $query->where('name', 'client');
             })->inRandomOrder()->first()?->id ?? User::factory(),
            'comment'    => $this->faker->sentence(40),
        ];
    }
}
