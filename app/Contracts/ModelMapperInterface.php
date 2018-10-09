<?php

namespace App\Contracts;

interface ModelMapperInterface
{

	public function mapWithNamespace($namespace = '', $model = '');

	public function mapWithNamespaceDirectModule($module = '', $model = '');

}