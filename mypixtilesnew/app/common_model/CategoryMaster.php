<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class CategoryMaster extends Model
{
    protected $table='category_master';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
    					'lang_id',
    					'category_name',
                        'category_description',                      
    					'created_by',
    					'created_date',
    					'updated_by',
    					'updated_date',
    					'is_active',
    					'ip_address'
    					];
}