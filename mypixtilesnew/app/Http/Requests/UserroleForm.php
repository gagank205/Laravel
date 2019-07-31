<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserroleForm extends FormRequest
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
            'name'=>"required|max:60|unique:userrole,name,".$this->id,
            'module'=>'required'
            ];    
        }else{
            return [
                'name'=>'required|max:60|unique:userrole,name',
                'module'=>'required'
            ];    
        }        
    }
    public function messages(){
        return[
            'name.required'=>'Please enter user role',
            'name.max'=>'The user role may not be greater than 60 characters.',
            'module.required'=>'Please select atleast any one module'
        ];
    }
}
