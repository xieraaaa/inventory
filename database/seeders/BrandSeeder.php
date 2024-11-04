<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand; // Import the Brand model
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 1000) as $index) { // Generate 50 fake brand records
            Brand::create([
                'nama_brand' => $faker->company, // Fake brand name
                'code_brand' => strtoupper($faker->unique()->lexify('BR???')), // Fake code (e.g., "BR123")
            ]);
        }
    }
}
