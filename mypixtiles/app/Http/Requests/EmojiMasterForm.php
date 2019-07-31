<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class EmojiMasterForm extends FormRequest
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
            'emoji_id'=>"required|max:60|unique:emojis_master,emoji_id,".$this->id
            ];    
        }else{
            return [
            'emoji_id'=>'required|max:60|unique:emojis_master'
            ];    
        }
        
    }
    
    public function messages(){
        return [
            'emoji_id.required'=>'Please enter category emoji_id',
            'emoji_id.max'=>'The Category emoji_id may not be greater than 60 characters',        
            'emoji_id.unique'=>'Category already exist'
        ];
    }
}
