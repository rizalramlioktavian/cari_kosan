<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KosanFaker extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            DB::table('kosans')->insert([
                'city_id' => $faker->randomElement([1, 2, 3, 4, 5]),
                'picture' => 'https://picsum.photos/200/300',
                'title' => $faker->company,
                'address' => $faker->address,
                'price' => $faker->randomElement(['100000', '200000', '300000', '400000', '500000']),
                'description' => $faker->text(100),
                'kosan_facility' => $faker->randomElement(['AC','TV','Water Heater','Breakfast','Swiming Pool']),
                'public_facility' => $faker->randomElement(['Musholla','Swimming Pool','Gym','Restaurant','Cafe']),
                'other_facility' => $faker->randomElement(['Laundry','Spa','Meeting Room','Ballroom','Parking Area']),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
