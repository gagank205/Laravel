<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class GreetingManagementForm extends FormRequest
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
            'like_count'=>"required|max:60",
            'dis_like_count'=>"required|max:60",
            //'emoji_id'=>"required|max:60",

            ];    
        }else{
            return [
            'like_count'=>'required|max:60',
            'dis_like_count'=>'required|max:60',
            //'emoji_id'=>'required|max:60'
            ];    
        }
        
    }
    
    public function messages(){
        return [
            'like_count.required'=>'Please enter link count',
            'like_count.max'=>'The link count may not be greater than 60 characters',
            'dis_like_count.required'=>'Please enter dislink count',
            'dis_like_count.max'=>'The dislike count may not be greater than 60 characters',
            //'emoji_id.required'=>'Please select any one emoji image',
            //'emoji_id.max'=>'The emoji count may not be greater than 60 characters',
        ];
    }
}
