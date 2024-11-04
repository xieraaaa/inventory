<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori; // Import the Kategori model
use Faker\Factory as Faker;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 1000) as $index) { // Generate 1000 fake kategori records
            Kategori::create([
                'nama_kategori' => $faker->word, // Fake category name
                'code_kategori' => strtoupper($faker->unique()->lexify('KTG???')), // Unique code (e.g., "KTG123")
            ]);
        }
    }
}
