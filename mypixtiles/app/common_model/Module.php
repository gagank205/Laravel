<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table='module';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
    					'module_name',
    					'icon',
    					'created_by',
    					'created_date',
    					'updated_by',
    					'updated_date',
    					'is_active',
    					];

    public function moduleAction()
    {
        return $this->hasMany('App\common_model\Moduleaction');
    }                        
}