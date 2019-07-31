<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrameManagementForm extends FormRequest
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
            'title'=>"required|max:60|unique:frame_management,title,".$this->id,
            'description'=>'required',
            ];    
        }else{
            return [
            'title'=>'required|max:60|unique:frame_management',
            'description'=>'required',
            ];
        }
    }
    public function messages(){
        return [
            'title.required'=>'Please enter title name',
            'title.unique'=>'Title already exist',
            'title.max'=>'The title name may not be greater than 60 characters',
            'description.required'=>'Please enter description',
        ];
    }
}
