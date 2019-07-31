<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SiteConfigurationForm extends FormRequest
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
            'config_value'=>"required",
            ];    
        }else{
            return [
            'config_key'=>'required|max:60|unique:site_configuration',
            'config_value'=>"required",
            ];    
        }
        
    }
    
    public function messages(){
        return [
            'config_key.required'=>'Please enter confing key',
            'config_key.max'=>'The confing key may not be greater than 60 characters',        
            'config_key.unique'=>'Config key already exist',
            'config_value.required'=>'Please enter confing value',
        ];
    }
}
