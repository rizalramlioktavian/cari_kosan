<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PromotionFaker extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            DB::table('promotions')->insert([
                'picture' => 'https://picsum.photos/200/300',
                'title' => $faker->company,
                'discount' => $faker->randomElement(['10','20','30','40','50']),
                'status' => $faker->randomElement(['show', 'hide']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
