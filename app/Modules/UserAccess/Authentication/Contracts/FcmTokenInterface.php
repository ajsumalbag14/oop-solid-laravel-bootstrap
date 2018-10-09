<?php

namespace App\Modules\UserAccess\Authentication\Contracts;

interface FcmTokenInterface
{

	public function updateUserToken($userId, $fcmToken);

}