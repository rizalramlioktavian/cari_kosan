<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderFaker extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            DB::table('orders')->insert([
                'user_id' => $faker->randomElement([1]),
                'room_id' => $faker->randomElement([1, 2, 3, 4, 5]),
                'promo_id' => $faker->randomElement([1, 2, 3, 4, 5]),
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'payment_method' => $faker->randomElement(['transfer', 'ovo', 'gopay', 'dana']),
                'check_in' => $faker->dateTimeBetween('now', '+1 years')->format('Y-m-d H:i:s'),
                'check_out' => $faker->dateTimeBetween('now', '+1 years')->format('Y-m-d 14:00:00'),
                'total_nights' => $faker->randomElement([1, 2, 3, 4, 5]),
                'total_price' => $faker->randomElement(['100000', '200000']),
                'status' => $faker->randomElement(['process', 'success',]),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
