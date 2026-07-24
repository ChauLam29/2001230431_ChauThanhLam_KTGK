<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * 
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'category_id' => Category::inRandomOrder()->first()->id,

            'name' => fake()->words(3,true),

            'price' => fake()->randomFloat(2,100,5000),

            'description' => fake()->paragraph(),

            'image_path' => null,

            'document_path' => null,

            'status' => fake()->randomElement([
                'draft',
                'published'
            ])
        ];
    }
}
