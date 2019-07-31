<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class ContentManagement extends Model
{
    protected $table='content_management';

    public $timestamps = false;
    
    protected $fillable = [
			    			'title',
			    			'content',
			    			'slug',
			    			'created_by',
			    			'created_date',
			    			'updated_by',
			    			'updated_date',
			    			'is_active',
			    			'ip_address',
			  			  ];
}
