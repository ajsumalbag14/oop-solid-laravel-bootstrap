<?php

namespace App\Modules\UserAccess\User\Models;

use Illuminate\Database\Eloquent\Model;

class TravelNetworkCompany extends Model
{

    /**
     * The primary key of table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'travel_network_company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'company_name', 'company_address', 'is_active', 'created_at', 'updated_at'
    ];
}
