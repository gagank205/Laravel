<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryManagementForm extends FormRequest
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
            'name'=>"required|max:60|unique:product_subcategory,name,".$this->id,
            'category_id'=>'required'
            ];    
        }else{
            return [
            'name'=>'required|max:60|unique:product_subcategory',
            'category_id'=>'required'

            ];    
        }
    }
     public function messages(){
        return [
            'name.required'=>'Please enter sub-category name',
            'name.unique'=>'Sub-category already exist',
            'name.max'=>'The sub-category name may not be greater than 60 characters',
            'category_id.required'=>'Please select category'
        ];
    }
}