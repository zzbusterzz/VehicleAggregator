<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class SeedLocations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();   
        foreach (range(1,20) as $index) {
            DB::table('locations')->insert([
                'h_no' => $faker->buildingNumber,
                'street' => $faker->streetName,
                'locality' => $faker->streetAddress,                
                'city' => $faker->city,
                'state' => $faker->state,
                'pincode' => $faker->randomDigit,
                'shopphone' => $faker->phoneNumber,
                'shopname' => $faker->company
            ]);
        }
    }
}