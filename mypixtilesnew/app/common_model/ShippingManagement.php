<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class ShippingManagement extends Model
{
    protected $table='shipping_management';

    public $timestamps = false;
    
    protected $fillable = [
			    			'user_id',
			    			'fullname',
			    			'address',
			    			'city',
			    			'state',
			    			'country',
			    			'postal_code',
			    			'mobile',
			  			  ];
}
