<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class FrameCart extends Model
{
    protected $table='frame_cart';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable = [
    						'customize_frame',
    						'user_id',
    						'image_type',
    						'status',
    						'date_time',
    						'ip_address'
    						];
}
