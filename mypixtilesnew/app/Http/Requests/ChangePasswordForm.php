<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ChangePasswordForm extends FormRequest
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
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if(!\Hash::check($value, Auth::User()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'password' => 'required|different:current_password',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(){
        return [
            'current_password.required' => 'Please enter current password',
            'password.required' => 'Please enter new password',
            'password.different' => 'New password should different from current password',
            'password_confirmation.required' => 'Please enter confirm password',
            'password_confirmation.same' => 'New password and confirm new password must be same'   
        ];
    }
}
