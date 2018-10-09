<?php

use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('rate')->insert([
    		'travel_network_company_id'		=> 1,
    		'rate_per_km'					=> 45,
    		'rate_per_minute'				=> 3,
    		'is_active'						=> 1,
    		'created_at'					=> \Carbon\Carbon::now(),
    		'updated_at'					=> \Carbon\Carbon::now()
    	]);
    }
}
