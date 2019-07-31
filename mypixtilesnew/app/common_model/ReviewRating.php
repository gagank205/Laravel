<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    protected $table='review_rating';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
    					'restaurant_branch_id',
    					'from_user_id',
                        'star',
                        'comments',                        
    					'created_by',
    					'created_date',
    					'updated_by',
    					'updated_date',
    					'is_active',
    					'ip_address'
    					];
}