<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        //php artisan db:seed 
        //$this->call('SeedAdministrators');
        //$this->call('SeedCustomers');
        $this->call('SeedLocations');
        //$this->call('SeedServiceProviders');
        //$this->call('SeedVendors');
    }
}
