<?php

namespace App\Contracts;

interface PrepareModelFieldValueInterface
{

	public function mapFieldValues($modelName, $requestFields);

	public function getModelFields($modelName);

}