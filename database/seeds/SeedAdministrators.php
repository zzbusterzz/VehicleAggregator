<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class SeedAdministrators extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();                
        foreach (range(1,10) as $index) {
            DB::table('administrators')->insert([
                'username' => $faker->name,
                'password' => $faker->password,
                'email' => $faker->email,
            ]);
        }
    }
}