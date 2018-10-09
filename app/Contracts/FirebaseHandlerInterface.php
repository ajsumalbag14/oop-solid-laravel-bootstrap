<?php

namespace App\Contracts;

interface FirebaseHandlerInterface
{

	public function prepareRequestBody($requestBody, $authorizationKey, $deviceToken, $type);

	public function submitRequest();

}