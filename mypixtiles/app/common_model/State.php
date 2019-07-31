<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table='state';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
                        'country_id',
    					'name',                        
    					'created_by',
    					'created_date',
    					'updated_by',
    					'updated_date',
    					'is_active',
    					'ip_address'
    					];

        public function country(){
                return $this->belongsTo('App\common_model\Country');
    }
}