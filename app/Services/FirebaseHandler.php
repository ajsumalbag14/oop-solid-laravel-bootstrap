<?php

namespace App\Services;

use App\Contracts\FirebaseHandlerInterface;

use Curl;

class FirebaseHandler implements FirebaseHandlerInterface
{

	protected $requestBody;

	protected $requestHeaders;

	protected $requestResult;

	protected $firebaseUrl;

	public function __construct()
	{
		$this->firebaseUrl = 'https://fcm.googleapis.com/fcm/send';
	}

	public function prepareRequestBody($requestBody, $authorizationKey, $deviceToken, $type)
	{
		// Prepare request headers 
		$this->requestHeaders = 'Authorization: key='.$authorizationKey;
		// Prepare request body
		$this->requestBody = [
			'notification' => [
				'title'				=> $requestBody['title'],
				'body'				=> $requestBody['body'],
				'content_available' => $requestBody['content_available'],
				// 'sound'				=> '',
				// 'badge'				=> 1
			],
			'data' => [
				'type'	=> $type
			],
			'registration_ids' => [
				$deviceToken
			]
		];
	}

	public function submitRequest()
	{
		$this->requestResult = Curl::to($this->firebaseUrl)
			->withData($this->requestBody)
			->asJson('true')
			->withHeader($this->requestHeaders)
			->post();
			// echo $this->firebaseUrl.'-------';
			// print_r($this->requestResult);exit;
		return $this->requestResult;
	}
	
}