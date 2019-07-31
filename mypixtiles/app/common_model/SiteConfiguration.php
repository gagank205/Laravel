<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class SiteConfiguration extends Model
{
    protected $table='site_configuration';
    public $timestamps = false;
    protected $fillable = [
			    			'config_key',
			    			'config_value',
			    			'created_by',
			    			'created_date',
			    			'updated_by',
			    			'updated_date',
			    			'is_active',
			    			'ip_address'
			  			  ];
}