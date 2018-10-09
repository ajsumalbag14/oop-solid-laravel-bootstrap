<?php

namespace App\Modules\UserAccess\Authentication\Services;

use App\Modules\UserAccess\Authentication\Contracts\FcmTokenInterface;

use App\Modules\UserAccess\User\Models\User;

class FcmToken implements FcmTokenInterface
{

	protected $userObject;

	public function __construct()
	{
		$this->userObject = new User;
	}

	public function updateUserToken($userId, $fcmToken)
	{
		$user = $this->userObject->whereId($userId)->first();
		if ($user) {
			$user->update(['fcm_token' => $fcmToken]);
			$result = [
				'status'	=> 1,
				'data'		=> $user
			];
		}
		else {
			$result = [
				'status'	=> 0,
				'message'	=> 'User not found'
			];
		}
		return $result;
	}

}