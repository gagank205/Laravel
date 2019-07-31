<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class FrameOrder extends Model
{
    protected $table='fream_order';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable = [
    						'order_id',
    						'user_id',
    						'frame_id',
    						'total_amount',
    						'satatus',
    						'shipping_details',
    						'billing_details',
    						'created_at',
    						'updated_at'
    						];
}