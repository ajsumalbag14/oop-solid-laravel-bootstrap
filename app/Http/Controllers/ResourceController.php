<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;

use App\Contracts\ResourceInterface;
use App\Contracts\ResponseFormatterInterface;

class ResourceController extends Controller
{

	/**
     * @var string
     */
    protected $module;
    
    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $model;

    /**
     * @var array
     */
    protected $relation;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * Resource object
     *
     * @var object
     */
    protected $resource;

    /**
     * Flag if service
     * 
     * @var integer
     */
    protected $is_service = 0;

    /**
     * Response array
     *
     * @var array
     */
    protected $response;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resource = $this->resource->showAllResource($request);
        $response = $this->response->prepareSuccessResponseBody($resource);
        return Response::json($response, $response['code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resource = $this->resource->storeResource($request);
        $response = $this->response->prepareSuccessResponseBody($resource, '201');
        return Response::json($response, $response['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = $this->resource->showResource($request, $id);
        if (count($resource) > 0) {
            $response = $this->response->prepareSuccessResponseBody($resource);
        }
        else {
            $response = $this->response->prepareNotFoundResponseBody();
        }
        return Response::json($response, $response['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resource = $this->resource->updateResourceById($request, $id);
        if (count($resource) > 0) {
            $response = $this->response->prepareSuccessResponseBody($resource);
        }
        else {
            $response = $this->response->prepareNotFoundResponseBody();
        }
        return Response::json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $resource = $this->resource->deleteResourceById($request, $id);
        if (count($resource) > 0) {
            $response = $this->response->prepareSuccessResponseBody($resource);
        }
        else {
            $response = $this->response->prepareNotFoundResponseBody();
        }
        return Response::json($response, $response['code']);
    }

}
