<?php

namespace App\common_model;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table='password_resets';
    protected $timestamp=false;  
    const UPDATED_AT = null;  
    protected $primaryKey = 'email';
    protected $fillable=[
    					 'email',
                         'token',
                         'created_at'                         
                        ];
    				


}