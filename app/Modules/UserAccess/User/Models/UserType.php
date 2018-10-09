<?php

namespace App\Modules\UserAccess\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
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
    protected $table = 'user_type';

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
    	'user_type_label'
    ];

}
