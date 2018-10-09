<?php

namespace App\Modules\Transaction\Rate\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

use App\Contracts\ResourceInterface;
use App\Contracts\ResponseFormatterInterface;

use App\Modules\Transaction\Rate\Models\Rate;

class RateController extends ResourceController
{

	/**
     * @var string
     */
    protected $module = 'Transaction';

    /**
     * @var string
     */
    protected $service = 'Rate';

    /**
     * @var string
     */
    protected $model = 'Rate';

    /**
     * @var array
     */
    protected $relation = [];

    /**
     * @var string
     */
    protected $namespace = __NAMESPACE__;

    /**
     * Flag if service
     * 
     * @var integer
     */
    protected $is_service = 1;

    /**
     * @var Object
     */
    protected $response;

    /**
     * @var Object
     */
    protected $rateObject;

    /**
     * @var Object
     */
    protected $resource;

    /**
     * @var Object
     */
    protected $dataFilter;

    /**
     * Initialize class 
     *
     * @param ResourceInterface $resource
     */
    public function __construct(ResourceInterface $resource, ResponseFormatterInterface $response)
    {
        $this->resource = $resource;
        $this->response = $response;
        $this->parameters   = [
            'module'        => $this->module,
            'service'       => $this->service,
            'model'         => $this->model,
            'relation'      => $this->relation,
            'namespace'     => $this->namespace,
            'is_service'    => 1
        ];
        $this->resource->parameters = $this->parameters;
        $this->rateObject = new Rate;
    }

    public function index(Request $request)
    {
    	$rateList = $this->rateObject->whereTravelNetworkCompanyId($request->get('travel_network_company_id'))->get();
    	$response = $this->response->prepareSuccessResponseBody($rateList);
    	return Response::json($response, $response['code']);
    }

}
