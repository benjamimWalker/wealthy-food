<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'code' => $this->faker->unique()->randomNumber(8),
            'status' => $this->faker->randomElement(['draft', 'published', 'trash']),
            'imported_t' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'url' => $this->faker->url,
            'creator' => $this->faker->name,
            'created_t' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'last_modified_t' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'product_name' => $this->faker->sentence,
            'quantity' => $this->faker->randomFloat(2, 0, 100),
            'brands' => $this->faker->word,
            'categories' => $this->faker->word,
            'labels' => $this->faker->word,
            'cities' => $this->faker->word,
            'purchase_places' => $this->faker->word,
            'stores' => $this->faker->word,
            'ingredients_text' => $this->faker->sentence,
            'traces' => $this->faker->word,
            'serving_size' => $this->faker->randomFloat(2, 0, 100),
            'serving_quantity' => $this->faker->randomFloat(2, 0, 100),
            'nutriscore_score' => $this->faker->randomFloat(2, 0, 100),
            'nutriscore_grade' => $this->faker->randomElement(['a', 'b', 'c', 'd', 'e']),
            'main_category' => $this->faker->word,
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
