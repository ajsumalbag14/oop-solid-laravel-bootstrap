<?php

namespace App\Services;

use App\Contracts\ResponseFormatterInterface;

class ResponseFormatter implements ResponseFormatterInterface
{

	public function prepareSuccessResponseBody($data, $code = '200')
	{
		return [
			'code'		=> intval($code),
			'status'	=> 'SCC',
			'data'		=> $data
		];
	}

	public function prepareNotFoundResponseBody($message = 'Resource not found')
	{
		return [
			'code'		=> intval('404'),
			'status'	=> 'NFR',
			'message'	=> $message
		];
	}

	public function prepareErrorResponseBody($message = 'An error occured during operation')
	{
		return [
			'code'		=> intval('500'),
			'status'	=> 'ERR',
			'message'	=> $message
		];
	}

	public function prepareUnprocessedResponseBody($message)
	{
		return [
			'code'		=> intval('422'),
			'status'	=> 'ERR',
			'message'	=> $message
		];
	}

}