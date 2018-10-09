<?php

namespace App\Modules\UserAccess\User\Observers;

use Illuminate\Http\Request;

use App\Modules\UserAccess\User\Models\User;
use App\Modules\UserAccess\User\Models\UserDetail;
use App\Modules\UserAccess\User\Models\Driver;

class UserObserver
{

	protected $request;

	protected $user;

	protected $userDetail;

	protected $driver;

	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->userDetail = new UserDetail;
		$this->driver = new Driver;
	}

	public function created(User $user)
	{
		if ($this->request->has('first_name')) {
			// Prepare user detail parameters
			$userDetailParameters = [
				'user_id'			=> $user->id,
				'first_name'		=> $this->request->has('first_name') ? $this->request->get('first_name') : '',
				'last_name'			=> $this->request->has('last_name') ? $this->request->get('last_name') : '',
				'contact_number'	=> $this->request->has('contact_number') ? $this->request->get('contact_number') : '',
				'user_image'		=> 'USER.jpg'
			];
			// Rider
			if ($user->user_type_id == 1) {
				$userDetail = $this->userDetail->create($userDetailParameters);
			}
			// Driver
			else if ($user->user_type_id == 2) {
				$userDetail = $this->userDetail->create($userDetailParameters);

				$driverParameters = [
					'user_id'			=> $user->id,
					'plate_number'		=> $this->request->has('plate_number') ? $this->request->get('plate_number') : '',
					'car_make'			=> $this->request->has('car_make') ? $this->request->get('car_make') : '',
					'car_model'			=> $this->request->has('car_model') ? $this->request->get('car_model') : '',
					// 'user_image'		=> ''
				];
				$driver = $this->driver->create($driverParameters);
			}
		}
	}

	public function updated(User $user)
	{
		if ($this->request->has('first_name')) {
			// Prepare user detail parameters
			$userDetailParameters = [
				'first_name'		=> $this->request->has('first_name') ? $this->request->get('first_name') : '',
				'last_name'			=> $this->request->has('last_name') ? $this->request->get('last_name') : '',
				'contact_number'	=> $this->request->has('contact_number') ? $this->request->get('contact_number') : '',
				// 'user_image'		=> ''
			];
			// Rider
			if ($user->user_type_id == 1) {
				$userDetail = $this->userDetail->whereUserId($user->id)->update($userDetailParameters);
			}
			// Driver
			else if ($user->user_type_id == 2) {
				$userDetail = $this->userDetail->whereUserId($user->id)->update($userDetailParameters);

				$driverParameters = [
					'plate_number'		=> $this->request->has('plate_number') ? $this->request->get('plate_number') : '',
					'car_make'			=> $this->request->has('car_make') ? $this->request->get('car_make') : '',
					'car_model'			=> $this->request->has('car_model') ? $this->request->get('car_model') : '',
					// 'user_image'		=> ''
				];
				$driver = $this->driver->whereUserId($user->id)->update($driverParameters);
			}
		}
	}

}