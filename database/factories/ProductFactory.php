<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        return [
            'nama_product' => $this->faker->word, // Remove unique() if strict uniqueness is not required
            'slug' => Str::slug($this->faker->word . '-' . $this->faker->unique()->randomNumber(5)), // Making slug unique
            'secondary_name' => $this->faker->words(2, true),
            'weight' => $this->faker->numberBetween(100, 10000), // e.g., weight in grams
            'barcode' => $this->faker->randomElement(['Code25', 'Code39', 'Code128']),
            'id_brand' => $this->faker->numberBetween(1, 2000), // Adjust based on available brands
            'id_kategori' => $this->faker->numberBetween(1, 2000), // Adjust based on available categories
            'id_unit' => $this->faker->numberBetween(1, 2000), // Adjust based on available units
            'price' => $this->faker->numberBetween(10000, 500000), // Random price
            'image' => 'images/products/sample.jpg' // Use a placeholder image path
        ];
    }
}
