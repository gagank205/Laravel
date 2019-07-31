<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class EmojiImagesForm extends FormRequest
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
        return [
        'emoji_id'=>'required',
        ];
    }
    
    public function messages(){
        return [
            'emoji_id.required'=>'Please select emoji',
        ];
    }
}
