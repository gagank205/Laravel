<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class Actionmaster extends Model
{
    protected $table='action';
    protected $timestamp=false;
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
    					'action_name',
    					'route',    					
    					'is_active',
    					];

    public function moduleAction()
    {
        return $this->hasMany('App\common_model\Moduleaction');
    }                        
}
