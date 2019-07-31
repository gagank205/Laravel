<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class FrameManagement extends Model
{
    protected $table='frame_management';

    public $timestamps = false;
    
    protected $fillable = [
			    			'title',
			    			'description',
			    			'frame_image',
			    			'created_by',
			    			'created_date',
			    			'updated_by',
			    			'updated_date',
			    			'is_active',
			    			'ip_address',
			  			  ];
}
