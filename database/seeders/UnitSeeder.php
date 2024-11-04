<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit; // Import the Unit model
use Faker\Factory as Faker;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 1000) as $index) {
            Unit::create([
                'nama_unit' => $faker->word,
                'code_unit' => strtoupper($faker->lexify('U???'))
            ]);
        }
    }
}
