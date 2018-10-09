<?php

namespace App\Modules\Transaction\Rate\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
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
    protected $table = 'rate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'travel_network_company_id', 'rate_per_km', 'rate_per_minute', 'is_active', 'created_at', 'updated_at'
    ];

}
