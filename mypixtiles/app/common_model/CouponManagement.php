<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class CouponManagement extends Model
{
    protected $table='coupon_management';

    public $timestamps = false;
    
    protected $fillable = [
			    			'coupon_name',
			    			'coupon_code',
			    			'coupon_description',
			    			'discount_type',
			    			'discount',
			    			'start_date',
			    			'end_date',
			    			'created_by',
			    			'created_date',
			    			'updated_by',
			    			'updated_date',
			    			'is_active',
			    			'ip_address',
			  			  ];
}
