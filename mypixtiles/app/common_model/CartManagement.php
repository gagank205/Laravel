<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class CartManagement extends Model
{
    protected $table='frame_cart';

    public $timestamps = false;
    
    protected $fillable = [
			    			'customize_frame',
			    			'user_id',
			    			'status',
			    			'ip_address',
			  			  ];
}
