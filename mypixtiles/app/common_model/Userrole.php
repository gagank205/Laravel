<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class Userrole extends Model
{
    protected $table='userrole';
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable=[
                         'name',
                         'created_by',
    					 'created_date',
                         'updated_by',
                         'updated_date',
                         'is_active',
                         'is_delete',
    					];
    				


}
