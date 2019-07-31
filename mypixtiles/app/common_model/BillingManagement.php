<?php 
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class BillingManagement extends Model
{
    protected $table='billing_management';

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