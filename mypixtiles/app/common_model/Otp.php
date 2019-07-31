<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $table='otp';
    protected $timestamp=false;
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable=[
    					 'otp',
                         'contact_number',
                         'is_expire',
                         'created_date',
                         'updated_date',
                        ];
    				


}