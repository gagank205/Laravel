<?php
namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class LanguageManagement extends Model
{
    protected $table='language_management';
    const CREATED_AT='created_date';
    const UPDATED_AT='updated_date';
    protected $fillable=[
    					'lanuage_name',
    					'lang_code',                             
    					'created_by',
    					'created_date',
    					'updated_by',
    					'updated_date',
    					'is_active',
    					'ip_address'
    					];
}