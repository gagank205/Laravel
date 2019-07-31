<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    protected $table='user_device';
    protected $timestamp=false;
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable=[
    					 'user_id',
                         'user_role_id',
                         'user_device_id',
                         'user_device_token',
                         'fcm_token',
                         'device_date',
                         'is_login',
                         'created_by',
    					 'created_date',
                         'updated_by',
                         'updated_date',
                         'is_active',
    					 'ip_address',
    					];
}
?>