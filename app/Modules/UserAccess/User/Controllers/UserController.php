<?php

namespace App\Modules\UserAccess\User\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

use App\Contracts\ResourceInterface;
use App\Contracts\ResponseFormatterInterface;

use App\Modules\UserAccess\User\Models\User;

class UserController extends ResourceController
{

    /**
     * @var string
     */
    protected $module = 'UserAccess';

    /**
     * @var string
     */
    protected $service = 'User';

    /**
     * @var string
     */
    protected $model = 'User';

    /**
     * @var array
     */
    protected $relation = ['userDetail', 'driver'];

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
    protected $userObject;

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
        $this->userObject = new User;
    }

    public function index(Request $request)
    {
        $userList = $this->userObject->with('userDetail', 'driver')->whereUserTypeId($request->get('user_type_id'))->get();
        $response = $this->response->prepareSuccessResponseBody($userList);
        return Response::json($response, $response['code']);

    }

}
