<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankFaker extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            DB::table('banks')->insert([
                'picture' => 'https://picsum.photos/200/300',
                'bank_name' => $faker->randomElement(['bca','bni','bri','bsi','mandiri']),
                'bank_account_number'=> $faker->randomElement(['123456789','234567890','345678901']),
                'account_name'=> $faker->randomElement(['peter parker','mary jane','tom cruise']),
                'status' => $faker->randomElement(['show', 'hide']),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
