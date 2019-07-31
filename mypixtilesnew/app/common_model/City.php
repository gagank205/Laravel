<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table='city';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
    					'name', 
                        'country_id',
                        'state_id',                       
    					'created_by',
    					'created_date',
    					'updated_by',
    					'updated_date',
    					'is_active',
    					'ip_address'
    					];
}