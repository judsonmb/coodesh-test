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
            'code' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'status' => $this->faker->randomElement(['draft', 'trash', 'published']),
            'imported_t' => $this->faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
            'url' => $this->faker->url(),
            'creator' => $this->faker->userName(),
            'created_t' => $this->faker->unixTime(),
            'last_modified_t' => $this->faker->unixTime(),
            'product_name' => $this->faker->word() . ' ' . $this->faker->word(),
            'quantity' => $this->faker->randomElement(['380 g (6 x 2 u.)', '500 g', '1 kg', '200 g']),
            'brands' => $this->faker->company(),
            'categories' => $this->faker->sentence(3),
            'labels' => $this->faker->sentence(2),
            'cities' => $this->faker->city(),
            'purchase_places' => $this->faker->city() . ',' . $this->faker->country(),
            'stores' => $this->faker->company(),
            'ingredients_text' => $this->faker->paragraph(),
            'traces' => $this->faker->words(5, true),
            'serving_size' => $this->faker->word() . ' ' . $this->faker->randomFloat(1, 10, 50),
            'serving_quantity' => $this->faker->randomFloat(2, 0, 100),
            'nutriscore_score' => $this->faker->numberBetween(0, 100),
            'nutriscore_grade' => $this->faker->randomElement(['a', 'b', 'c', 'd', 'e']),
            'main_category' => $this->faker->word(),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
