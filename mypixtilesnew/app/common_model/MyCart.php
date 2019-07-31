<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class MyCart extends Model
{
    protected $table='my_cart';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
    					'user_id',
    					'restaurant_branch_id',
                        'food_quantity',
                        'price',
                        'cancel_order',                              
    					'created_by',
    					'created_date',
    					'updated_by',
    					'updated_date',
    					'is_active',
    					'ip_address'
    					];
}