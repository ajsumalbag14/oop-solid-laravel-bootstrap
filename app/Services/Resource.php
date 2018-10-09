<?php

namespace App\Services;

use Illuminate\Http\Request;

use Schema;

use App\Contracts\ResourceInterface;
use App\Contracts\ModelMapperInterface;
use App\Contracts\PrepareModelFieldValueInterface;

class Resource implements ResourceInterface
{

	/**
     * @var array
     */
    public $parameters;

    /**
     * @var object
     */
    private $source;

    /**
     * @var string
     */
    private $model;

    /*
     * @var string
     */
    private $primary_key;

    /*
     * @var object
     */
    private $modelMapper;

    /**
     * Initialize 
     *
     * @param ModelMapperInterface $model_mapper
     * @return void
     */
    public function __construct(ModelMapperInterface $modelMapper, PrepareModelFieldValueInterface $modelFieldValue)
    {
        $this->modelMapper = $modelMapper;
        $this->modelFieldValue = $modelFieldValue;
    }

    /**
     * Show all resource
     *
     * @param Request $request
     * @return void
     */
    public function showAllResource(Request $request)
    {
        $source = ($this->parameters['is_service'] == 1 ? $this->modelMapper->mapWithNamespace($this->parameters['namespace'], $this->parameters['model']) : $this->modelMapper->mapWithNamespaceDirectModule($this->parameters['module'], $this->parameters['model']));
        if ($this->parameters['relation']) {
            $model = $source::with($this->parameters['relation'])->get();
        }
        else {
            $model = $source::all();
        }
        return $model;
    }

    /**
     * Show resource by primakey key id value
/     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function showResource(Request $request, $id = 0)
    {
        $source = ($this->parameters['is_service'] == 1 ? $this->modelMapper->mapWithNamespace($this->parameters['namespace'], $this->parameters['model']) : $this->modelMapper->mapWithNamespaceDirectModule($this->parameters['module'], $this->parameters['model']));
        if ($this->parameters['relation']) {
        	$model = $source::with($this->parameters['relation'])->find($id);
        }
        else {
	        $model = $source::find($id);
        }
        if ($model) {
            return $model->toArray();
        }
        return [];
    }
    
    /**
     * Show resource by specified key and id value pair
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function showResourceByFieldAndValue(Request $request, $id = 0)
    {
        $source = ($this->parameters['is_service'] == 1 ? $this->modelMapper->mapWithNamespace($this->parameters['namespace'], $this->parameters['model']) : $this->modelMapper->mapWithNamespaceDirectModule($this->parameters['module'], $this->parameters['model']));
        $model = $source::where($field, $value)->first();
        if ($model) {
            return $model->toArray();
        }
        return [];
    }

    /**
     * Store new resource
     *
     * @param Request $request
     * @return void
     */
    public function storeResource(Request $request)
    {
        $source = ($this->parameters['is_service'] == 1 ? $this->modelMapper->mapWithNamespace($this->parameters['namespace'], $this->parameters['model']) : $this->modelMapper->mapWithNamespaceDirectModule($this->parameters['module'], $this->parameters['model']));
        $model = new $source;
        $modelFieldValue = $this->modelFieldValue->mapFieldValues($model->getTable(), $request->all());
        if ($response = $source::create($modelFieldValue)) {
            return $response->toArray();
        }
        return [];
    }
    
    /**
     * Store new multiple resources
     *
     * @param Request $request
     * @return array
     */
    public function storeMultipleResource(Request $request)
    {
        $source = ($this->parameters['is_service'] == 1 ? $this->modelMapper->mapWithNamespace($this->parameters['namespace'], $this->parameters['model']) : $this->modelMapper->mapWithNamespaceDirectModule($this->parameters['module'], $this->parameters['model']));
        $response = [];
        foreach ($request->all() as $resource) {
            $model = new $source;
            foreach ($resource as $field => $value) {
                if (Schema::hasColumn($model->getTable(), $field)) {
                    $model->{$field} = ($field == 'password' ? Hash::make($value) : $value);
                }
            }
            if ($model->save()) {
                $response[] = $this->model->toArray();
            }
            else {
                break;
            }
        }
        return $response;
    }
    
    /**
     * Updat resource using primary key id value
     *
     * @param Request $request
     * @param integer $id
     * @return array
     */
    public function updateResourceById(Request $request, $id = 0)
    {
        $source = ($this->parameters['is_service'] == 1 ? $this->modelMapper->mapWithNamespace($this->parameters['namespace'], $this->parameters['model']) : $this->modelMapper->mapWithNamespaceDirectModule($this->parameters['module'], $this->parameters['model']));
        $model = $source::find($id);
        if ($model) {
            // $this->primary_key = $model->getKeyName();
            $field_value = $this->modelFieldValue->mapFieldValues($model->getTable(), $request->all());
            if (count($field_value) > 0) {
                $model->update($field_value);
                $model->touch();
                return $model::find($id)->toArray();
            }
            else {
                return [];
            }
        }
        return [];
    }

    /**
     * Update resource using specified field column and value
     *
     * @param Request $request
     * @param string $field
     * @param integer $value
     * @return void
     */
    public function updateResourceByFieldAndValue(Request $request, $field = '', $value = 0)
    {
        $source = ($this->parameters['is_service'] == 1 ? $this->modelMapper->mapWithNamespace($this->parameters['namespace'], $this->parameters['model']) : $this->modelMapper->mapWithNamespaceDirectModule($this->parameters['module'], $this->parameters['model']));
        $model = $source::where($field, $value)->first();
        if ($model) {
            $field_value = $this->modelFieldValue->mapFieldValues($request->all());
            if (count($field_value) > 0) {
               $source::where($field, $value)->update($field_value);
                return $model->toArray();
            }
            else {
                return [];
            }
        } 
        return [];
    }

    /**
     * Delete resource by primakey key id value
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function deleteResourceById(Request $request, $id = 0)
    {
        $source = ($this->parameters['is_service'] == 1 ? $this->modelMapper->mapWithNamespace($this->parameters['namespace'], $this->parameters['model']) : $this->modelMapper->mapWithNamespaceDirectModule($this->parameters['module'], $this->parameters['model']));
        $model = $source::find($id);
        if ($model) {
            if ($model->delete()) {
                return $model->toArray();
            }
            return [];
        }
        return [];
    }

    /**
     * Delete resource using specified field and value
     *
     * @param Request $request
     * @param string $field
     * @param integer $value
     * @return void
     */
    public function deleteResourceByFieldAndValue(Request $request, $field = '', $value = 0)
    {
        $source = ($this->parameters['is_service'] == 1 ? $this->modelMapper->mapWithNamespace($this->parameters['namespace'], $this->parameters['model']) : $this->modelMapper->mapWithNamespaceDirectModule($this->parameters['module'], $this->parameters['model']));
        $model = $source::where($field, $value)->first();
        if ($model) {
            if ($model->delete()) {
                return $model->toArray();
            }
            return [];
        }
        return [];
    }

}