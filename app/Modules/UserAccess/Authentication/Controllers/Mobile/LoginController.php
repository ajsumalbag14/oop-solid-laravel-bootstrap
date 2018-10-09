<?php

namespace App\Modules\UserAccess\Authentication\Controllers\Mobile;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contracts\ResponseFormatterInterface;
use App\Modules\UserAccess\Authentication\Contracts\AuthenticateCredentialsInterface;
use App\Modules\UserAccess\Authentication\Contracts\AuthFormatInterface;

class LoginController extends Controller
{

	protected $responseFormatter;

	protected $response;

	protected $authCredentials;

	protected $authMobileFormat;

	public function __construct(ResponseFormatterInterface $responseFormatter, AuthenticateCredentialsInterface $authCredentials, AuthFormatInterface $authMobileFormat)
	{
		$this->responseFormatter = $responseFormatter;
		$this->authCredentials = $authCredentials;
		$this->authMobileFormat = $authMobileFormat;
	}

	public function handle(Request $request)
	{
		$authResult = $this->authCredentials->verify($request);
		if ($authResult['status'] == 1) {
			$mobileResponseFormat = $this->authMobileFormat->prepare($authResult['data']['user']);
			$this->response = $this->responseFormatter->prepareSuccessResponseBody($mobileResponseFormat);
		}
		else if ($authResult['status'] == 2) {
			$this->response = $this->responseFormatter->prepareUnprocessedResponseBody($authResult['message']);
		}
		else {
			$this->response = $this->responseFormatter->prepareErrorResponseBody($authResult['message']);
		}
		return Response::json($this->response, $this->response['code']);
	}

}
