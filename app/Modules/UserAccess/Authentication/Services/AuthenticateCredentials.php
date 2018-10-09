<?php

namespace App\Modules\UserAccess\Authentication\Services;

use Hash;
use Illuminate\Http\Request;

use App\Modules\UserAccess\Authentication\Contracts\AuthenticateCredentialsInterface;
use App\Modules\UserAccess\Authentication\Contracts\FcmTokenInterface;

use App\Modules\UserAccess\User\Models\User;

class AuthenticateCredentials implements AuthenticateCredentialsInterface
{

	protected $fcmToken;

	protected $userObject;

	public function __construct(FcmTokenInterface $fcmToken)
	{
		$this->userObject = new User;
		$this->fcmToken = $fcmToken;
	}

	public function verify(Request $request, $isMobile = 1)
	{
		$user = $this->userObject->whereEmail($request->get('email'))->first();
		if ($user) {
			if (Hash::check($request->get('password'), $user->password)) {
				if ($isMobile == 1) {
					// Update fcm_token
					$this->fcmToken->updateUserToken($user->id, $request->get('fcm_token'));
				}
				// Reload data
				$user = $this->userObject->find($user->id);
				// Prepare response
				$verificationResponse = [
					'status'		=> 1,
					'data'			=> [
						'user'		=> $user
					]
				];
			}
			else {
				$verificationResponse = [
					'status'		=> 2,
					'message'		=> 'Invalid Password'
				];
			}
		}
		else {
			$verificationResponse = [
				'status'		=> 3,
				'message'		=> 'Invalid Email'
			];
		}
		return $verificationResponse;
	}

}