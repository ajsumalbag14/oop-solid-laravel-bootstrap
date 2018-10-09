<?php

use Illuminate\Database\Seeder;

use App\Modules\UserAccess\User\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$userTypeObject = new UserType;

    	$riderUserTypeParameters['user_type_label'] = 'RIDER';
    	$riderUserType = $userTypeObject->create($riderUserTypeParameters);

    	$driverUserTypeParameters['user_type_label'] = 'DRIVER';
    	$drivereUserType = $userTypeObject->create($driverUserTypeParameters);

        $driverUserTypeParameters['user_type_label'] = 'TRAVEL NETWORK COMPANY';
        $drivereUserType = $userTypeObject->create($driverUserTypeParameters);

        $driverUserTypeParameters['user_type_label'] = 'ADMIN';
        $drivereUserType = $userTypeObject->create($driverUserTypeParameters);


    }
}
