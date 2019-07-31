<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class Moduleaction extends Model
{
    protected $table='module_action';
    protected $timestamp=false;
    
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    
    protected $fillable=[
    					'action_id',
                        'module_id',
                        'created_by',
                        'created_date',
                        'updated_by',
                        'updated_date',
    					'route',
    					'is_active',
    					'is_delete'
    					];

    public function module()
    {
        return $this->belongsTo('App\common_model\Module');
    }
    public function action()
    {
        return $this->belongsTo('App\common_model\Actionmaster');
    }
}
