<?php

use Illuminate\Database\Seeder;

use App\Modules\UserAccess\User\Models\Driver;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$driverObject = new Driver;
    	$driverParameters = [
    		'user_id'		=> 2,
    		'plate_number'	=> 'HRNY-001',
    		'car_make'		=> 'Toyota',
    		'car_model'		=> 'Wigo',
    		'status_id'		=> 1
    	];
    	$driver = $driverObject->create($driverParameters);

        $driverObject = new Driver;
        $driverParameters = [
            'user_id'       => 3,
            'plate_number'  => 'ANBC-001',
            'car_make'      => 'Toyota',
            'car_model'     => 'Ccorolla',
            'status_id'     => 1
        ];
        $driver = $driverObject->create($driverParameters);

        $driverObject = new Driver;
        $driverParameters = [
            'user_id'       => 4,
            'plate_number'  => 'ANBD-001',
            'car_make'      => 'Toyota',
            'car_model'     => 'Fortuner',
            'status_id'     => 1
        ];
        $driver = $driverObject->create($driverParameters);

        $driverObject = new Driver;
        $driverParameters = [
            'user_id'       => 5,
            'plate_number'  => 'ANBG-001',
            'car_make'      => 'Toyota',
            'car_model'     => 'Vios',
            'status_id'     => 1
        ];
        $driver = $driverObject->create($driverParameters);
    }
}
