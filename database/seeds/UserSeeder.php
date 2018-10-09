<?php

use Illuminate\Database\Seeder;

use App\Modules\UserAccess\User\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$riderUserObject = new User;
    	$riderUserParameters = [
    		'travel_network_company_id'		=> 1,
    		'user_type_id'					=> 1,
    		// 'email'							=> 'aservito@ubrecorp.com',
            'email'                         => 'aservito',
    		'password'						=> Hash::make('test123'),
    		'is_active'						=> 1
    	];
    	$riderUser = $riderUserObject->create($riderUserParameters);

    	$driverUserObject = new User;
    	$driverUserParameters = [
    		'travel_network_company_id'		=> 1,
    		'user_type_id'					=> 2,
    		// 'email'							=> 'jsoquita@ubrecorp.com',
            'email'                         => 'jsoquita',
    		'password'						=> Hash::make('test123'),
    		'is_active'						=> 1
    	];
    	$driverUser = $driverUserObject->create($driverUserParameters);

        $driverUserObject = new User;
        $driverUserParameters = [
            'travel_network_company_id'     => 1,
            'user_type_id'                  => 2,
            // 'email'                          => 'jsoquita@ubrecorp.com',
            'email'                         => 'ksotoza',
            'password'                      => Hash::make('test123'),
            'is_active'                     => 1
        ];
        $driverUser = $driverUserObject->create($driverUserParameters);

        $driverUserObject = new User;
        $driverUserParameters = [
            'travel_network_company_id'     => 1,
            'user_type_id'                  => 2,
            // 'email'                          => 'jsoquita@ubrecorp.com',
            'email'                         => 'amito',
            'password'                      => Hash::make('test123'),
            'is_active'                     => 1
        ];
        $driverUser = $driverUserObject->create($driverUserParameters);

        $driverUserObject = new User;
        $driverUserParameters = [
            'travel_network_company_id'     => 1,
            'user_type_id'                  => 2,
            // 'email'                          => 'jsoquita@ubrecorp.com',
            'email'                         => 'jplasabas',
            'password'                      => Hash::make('test123'),
            'is_active'                     => 1
        ];
        $driverUser = $driverUserObject->create($driverUserParameters);

    }
}
