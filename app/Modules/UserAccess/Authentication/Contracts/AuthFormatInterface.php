<?php

namespace App\Modules\UserAccess\Authentication\Contracts;

interface AuthFormatInterface
{

	public function prepare($objectData);

}