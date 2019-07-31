<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class FaqManagementForm extends FormRequest
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
            'title'=>"required|unique:faq_management,title,".$this->id,
            'description'=>"required",
            ];    
        }else{
            return [
            'title'=>'required|unique:faq_management',
            'description'=>"required",
            ];    
        }
        
    }
    
    public function messages(){
        return [
            'title.required'=>'Please enter title',
            'title.unique'=>'Title already exist',
            'description.required'=>'Please enter description',
        ];
    }
}
