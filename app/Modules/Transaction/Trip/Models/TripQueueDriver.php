<?php

namespace App\Modules\Transaction\Trip\Models;

use Illuminate\Database\Eloquent\Model;

class TripQueueDriver extends Model
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
    protected $table = 'trip_queue_driver';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'trip_queue_id', 'driver_id', 'status_id', 'created_at', 'updated_at'
    ];

}
