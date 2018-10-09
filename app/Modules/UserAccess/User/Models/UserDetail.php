<?php

namespace App\Modules\UserAccess\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
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
    protected $table = 'user_detail';

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
    	'user_id', 'first_name', 'last_name', 'contact_number', 'user_image'
    ];

}
