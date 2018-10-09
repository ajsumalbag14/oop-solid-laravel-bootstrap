<?php

use Illuminate\Database\Seeder;

use App\Modules\UserAccess\User\Models\UserDetail;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$riderUserDetailObject = new UserDetail;
    	$riderUserDetailParameters = [
    		'user_id'			=> 1,
    		'first_name'		=> 'Aubrey',
    		'last_name'			=> 'Servito',
    		'contact_number'	=> '09XXXXXXXXX',
    		'user_image'		=> 'RIDER.jpg'
    	];
    	$riderUserDetail = $riderUserDetailObject->create($riderUserDetailParameters);

    	$driverUserDetailObject = new UserDetail;
    	$driverUserDetailParameters = [
    		'user_id'			=> 2,
    		'first_name'		=> 'Jeven',
    		'last_name'			=> 'Soquita',
    		'contact_number'	=> '09XXXXXXXXX',
    		'user_image'		=> 'DRIVER-1.jpg'
    	];
    	$driverUserDetail = $driverUserDetailObject->create($driverUserDetailParameters);

        $driverUserDetailObject = new UserDetail;
        $driverUserDetailParameters = [
            'user_id'           => 3,
            'first_name'        => 'Karloff',
            'last_name'         => 'Sotoza',
            'contact_number'    => '09XXXXXXXXX',
            'user_image'        => 'DRIVER-2.jpg'
        ];
        $driverUserDetail = $driverUserDetailObject->create($driverUserDetailParameters);

        $driverUserDetailObject = new UserDetail;
        $driverUserDetailParameters = [
            'user_id'           => 4,
            'first_name'        => 'Arvin',
            'last_name'         => 'Mito',
            'contact_number'    => '09XXXXXXXXX',
            'user_image'        => 'DRIVER-3.jpg'
        ];
        $driverUserDetail = $driverUserDetailObject->create($driverUserDetailParameters);

        $driverUserDetailObject = new UserDetail;
        $driverUserDetailParameters = [
            'user_id'           => 5,
            'first_name'        => 'Anjo',
            'last_name'         => 'Plasabas',
            'contact_number'    => '09XXXXXXXXX',
            'user_image'        => 'DRIVER-4.jpg'
        ];
        $driverUserDetail = $driverUserDetailObject->create($driverUserDetailParameters);
    }
}
