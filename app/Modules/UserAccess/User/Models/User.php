<?php

namespace App\Modules\UserAccess\User\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

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
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'travel_network_company_id', 'user_type_id', 'email', 'password', 'fcm_token', 'is_active', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userDetail()
    {
        return $this->hasOne('App\Modules\UserAccess\User\Models\UserDetail', 'user_id');
    }

    public function driver()
    {
        return $this->hasOne('App\Modules\UserAccess\User\Models\Driver', 'user_id');
    }

}
