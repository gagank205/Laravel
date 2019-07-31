<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\FrameManagementForm;
use App\common_model\FrameManagement;
use App\common_model\CartManagement;
use App\common_model\ShippingManagement;
use App\common_model\BillingManagement;
use App\common_model\Country;
use App\User;
use DB;
use Klarna;

class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('web.index');
    }
    
    public function register()
    {
        return view('web.web-register');
    }
    public function login()
    {
        return view('web.web-login');
    }

    public function profile(Request $request)
    {   
        $value = $request->session()->all();
        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];   
        $user_data = DB::table('users')->select('*')->where(['id'=>$logged_in_user])->get()->first();
        return view('web.profile')->with('userdata',$user_data);
    }


    public function changePassword()
    {

        return view('web.change_password');
    }

    public function userUpdate(Request $request)
    {
        $value = $request->session()->all();
        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        if($request->hasfile('image'))
        {
            $username = $request->first_name;
            $image = $request->image->getClientOriginalExtension();
                            
            $new_image =  $username.'_'.date('m-d-y-h-i-s').'.'.$image;
                                            
            $request->image->move(public_path('media/userimage'), $new_image);

            $new = User::whereId(['id'=>$logged_in_user])->update([
                'first_name'     => $request->first_name,
                'last_name'      => $request->last_name,
                'email'          => $request->email,
                'dob'            => $request->dob,
                'image'          => $new_image,
                'user_role_id'   => '4',
                'contact_number' => $request->contact_number,
                'updated_date'   => date('Y-m-d H:i:s'),
                'is_active'      => 'Y',
                'ip_address'     => $request->ip()
            ]);
        
        }
        else
        {
            $new = User::whereId(['id'=>$logged_in_user])->update([
                'first_name'     => $request->first_name,
                'last_name'      => $request->last_name,
                'email'          => $request->email,
                'dob'            => $request->dob,
                'user_role_id'   => '4',
                'contact_number' => $request->contact_number,
                'updated_date'   => date('Y-m-d H:i:s'),
                'is_active'      => 'Y',
                'ip_address'     => $request->ip()
            ]);
        }
       
        
        if($new){
            return redirect('user-profile')->with('success', 'You are Details update successfully.');
        }else{
            return redirect('user-profile')->with('error','Something Error: In data save!');
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
    */
    public function save(Request $request)
    {
    
        request()->validate([
        'first_name'    => 'required',
        'email'         => 'required|email|unique:users',
        'contact_number' => 'required|unique:users|min:10|max:10',
        'password'      => 'required|confirmed|min:6',
        ]);
        
        $new = User::insert([
            'first_name'     => $request->first_name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'user_role_id'   => '4',
            'contact_number' => $request->contact_number,
            'created_date'   => date('Y-m-d H:i:s'),
            'updated_date'   => date('Y-m-d H:i:s'),
            'is_active'      => 'Y',
            'ip_address'     => $request->ip()
        ]);
        if($new){
            return redirect('webLogin')->with('success', 'You are successfully registered as a member.');
        }else{
            return redirect('webRegister')->with('error','Something Error: In data save!');
        }
    
    }
     
    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('user-home');
        }else{
            return redirect('webLogin')->with('error',"Email & password doesn't exits");
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        Session::flush();
        return redirect('/web');
    }
    public function show()
    {
        return view('web.index');
    }


    public function start()
    {
        return view('web.getstarted');
    }

    public function cutomizeFrame()
    {
        $value = $request->session()->all();
        
        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        if ($logged_in_user) {
            return view('web.review');    
        }else {
            return redirect('webLogin')->with('error', 'Session expaire.');
        }
    }
    public function data(Request $request)
    {
        $value = $request->session()->all();
     if(!empty($value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'])) {
        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        

        $cms = CartManagement::where(['user_id'=>$logged_in_user])->orderBy('id','asc')->get(); 
        $count_shipping = ShippingManagement::where(['user_id'=> $logged_in_user])->count(); 
        $count_billing = BillingManagement::where(['user_id'=> $logged_in_user])->count(); 

        if ($count_shipping > 0) {
            $count_shipping = 'true';
        }else{
            $count_shipping = 'false';
        }

        $billing = DB::table('billing_management as bm')->select('bm.*','country.name as country','city.name as city','state.name as state')
                                                ->leftJoin('country','country.id','bm.country')
                                                ->leftJoin('state','state.id','bm.state')
                                                ->leftJoin('city','city.id','bm.city')
                                                   ->where('bm.user_id',$logged_in_user)
                                                ->get()->first();  

        $Shipping = DB::table('shipping_management as sm')->select('sm.*','country.name as country','city.name as city','state.name as state')
                                                ->leftJoin('country','country.id','sm.country')
                                                ->leftJoin('state','state.id','sm.state')
                                                ->leftJoin('city','city.id','sm.city')
                                                ->where('sm.user_id',$logged_in_user)
                                                ->get()->first();
        $country = DB::table('country')->get(); 
        $state = DB::table('state')->get();
        $city = DB::table('city')->get();

        $cms_data = FrameManagement::where(['is_active'=>'Y'])->orderBy('id','asc')->get();
        if($cms_data){
            return view('web/review',['cms_data'=>$cms_data, 'cms'=>$cms, 'shipping'=>$Shipping, 'count_shipping' => $count_shipping, 'count_billing'=>$count_billing,'billing'=>$billing,'cityname'=>$city,'state'=>$state,'country'=>$country]);    
        }else{
            return redirect('web/review')->with('error','Something Error!');
        }
      } else {
          return redirect('/webLogin')->with('error','Please login first!');
      }
    }

    public function upload_image(Request $request)
    {
        $images_name = array();
        $value = $request->session()->all();
        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];


     //   $ip = Request::ip();
       
          if ($request->TotalImages > 0) {

        for($i=0; $i<count($request->images); $i++) {

             
            $imagesName = $request->images[$i]->getClientOriginalName();
            $images_name[] = $randonName =  rand(1, 200).'_'.$imagesName;

            $request->images[$i]->move(public_path('/media/cart'),$randonName);
            $upload = DB::table('frame_cart')->insert(['customize_frame'=>$randonName,
                                         'user_id'=>$logged_in_user,
                                         'frame_id'=>$request->farme_id,
                                         'date_time' => date('Y-m-d h:i:s')
                                        ]);
        } 
        
        
        return response()->json($images_name);
        return 1;
      }

        else{
            return "file illla";
        }  
    }

    public function removeCartItem(Request $request)
    {   
        if(isset($request->cart_id))
        {
            $cms_model=CartManagement::find($request->cart_id);
            if($cms_model){
            $cms_model->delete();
                return redirect('/review/data/')->with('success','Record has been deleted successfully');
            }else{
                return redirect('/review/data')->with('error','Something Error: In data save!');        
            }
        }else{
            return redirect('/review/data/')->with('error','Something Error: does not exits');
        }    
    }


 

    public function add_billing_details(Request $request)
    {
        // $value = $request->session()->all();
        // $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        request()->validate([
        'user_id'    => 'required',
        'fullname'    => 'required',
        'address'     => 'required',
        'city'        => 'required',
        'state'       => 'required',
        'country'     => 'required',
        'postal_code' => 'required',
        'mobile'      => 'required'
        ]);
        
        $data = BillingManagement::insert([
            'user_id'     => $request->user_id,
            'fullname'    => $request->fullname,
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'country'     => $request->country,
            'postal_code' => $request->postal_code,
            'mobile'      => $request->mobile
        ]);
        if($data){
            return redirect('review/data')->with('success', 'Billing details insert successfully.');
        }else{
            return redirect('review/data')->with('error','Billing details not insert.');
        }
    }



    public function add_shipping_details(Request $request)
    {
        // $value = $request->session()->all();
        // $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        request()->validate([
        'user_id'    => 'required',
        'fullname'    => 'required',
        'address'     => 'required',
        'city'        => 'required',
        'state'       => 'required',
        'country'     => 'required',
        'postal_code' => 'required',
        'mobile'      => 'required'
        ]);
        
        $data = ShippingManagement::insert([
            'user_id'     => $request->user_id,
            'fullname'    => $request->fullname,
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'country'     => $request->country,
            'postal_code' => $request->postal_code,
            'mobile'      => $request->mobile
        ]);
        if($data){
            return redirect('review/data')->with('success', 'Shipping details insert successfully.');
        }else{
            return redirect('review/data')->with('error','Shipping details not insert.');
        }
    }


    public function edit_shipping_details(Request $request)
    {
        $value = $request->session()->all();
        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        $user_shipping_detail = DB::table('shipping_management')->where('user_id',$logged_in_user)->get()->first();
         $user_billing_detail = DB::table('billing_management')->where('user_id',$logged_in_user)->get()->first();
        request()->validate([
             //'user_id'    => 'required',
             'shipping_fullname'    => 'required',
             'shipping_address'     => 'required',
             'shipping_city'        => 'required',
             'shipping_state'       => 'required',
             'shipping_country'     => 'required',
             'shipping_postal_code' => 'required',
             'shipping_mobile'      => 'required'
        ]);

         request()->validate([
                //'user_id'    => 'required',
                'booking_fullname'    => 'required',
                'booking_address'     => 'required',
                'booking_city'        => 'required',
                'booking_state'       => 'required',
                'booking_country'     => 'required',
                'booking_postal_code' => 'required',
                'booking_mobile'      => 'required'
            ]);

      if($request->shipping_fullname)
      {
            if(!empty($user_shipping_detail))
            {
                $data = ShippingManagement::where('user_id', $logged_in_user)
                 ->update([
                    'fullname'    => $request->shipping_fullname,
                    'address'     => $request->shipping_address,
                    'city'        => $request->shipping_city,
                    'state'       => $request->shipping_state,
                    'country'     => $request->shipping_country,
                    'postal_code' => $request->shipping_postal_code,
                    'mobile'      => $request->shipping_mobile
                ]);
            }
            else
            {
                $data = ShippingManagement::insert([
                'user_id'     => $logged_in_user,
                'fullname'    => $request->shipping_fullname,
                'address'     => $request->shipping_address,
                'city'        => $request->shipping_city,
                'state'       => $request->shipping_state,
                'country'     => $request->shipping_country,
                'postal_code' => $request->shipping_postal_code,
                'mobile'      => $request->shipping_mobile
                ]);
            }

        }

        if($request->booking_fullname)
        {
           
            if(!empty($user_billing_detail))
            {
                $data = BillingManagement::where('user_id', $logged_in_user)
                    ->update([
                        'fullname'    => $request->booking_fullname,
                        'address'     => $request->booking_address,
                        'city'        => $request->booking_city,
                        'state'       => $request->booking_state,
                        'country'     => $request->booking_country,
                        'postal_code' => $request->booking_postal_code,
                        'mobile'      => $request->booking_mobile
                    ]);
            }
            else
            {
                $data = BillingManagement::insert([
                    'user_id'     => $logged_in_user,
                    'fullname'    => $request->booking_fullname,
                    'address'     => $request->booking_address,
                    'city'        => $request->booking_city,
                    'state'       => $request->booking_state,
                    'country'     => $request->booking_country,
                    'postal_code' => $request->booking_postal_code,
                    'mobile'      => $request->booking_mobile
                ]);
            }
        }
        if($data){
            return redirect('address')->with('success', 'Shipping details update successfully.');
        }else{
            return redirect('address')->with('error','Shipping details not update.');
        }
    }

    public function edit_order_billing(Request $request)
    {
        if($request->fullname)
        {
            request()->validate([
                //'user_id'    => 'required',
                'fullname'    => 'required',
                'address'     => 'required',
                'city'        => 'required',
                'state'       => 'required',
                'country'     => 'required',
                'postal_code' => 'required',
                'mobile'      => 'required'
            ]);

            $data = BillingManagement::where('user_id', $request->user_id)
                    ->update([
                        'fullname'    => $request->fullname,
                        'address'     => $request->address,
                        'city'        => $request->city,
                        'state'       => $request->state,
                        'country'     => $request->country,
                        'postal_code' => $request->postal_code,
                        'mobile'      => $request->mobile
                    ]);
        }
        if($data){
                return redirect('review/data')->with('success', 'Billing details update successfully.');
            }else{
                return redirect('review/data')->with('error','Billing details not update.');
            } 
    }

    public function edit_order_shipping(Request $request)
    {
            request()->validate([
                //'user_id'    => 'required',
                'fullname'    => 'required',
                'address'     => 'required',
                'city'        => 'required',
                'state'       => 'required',
                'country'     => 'required',
                'postal_code' => 'required',
                'mobile'      => 'required'
            ]);

            $data = ShippingManagement::where('user_id', $request->user_id)
                    ->update([
                        'fullname'    => $request->fullname,
                        'address'     => $request->address,
                        'city'        => $request->city,
                        'state'       => $request->state,
                        'country'     => $request->country,
                        'postal_code' => $request->postal_code,
                        'mobile'      => $request->mobile
            ]);
        if($data){
                return redirect('review/data')->with('success', 'Shipping details update successfully.');
            }else{
                return redirect('review/data')->with('error','Shipping details not update.');
            } 
    }

     public function edit_booking_details(Request $request)
    {
        $value = $request->session()->all();
        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        $user_detail = DB::table('shipping_management')->where('user_id',$logged_in_user)->get()->first();

        if($request->shipping_fullname)
        {
            request()->validate([
                //'user_id'    => 'required',
                'fullname'    => 'required',
                'address'     => 'required',
                'city'        => 'required',
                'state'       => 'required',
                'country'     => 'required',
                'postal_code' => 'required',
                'mobile'      => 'required'
            ]);
            if(!empty($user_detail))
            {
                $data = ShippingManagement::where('user_id', $logged_in_user)
                    ->update([
                        'fullname'    => $request->shipping_fullname,
                        'address'     => $request->shipping_address,
                        'city'        => $request->shipping_city,
                        'state'       => $request->shipping_state,
                        'country'     => $request->shipping_country,
                        'postal_code' => $request->shipping_postal_code,
                        'mobile'      => $request->shipping_mobile
                    ]);
            }
            else
            {
                $data = ShippingManagement::insert([
                    'user_id'     => $logged_in_user,
                    'fullname'    => $request->shipping_fullname,
                    'address'     => $request->shipping_address,
                    'city'        => $request->shipping_city,
                    'state'       => $request->shipping_state,
                    'country'     => $request->shipping_country,
                    'postal_code' => $request->shipping_postal_code,
                    'mobile'      => $request->shipping_mobile
                ]);
            }
            if($data){
                return redirect('review/data')->with('success', 'Shipping details update successfully.');
            }else{
                return redirect('review/data')->with('error','Shipping details not update.');
            }
        }
        else{
            request()->validate([
                //'user_id'    => 'required',
                'fullname'    => 'required',
                'address'     => 'required',
                'city'        => 'required',
                'state'       => 'required',
                'country'     => 'required',
                'postal_code' => 'required',
                'mobile'      => 'required'
            ]);
            if(!empty($user_detail))
            {
                $data = ShippingManagement::where('user_id', $logged_in_user)
                    ->update([
                        'fullname'    => $request->booking_fullname,
                        'address'     => $request->booking_address,
                        'city'        => $request->booking_city,
                        'state'       => $request->booking_state,
                        'country'     => $request->booking_country,
                        'postal_code' => $request->booking_postal_code,
                        'mobile'      => $request->booking_mobile
                    ]);
            }
            else
            {
                $data = ShippingManagement::insert([
                    'user_id'     => $logged_in_user,
                    'fullname'    => $request->booking_fullname,
                    'address'     => $request->booking_address,
                    'city'        => $request->booking_city,
                    'state'       => $request->booking_state,
                    'country'     => $request->booking_country,
                    'postal_code' => $request->booking_postal_code,
                    'mobile'      => $request->booking_mobile
                ]);
            }
            if($data){
                return redirect('review/data')->with('success', 'Shipping details update successfully.');
            }else{
                return redirect('review/data')->with('error','Shipping details not update.');
            }
        }
    }

    public function facebookLogin(Request $request)
    {
        $value = $request->session()->all();

        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];   
        $data = CartManagement::insert([
            'user_id'         => $logged_in_user,
            'frame_id'        =>$request->frame_id,
            'image_type'      => $request->image_type,
            'customize_frame' => $request->fb_image,
            'ip_address'      => $request->ip()
        ]);
        
        if($data){
            return redirect('review/data')->with('success', 'Cart add successfully.');
        }else{
            return redirect('review/data')->with('error','Cart not Add.');
        }
    }

    public function address(Request $request)
    {
        $value = $request->session()->all();
        $coun = $country = DB::table('country')->select('*')->get();
        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        $shipping = DB::table('shipping_management')->where('user_id',$logged_in_user)->get()->first();
        $billing = DB::table('billing_management')->where('user_id',$logged_in_user)->get()->first();

        if(empty($billing) && empty($shipping))
        {
            return view('web.address')->with('country',$country)->with('coun',$coun);
        }   
        else
        {
            $billing_state = DB::table('state')->where(['country_id'=>$billing->country])->get()->toArray();
            $shipping_state = DB::table('state')->where('country_id',$shipping->country)->get()->toArray();
            $billing_city = DB::table('city')->where('state_id',$billing->state)->get()->toArray();
            $shipping_city = DB::table('city')->where('state_id',$shipping->state)->get()->toArray();
            return view('web.address')->with('country',$country)->with('coun',$coun)
                                                            ->with('shipping',$shipping)
                                                            ->with('billing',$billing)
                                                            ->with('billing_state',$billing_state)
                                                            ->with('shipping_state',$shipping_state)
                                                            ->with('billing_city',$billing_city)
                                                            ->with('shipping_city',$shipping_city);
        }
    }

    public function state(Request $request)
    {
        $html = "<option value=''>Select State</option>";
        if(!empty($request->country_id))
        {
            $state = DB::table('state')->where('country_id',$request->country_id)->get()->toArray();
            
            foreach($state as $st)
            {
                   $html .= "<option value='".$st->id."'>".$st->name."</option>";
            }

          echo $html;

        }
    }

    public function city(Request $request)
    {
        $html ="<option value=''>Select City</option>";

        if(!empty($request->state_id))
        {
            $city = DB::table('city')->where('state_id',$request->state_id)->get()->toArray();
            
            foreach($city as $ci)
            {
                $html .= "<option value='".$ci->id."'>".$ci->name."</option>";
            }
        
            echo $html;

        }
    }

    public function order_details(Request $request)
    {
        $value = $request->session()->all();
        $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];

        $order_details = DB::table('fream_order')->select("fream_order.*",'users.*')
                                ->leftJoin('users','users.id','fream_order.user_id')
                                ->where('fream_order.user_id',$logged_in_user)
                                ->paginate(10);

        return view('web.order_details')->with('order_details',$order_details); 
    }

    public function detail(Request $request)
    {
        $order_id = $request->order_id;

      $details_order = DB::table('fream_order as fo')->select('fo.*','users.*')
                                                    ->leftJoin('users','users.id','fo.user_id','coupon_management.name')
                                                    ->leftJoin('coupon_management','coupon_management.id','fo.promocode_id')
                                                    ->where('fo.order_id',$order_id)
                                                    ->first(); 

       $order_details_array =  DB::table('frame_order_details as fod','fream_order')
                                ->select("fod.*",'users.*','fream_order.*','frame_management.*')
                                ->leftJoin('users','users.id','fod.user_id')
                                ->leftJoin('fream_order','fream_order.order_id','fod.order_id')
                                ->leftJoin('frame_management','fod.frame_id','frame_management.id')
                                ->where('fod.order_id',$order_id)->get()->toArray();



        return view('web.single_order_details')->with('order_details_array',$order_details_array)
                                                ->with('details_order',$details_order);

    }



    public function order_invoice(Request $request)
    {
        $order_id = $request->order_id;

      $details_order = DB::table('fream_order as fo')->select('fo.*','users.*')
                                                    ->leftJoin('users','users.id','fo.user_id')
                                                    ->where('fo.order_id',$order_id)
                                                    ->first();

       $order_details_array = DB::table('frame_order_details as fod','fream_order')
                                ->select("fod.*",'users.*','fream_order.*','frame_management.*')
                                ->leftJoin('users','users.id','fod.user_id')
                                ->leftJoin('fream_order','fream_order.order_id','fod.order_id')
                                ->leftJoin('frame_management','fod.frame_id','frame_management.id')
                                ->where('fod.order_id',$order_id)->get()->toArray();

        return view('web.invoice')->with('order_details_array',$order_details_array)
                                                ->with('details_order',$details_order);
    }

    public function add_order_cod(Request $request)
    {
        $request->user_id;
        $request->cod;	
		

         $biiling = DB::table('billing_management as bm')->select('bm.*','state.name as state_name','city.name as city_name','country.name as country_name')
                                    ->leftJoin('country','country.id','bm.country')
                                    ->leftJoin('state','state.id','bm.state')
                                    ->leftJoin('city','city.id','bm.city')
                                    ->where('bm.user_id',$request->user_id)
                                    ->get()->first();

        $shipping = DB::table('shipping_management as sm')->select('sm.*','state.name as state_name','city.name as city_name','country.name as country_name')
                                    ->leftJoin('country','country.id','sm.country')
                                    ->leftJoin('state','state.id','sm.state')
                                    ->leftJoin('city','city.id','sm.city')->where('sm.user_id',$request->user_id)->get()->first();

      if(empty($biiling) || empty($shipping)) {

          return redirect('address')->with('error','First you need to fill billing and shipping adderss');

        } else {                              
             
                $frame_cart = DB::table('frame_cart')->where('user_id',$request->user_id)->get()->toArray();
              if(!empty($frame_cart)){

                if($request->cod == 'cod') {
               
                $biling = serialize($biiling);
                $shiping = serialize($shipping);
                $frame_total = 0;
                foreach($frame_cart as $frame)
                {
                    $frame_det = DB::table('frame_management')->where('id',$frame->frame_id)->get()->first();
                   $frame_price = $frame_det->price;
                   $frame_total += $frame_price;
                } 
                if(session()->get('promocode'))
                {
                    if(session()->get('discount_type') == "PERCENTAGE")
                    {
                        $discount = session()->get('discount');
                        $discount_price = ($frame_total*$discount)/100;
                        $final_total = $frame_total-$discount_price;
                    }

                    if(session()->get('discount_type') == "FLAT")
                    {
                        $discount = session()->get('discount');
                        $final_total = $frame_total-$discount;
                    }

                    $latest_order = DB::table('fream_order')->insertGetId([
                        'user_id'     => $request->user_id,
                        'total_amount' => $final_total,
                        'orignal_price' => $frame_total,
                        'add_promocode' => session()->get('promocode'),
                        'promocode_id'  => session()->get('coupon_id'),
                        'promocode_discount' => session()->get('discount'),
                        'promocode_discount_type' => session()->get('discount_type'),
                        'shipping_details' => $shiping,
                        'billing_details' => $biling,
                        'created_at' => date('Y-m-d h:i:s'),
                    ]); 

                    $request->session()->forget('promocode');
                    $request->session()->forget('discount_type');
                    $request->session()->forget('discount');
                    $request->session()->forget('coupon_id');

                }
                else
                {
                    $latest_order = DB::table('fream_order')->insertGetId([
                                'user_id'     => $request->user_id,
                                'total_amount' => $frame_total,
                                'orignal_price' => $frame_total,
                                'shipping_details' => $shiping,
                                'billing_details' => $biling,
                                'created_at' => date('Y-m-d h:i:s'),
                        ]);

                }

               foreach($frame_cart as $frame_id)
               {
                   $frame_details = DB::table('frame_management')->where('id',$frame_id->frame_id)->get()->first();

                   $order_details = DB::table('frame_order_details')->insert([
                                                                'user_id' => $request->user_id,
                                                                'image_type' => $frame_id->image_type,
                                                                'order_id'=> $latest_order,
                                                                'frame_id'=> $frame_id->frame_id,
                                                                'customize_frame' => $frame_id->customize_frame,
                                                                'user_id'=> $request->user_id,
                                                                'amount' => $frame_details->price,
                                                             ]);
                   
                    $delete = DB::table('frame_cart')->delete($frame_id->id);
                       
               }
               return redirect('review/data')->with('success', 'Order has been created successfully.');
               }
			   elseif($request->cod == 'klarna'){
			       $uid = $request->user_id;
			       return redirect()->route('klarna-payment', ['uid' => $uid]);
			   }
			   else {
        return redirect('review/data')->with('error','Please select the payment method.');
       }
         }
            else
            {
                return redirect('review/data')->with('error','Please first you need to upload a photo.');
            }
        } 
    }
	
	public function klarnapayment($uid,Request $request)
    {
		 return view('web.klarnapay',['uid'=>$uid]);
	}
	
	  public function klarnaPayorder($uid,Request $request)
    {
        
		 $biiling = DB::table('billing_management as bm')->select('bm.*','state.name as state_name','city.name as city_name','country.name as country_name')
                                    ->leftJoin('country','country.id','bm.country')
                                    ->leftJoin('state','state.id','bm.state')
                                    ->leftJoin('city','city.id','bm.city')
                                    ->where('bm.user_id',$uid)
                                    ->get()->first();

        $shipping = DB::table('shipping_management as sm')->select('sm.*','state.name as state_name','city.name as city_name','country.name as country_name')
                                    ->leftJoin('country','country.id','sm.country')
                                    ->leftJoin('state','state.id','sm.state')
                                    ->leftJoin('city','city.id','sm.city')->where('sm.user_id',$uid)->get()->first();

        $frame_cart = DB::table('frame_cart')->select('frame_cart.*','frame_management.title as product_name','frame_management.price')
        									 ->leftJoin('frame_management','frame_management.id','frame_cart.frame_id')
        									 ->where('user_id',$uid)->get()->toArray();   
      	$biling = serialize($biiling);
        $shiping = serialize($shipping);          
                                    
		$merchantId = 'PN01112_cc2b00e69823';
		$sharedSecret = '7YCy40SjS2lgA9ps';
		/*
		EU_BASE_URL = 'https://api.klarna.com'
		EU_TEST_BASE_URL = 'https://api.playground.klarna.com'
		NA_BASE_URL = 'https://api-na.klarna.com'
		NA_TEST_BASE_URL = 'https://api-na.playground.klarna.com'
		*/
		$apiEndpoint = Klarna\Rest\Transport\ConnectorInterface::NA_TEST_BASE_URL;
		$connector = Klarna\Rest\Transport\GuzzleConnector::create(
			$merchantId,
			$sharedSecret,
			$apiEndpoint
		);

	$frame_total = 0;
	foreach($frame_cart as $frame)
        {
            $frame_det = DB::table('frame_management')->where('id',$frame->frame_id)->get()->first();
            $frame_price = $frame_det->price;
            $frame_total += $frame_price;
        } 


	$order_lines = array();
	foreach ($frame_cart as $order_line) {

  	$order_lines[] =[
                "type"=> "physical",
                "reference"=> 123050,
                "name"=> $order_line->product_name,
                "quantity"=> 1,
                "quantity_unit"=> "pcs",
                "unit_price"=> $order_line->price,
                "tax_rate"=> 0,
                "total_amount"=> $order_line->price,
                "total_discount_amount"=> 0,
                "total_tax_amount"=> 0,
                "image_url"=> "http://merchant.com/logo.png"
              ];
         }
   
		$order = [
            "purchase_country" => "US",
            "purchase_currency" => "USD",
            "locale" => "en-US",
            "billing_address" => [
              "given_name" => $biiling->fullname,
              "family_name"=>  $biiling->fullname,
              "email"=> User::find(1)->email,
              "street_address"=> $biiling->address,
              "postal_code"=> $biiling->postal_code,
              "city"=> $biiling->city_name,
              "region"=> $biiling->state_name,
              "phone"=> $biiling->mobile,
              "country"=> $biiling->country_name,
            ],
            "order_amount"=> $frame_total,
            "order_tax_amount"=> 0,

             "order_lines"=>$order_lines,
            "merchant_urls"=> [
              "terms"=> "https://smtgroup.in/tac.php",
              "checkout"=> "https://smtgroup.in/checkout.php?sid={checkout.order.id}",
              "confirmation"=> "https://smtgroup.in/mypixtilesupdated/public/thankyou?sid={checkout.order.id}",
              "push"=> "https://smtgroup.in/push.php?sid={checkout.order.id}"
              //"push"=> "http://localhost/kco/push.php?sid={checkout.order.id}"
            ],
            "shipping_options"=> [
              [
                "id"=> "free_shipping",
                "name"=> "Free Shipping",
                "description"=> "Delivers in 5-7 days",
                "price"=> 0,
                "tax_amount"=> 0,
                "tax_rate"=> 0,
                "preselected"=> true,
                "shipping_method"=> "Home"
              ],
              [
                "id"=> "pick_up_store",
                "name"=> "Pick up at closest store",
                "price"=> 399,
                "tax_amount"=> 0,
                "tax_rate"=> 0,
                "preselected"=> false,
                "shipping_method"=> "PickUpStore"
              ]
            ]
        ];
            
		try {
			$checkout = new Klarna\Rest\Checkout\Order($connector);
			$checkout->create($order);
			// Store checkout order id
			$final_total = 0; 
			$orderId = $checkout->getId();
			$order_status = $checkout['status'];
            $add_promocode = $coupon_id = $discount_coupon = $discount_type ='';
 
			  if(session()->get('promocode'))
                {
                	 $add_promocode = session()->get('promocode');
                	 $coupon_id = session()->get('coupon_id');
                	 $discount_coupon = session()->get('discount');
                	 $discount_type = session()->get('discount_type');

                    if(session()->get('discount_type') == "PERCENTAGE")
                    {
                        $discount = session()->get('discount');
                        $discount_price = ($frame_total*$discount)/100;
                        $final_total = $frame_total-$discount_price;
                    }

                    if(session()->get('discount_type') == "FLAT")
                    {
                        $discount = session()->get('discount');
                        $final_total = $frame_total-$discount;
                    }

                     $latest_order = DB::table('fream_order')->insertGetId([
                        'user_id'     => $uid,
                        'total_amount' => $final_total,
                        'orignal_price' => $frame_total,
                        'add_promocode' => $add_promocode,
                        'promocode_id'  => $coupon_id,
                        'promocode_discount' => $discount_coupon,
                        'promocode_discount_type' => $discount_type,
                        'klarna_order_id' => $orderId,
                        'klarna_payment_status' => $order_status,
                        'shipping_details' => $shiping,
                        'billing_details' => $biling,
                        'created_at' => date('Y-m-d h:i:s'),
                    ]); 

                    $request->session()->forget('promocode');
                    $request->session()->forget('discount_type');
                    $request->session()->forget('discount');
                    $request->session()->forget('coupon_id');                  

                }
                else
                {
                    $latest_order = DB::table('fream_order')->insertGetId([
                                'user_id'     => $uid,
                                'total_amount' => $frame_total,
                                'orignal_price' => $frame_total,
                                'shipping_details' => $shiping,
                                'klarna_order_id' => $orderId,
                        		'klarna_payment_status' => $order_status,
                                'billing_details' => $biling,
                                'created_at' => date('Y-m-d h:i:s'),
                        ]);

                }
                 
               foreach($frame_cart as $frame_id)
               {
                   $frame_details = DB::table('frame_management')->where('id',$frame_id->frame_id)->get()->first();
                   $frame_price = $frame_details->price;
                   $order_details = DB::table('frame_order_details')->insert([
                                                            'user_id' => $uid,
                                                            'image_type' => $frame_id->image_type,
                                                            'order_id'=> $latest_order,
                                                            'frame_id'=> $frame_id->frame_id,
                                                            'customize_frame' => $frame_id->customize_frame,
                                                            'amount' => $frame_price
                                                        ]);
                   
                    $delete = DB::table('frame_cart')->delete($frame_id->id);
                       
               }

			echo $checkout['html_snippet'];
             exit;
					
		} catch (Exception $e) {
			echo 'Caught exception: ' . $e->getMessage() . "\n";
		}
		
	}

	public function thakyou(Request $request)
	{

		$klarna_order_id = Input::get('karna_id');

		$merchantId = 'PN01112_cc2b00e69823';
		$sharedSecret = '7YCy40SjS2lgA9ps';
		$orderId = $klarna_order_id;

		$apiEndpoint = Klarna\Rest\Transport\ConnectorInterface::NA_TEST_BASE_URL;
		$connector = Klarna\Rest\Transport\GuzzleConnector::create(
    		$merchantId,
    		$sharedSecret,
    		$apiEndpoint
		);
		try {
    			$checkout = new Klarna\Rest\Checkout\Order($connector, $orderId);
    			$checkout->fetch();
  
         		$OrderID = $checkout['order_id'];

    			$Order_status =  $checkout['status'];

    			DB::table('fream_order')->where('klarna_order_id',$OrderID)
    									->update(['klarna_payment_status'=>$Order_status]);

    // 			HTML snippet: $checkout[html_snippet]
				// ORDER;
			} catch (Exception $e) {
    			echo 'Caught exception: ' . $e->getMessage() . "\n";
			}
		
	}

    public function add_order_promo(Request $request)
    {
        if(!empty($request->promocode))
        {
            $now_date = date('Y-m-d');
            $coupon = DB::table('coupon_management')->select('*')
                                          ->where('coupon_code',$request->promocode)
                                          ->get()
                                          ->first();
            if(!empty($coupon))
            {   
                if($coupon->end_date > $now_date)
                {
                    Session::put('promocode',$coupon->coupon_code);
                    Session::put('discount_type',$coupon->discount_type);
                    Session::put('discount',$coupon->discount);
                    Session::put('coupon_id',$coupon->id);
                    return redirect('review/data')->with('success', 'promocode has been add successfully.');
                }
                else
                {
                    return redirect('review/data')->with('error','this promocode has been Expired');
                }
            }
            elseif ($request->remove) {

            }
            else
            {
                return redirect('review/data')->with('error',"Invalid code");  
            }
        }   
       
    }

    public function remove_code(Request $request)
    {
        $request->session()->forget('promocode');
        $request->session()->forget('discount_type');
        $request->session()->forget('discount');
        $request->session()->forget('coupon_id');

        return redirect('review/data')->with('success', 'promocode remove successfully.');
        
    }


}
