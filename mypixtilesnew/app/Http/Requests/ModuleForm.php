<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ModuleForm extends FormRequest
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
            return ['module_name'=>['required', function ($attribute, $value, $fail) {
                        $cotroller_path=dirname(dirname(__DIR__))."/Http/Controllers/Admin/";
                        $module_name=$cotroller_path.ucwords(str_replace(" ","",trim($value))).'Controller.php';
                            if(!file_exists($module_name)) {
                                return $fail(__('Module does not exist'));
                            }
                        },
                        'unique:module,module_name,'.$this->id],
                        'menu_name'=>'required|unique:module,menu_name,'.$this->id,
                        'action'=>'required',
                        'icon'=>'required'
                   ];
        }else{
            return [
             'module_name'=>['required', function ($attribute, $value, $fail) {
                $cotroller_path=dirname(dirname(__DIR__))."/Http/Controllers/Admin/";     
                $module_name=$cotroller_path.ucwords(str_replace(" ","",trim($value))).'Controller.php';
                    if(!file_exists($module_name)) {
                        return $fail(__('Module does not exist'));
                    }
                },
                'unique:module'],
                'menu_name'=>'required|unique:module',
                'action'=>'required',
                'icon'=>'required'
            ];
        }

    }

    public function messages(){
        return[
            'module_name.required'=>'Please enter module name',
            'module_name.unique'=>'Mmodule name already exist in our system',
            'action.required'=>'Please select at least one action',
            'icon.required'=>'Please enter module icon',
        ];
    }
}