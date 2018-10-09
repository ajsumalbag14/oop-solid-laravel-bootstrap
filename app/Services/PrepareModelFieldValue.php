<?php

namespace App\Services;

use App\Contracts\PrepareModelFieldValueInterface;

use Hash;
use Schema;

class PrepareModelFieldValue implements PrepareModelFieldValueInterface
{

	public function mapFieldValues($modelName, $requestFields) 
	{
        $response = [];
        $modelFields = $this->getModelFields($modelName);
		foreach ($modelFields as $modelField) {
			if (isset($requestFields[$modelField])) {
                $response[$modelField] = ($modelField == 'password' ? Hash::make($requestFields[$modelField]) : $requestFields[$modelField]);
			}
		}
		return $response;
	}

	public function getModelFields($modelName)
	{
		$modelFields = Schema::getColumnListing($modelName);
		return $modelFields;
	}

}