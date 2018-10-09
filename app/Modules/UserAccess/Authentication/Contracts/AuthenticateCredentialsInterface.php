<?php

namespace App\Modules\UserAccess\Authentication\Contracts;

use Illuminate\Http\Request;

interface AuthenticateCredentialsInterface
{

	public function verify(Request $request, $isMobile = 1);

}