<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //php artisan db:seed 
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('customers')->insert([
                'username' => $faker->userName,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,                
                'password' => $faker->password, //bcrypt('secret'),                
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
            ]);
        }

        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('vendors')->insert([
                'username' => $faker->userName,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,                
                'password' => $faker->password, //bcrypt('secret'),                
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
            ]);
        }

        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('service_providers')->insert([
                'username' => $faker->userName,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,                
                'password' => $faker->password, //bcrypt('secret'),                
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
            ]);
        }
        

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
