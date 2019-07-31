<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class FeedbackManagement extends Model
{
    protected $table='feedback_management';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
    					'user_id',
    					'restaurant_branch_id',
                        'menu_id',
                        'feedback',
                        'email_id',                         
    					'created_by',
    					'created_date',
    					'updated_by',
    					'updated_date',
    					'is_active',
    					'ip_address'
    					];
}