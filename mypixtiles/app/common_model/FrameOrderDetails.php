<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class FrameOrderDetails extends Model
{
    protected $table='frame_order_details';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable = [
    						'order_detail_id',
    						'order_id',
    						'customize_frame',
    						'user_id',
    						];
}