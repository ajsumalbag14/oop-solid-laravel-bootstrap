<?php

namespace App\Services;

use App\Contracts\ModelMapperInterface;

class ModelMapper implements ModelMapperInterface
{

	/**
	 * Map model namespace directory using the namespace directory of the initialized controller
	 *
	 * @param  string $namespace 
	 * @param  string $model     
	 * @return string
	 */
	public function mapWithNamespace($namespace = '', $model = '')
	{
		$model_namespace = str_replace('Controllers', 'Models', $namespace);
		return $model_namespace.'\\'.$model;
	}

	/**
	 * Map model namespace using module name parameter
	 *
	 * @param  string $module 
	 * @param  string $model  
	 * @return string         
	 */
	public function mapWithNamespaceDirectModule($module = '', $model = '')
	{
		return "\App\Modules\\".$module."\Models\\".$model;
	}

}