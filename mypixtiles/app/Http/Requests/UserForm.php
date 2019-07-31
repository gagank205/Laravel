<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserForm extends FormRequest
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
                    'first_name'=>'required',
                    'last_name'=>'required',
                    'user_role'=>'required',
                    'contact_number'=>'required|numeric|min:10|unique:users,contact_number,'.$this->id,
                    'dob'=>'required|date',
                    'email'=>'required|email|unique:users,email,'.$this->id,
                   ];
        }else{
            return [
                    'first_name'=>'required',
                    'last_name'=>'required',
                    'user_role'=>'required',
                    'contact_number'=>'required|numeric|min:10|unique:users,contact_number',
                    'dob'=>'required|date',
                    'email'=>'required|email|unique:users,email',
                    'password'=>'required',
                   ];
        }
    }

    public function messages(){
        return[
                'first_name.required'=>'Please enter first name',
                'last_name.required'=>'Please enter last name',
                'user_role.required'=>'Please select user role ',
                'contact_number.required'=>'Please enter contact number',
                'dob.required'=>'Please enter date of birth',
                'email.required'=>'Please enter email',
                'email.email'=>'Please enter valid email address',
                'password.required'=>'Please enter password',
              ];
    }
}