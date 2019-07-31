<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class CategoryManagement extends Model
{
    protected $table='product_category';
    public $timestamps = false;
    protected $fillable = [
			    			'name',
			    			'category_icon',
			    			'created_by',
			    			'created_date',
			    			'updated_by',
			    			'updated_date',
			    			'is_active',
			    			'ip_address'
			  			  ];
    public function subcategory()
    {
        return $this->hasMany('App\common_model\SubCategoryManagement');
    }		  			  
}