<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponManagementForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if($this->method()=='PATCH'){

            return [
            'coupon_code'   => "required|max:10|unique:coupon_management,coupon_code,".$this->id,
            'coupon_name'   => 'required',
            'coupon_description'=>'required',
            'discount_type' => 'required',
            'discount'      => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
            ];    
        }else{
            return [
            'coupon_code'   => 'required|max:10|unique:coupon_management',
            'coupon_name'   => 'required',
            'coupon_description'=>'required',
            'discount_type' => 'required',
            'discount'      => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
            ];
        }
    }
    public function messages(){
        return [
            'coupon_code.required'      => 'Please enter coupon code',
            'coupon_code.unique'        => 'Title already exist',
            'coupon_code.max'           => 'The coupon code may not be greater than 10 characters',
            'coupon_description.required'=>'Please enter description',
            'discount_type.required'    => 'Please enter discount type',
            'discount.required'         => 'Please enter discount',
            'start_date.required'       => 'Please enter start date',
            'end_date.required'         => 'Please enter end date',
        ];
    }
}
