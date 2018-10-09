<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ResourceInterface
{

    /**
     * Show all resource
     *
     * @param Request $request
     * @return void
     */
    public function showAllResource(Request $request);

    /**
     * Show resource by primakey key id value
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function showResource(Request $request, $id = 0);
    
    /**
     * Show resource by specified key and id value pair
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function showResourceByFieldAndValue(Request $request, $id = 0);

    /**
     * Store new resource
     *
     * @param Request $request
     * @return void
     */
    public function storeResource(Request $request);
    
    /**
     * Store new multiple resources
     *
     * @param Request $request
     * @return void
     */
    public function storeMultipleResource(Request $request);
    
    /**
     * Updat resource using primary key id value
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function updateResourceById(Request $request, $id = 0);

    /**
     * Update resource using specified field column and value
     *
     * @param Request $request
     * @param string $field
     * @param integer $value
     * @return void
     */
    public function updateResourceByFieldAndValue(Request $request, $field = '', $value = 0);

    /**
     * Delete resource by primakey key id value
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function deleteResourceById(Request $request, $id = 0);

    /**
     * Delete resource using specified field and value
     *
     * @param Request $request
     * @param string $field
     * @param integer $value
     * @return void
     */
    public function deleteResourceByFieldAndValue(Request $request, $field = '', $value = 0);

}