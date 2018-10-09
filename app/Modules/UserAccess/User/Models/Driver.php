<?php

namespace App\Modules\UserAccess\User\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
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
    protected $table = 'driver';

    /**
     * Disable timestamps
     * 
     * @var  string
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id', 'plate_number', 'car_make', 'car_model', 'status_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Modules\UserAccess\User\Models\User', 'user_id', 'id');
    }

}
