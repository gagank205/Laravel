<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class MyProfileForm extends FormRequest
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
                    'user_role'=>'required',
                    /*'first_name'=>'required|max:60',
                    'last_name'=>'required|max:60',*/
                    'contact_number'=>'required|numeric|min:10',
                    'dob'=>'required|date',
                    'email'=>'required|email|unique:users,email,'.$this->id,
                    // 'password'=>'required',
                    // 'image'=>'required',
                    // 'is_admin'=>'required'
                   ];
        }else{
            return [
                    'user_role'=>'required',
                    /*'first_name'=>'required|max:60',
                    'last_name'=>'required|max:60',*/
                    'contact_number'=>'required|numeric|min:10',
                    'user_role'=>'required',
                    'dob'=>'required|date',
                    'email'=>'required|email|unique:users,email',
                    'password'=>'required',
                    /*'file'=>[function ($attribute, $value, $fail) { 
                        if(!$attribute){
                          return $fail(__('Please select file'));
                        }
                    }],*/
                    //'image' => 'required|mimes:jpeg,jpg,png',
                    // 'is_admin'=>'required'
                   ];
        }
    }

    public function messages(){
        return[
                'user_role.required'=>'Please select user role ',
                /*'first_name.required'=>'Please enter first name',
                'last_name.required'=>'Please enter last name',*/
                'contact_number.required'=>'Please enter contact number',
                'email.required'=>'Please enter email',
                'email.email'=>'Please enter valid email address',
                'password'=>'Please enter password',
              ];
    }
}