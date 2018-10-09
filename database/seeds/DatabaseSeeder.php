<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(TravelNetworkCompanySeeder::class);
        $this->call(RateSeeder::class);
    	$this->call(UserTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserDetailSeeder::class);
    	$this->call(DriverSeeder::class);
    }
}
