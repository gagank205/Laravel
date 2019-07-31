<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class OrderManagement extends Model
{
    protected $table='order_management';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
    					'user_id',
    					'restaurant_branch_id',
                        'order_type',
                        'cancel_order',
                        'cancel_time',
                        'add_extra',                         
    					'created_by',
    					'created_date',
    					'updated_by',
    					'updated_date',
    					'is_active',
    					'ip_address'
    					];
}