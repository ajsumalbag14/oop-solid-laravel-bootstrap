<?php

namespace App\Modules\Transaction\Trip\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
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
    protected $table = 'trip';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'passenger_id', 'driver_id', 'origin_address', 'origin_longitude', 'origin_latitude', 'destination_address', 'destination_longitude', 'destination_latitude', 'current_longitude', 'current_latitude', 'estimated_distance', 'estimated_time', 'rate_amount', 'status_id', 'created_at', 'updated_at'
    ];
    

    public function rider()
    {
        return $this->belongsTo('App\Modules\UserAccess\User\Models\User', 'passenger_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo('App\Modules\UserAccess\User\Models\User', 'driver_id', 'id');
    }

}
