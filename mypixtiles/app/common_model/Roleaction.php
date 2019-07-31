<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class Roleaction extends Model
{
    protected $table='role_action';
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable=[
    					 'role_id',
                         'module_id',
    					 'action_id',
    					 'is_active',
    					 'created_by',
    					 'updated_by',
    					 'created_date',
    					 'updated_date'
    					];
}
