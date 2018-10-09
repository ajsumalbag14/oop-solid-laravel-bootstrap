<?php

use Illuminate\Database\Seeder;

use App\Modules\UserAccess\User\Models\TravelNetworkCompany;

class TravelNetworkCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$tncOBject = new TravelNetworkCompany;

    	$tncParameters = [
    		'company_name'		=> 'UBRE Corporation',
    		'company_address'	=> 'BGC, Taguig City'
    	];

    	$tnc = $tncOBject->create($tncParameters);

    }
}
