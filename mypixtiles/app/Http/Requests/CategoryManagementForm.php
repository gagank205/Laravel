<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CategoryManagementForm extends FormRequest
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
            'name'=>"required|max:60|unique:product_category,name,".$this->id
            ];    
        }else{
            return [
            'name'=>'required|max:60|unique:product_category'
            ];    
        }
        
    }
    
    public function messages(){
        return [
            'name.required'=>'Please enter product category name',
            'name.max'=>'The product category name may not be greater than 60 characters',        
            'name.unique'=>'Product category already exist'
        ];
    }
}
