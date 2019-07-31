<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantManagementForm extends FormRequest
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
                    'contact_number'=>'required|numeric|min:10|unique:users,contact_number,'.$this->id,
                    'dob'=>'required|date',
                    'email'=>'required|email|unique:users,email,'.$this->id,
                   ];
        }else{
            return [
                'lang_id'=>'required',
                'restaurant_branch_id'=>'required',
                'main_category_id'=>'required',
                'restaurant_category_id'=>'required',
                'restaurant_name_en'=>'required',
                'restaurant_description_en'=>'required',
                'restaurant_name_tr'=>'required',
                'restaurant_description_tr'=>'required',
                'restaurant_name_ru'=>'required',
                'restaurant_description_ru'=>'required',
                'restaurant_name_ar'=>'required',
                'restaurant_description_ar'=>'required',
                'restaurant_meals_en'=>'required',
                'restaurant_meals_tr'=>'required',
                'restaurant_meals_ru'=>'required',
                'restaurant_meals_ar'=>'required',
                'price'=>'required',
                'neighborhood'=>'required',
                'province'=>'required',
                'country_id'=>'required',    
                'country_code'=>'required',
                'state_id'=>'required',
                'city_id'=>'required',
                'website'=>'required',
                'email'=>'required',
                'phone_number'=>'required|numeric|min:10|unique:users,contact_number',
                'cuisine'=>'required',
                'special_diets'=>'required',
                'child_friendly'=>'required',
                'serves_alcohol'=>'required',
                'delivery'=>'required',
                'active_restaurant'=>'required',
            ];
        }
    }

    public function messages(){
        return[
                'lang_id.required'=>'Please select Language',
                'restaurant_branch_id.required'=>'Please select Restaurant Branch ',
                'main_category_id.required'=>'Please enter main Category',
                'restaurant_category_id.required'=>'Please enter Restaurant category',
                'restaurant_name_en.required'=>'Please enter Restaurant Name in English',
                'restaurant_description_en.required'=>'Please enter Restaurant Description',
                'restaurant_name_tr.required'=>'Please enter Restaurant Name in Turkish',
                'restaurant_description_tr.required'=>'Please enter Restaurant Description in Turkish',
                'restaurant_name_ru.required'=>'Please enter Restaurant Name in Russian',
                'restaurant_description_ru.required'=>'Please enter Restaurant Description in Rusian',
                'restaurant_name_ar.required'=>'Please enter Restaurant name in Ar',
                'restaurant_description_ar.required'=>'Please enter Restaurant Description in Ar',
                'restaurant_meals_en.required'=>'Please enter Restaurant Meals in English',
                'restaurant_meals_tr.required'=>'Please enter Restaurant Meals in English',
                'restaurant_meals_ru.required'=>'Please enter Restaurant Meals in English',
                'restaurant_meals_ar.required'=>'Please enter Restaurant Meals in English',
                'price.required'=>'Please enter Price',
                'neighborhood.required'=>'Please enter Neighurghood',
                'province.required'=>'Please enter Province',
                'country_id.required'=>'Please Choose Country Name',
                'country_code.required'=>'Please enter Country Code',
                'state_id.required'=>'Please Choose State Name',
                'city_id.required'=>'Please enter City Name',
                'website.required'=>'Please enter Website',
                'email.email'=>'Please enter valid email address',
                'phone_number.required'=>'Please enter Phone Nummber',
                'cuisine.required'=>'Please enter Cuisine',
                'special_diets.required'=>'Please enter Special Diets',
                'child_friendly.required'=>'Please enter childfriendly',
                'serves_alcohol.required'=>'Please Choose Oprtion Yes OR No',
                'delivery.required'=>'Please enter Delivery Status',
                'active_restaurant.required'=>'Please enter email',
              ];    
    }
}