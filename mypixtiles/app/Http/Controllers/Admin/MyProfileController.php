<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MyProfileForm;
use App\Http\Requests\ChangePasswordForm;
use App\Http\Controllers\Controller;
use App\common_model\User;
use Illuminate\Support\Facades\Validator;
use App\common_model\Userrole;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class MyProfileController extends Controller
{

public function index(){
    return view('backend/my_profile/index');
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = Auth()->user()->id;
        $user=User::where(['id'=>$id])->first();
        $userrole=Userrole::select('id','name')->get();
        if($user){
            return view('backend.my_profile.edit_form',['user'=>$user,'userrole'=>$userrole]);
        }else{
            return redirect('/')->with('error','Something Error: In data fetch!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MyProfileForm $request, $id)
    {
        if($request->ajax()){
            return true;
        }
        $user_model=User::where(['id'=>$id])->first();
        if(isset($_FILES['file']['name']) && ($_FILES['file']['name'])!=''){
            $ext=explode('/',request()->file->getMimeType());
            $imageName = date('YmdHis').'_'.rand(111,999).".".$ext[1];            
        }else{
            $imageName=$user_model->image;
        }
        
        if($user_model){
        $user_model->user_role_id=$request->user_role;
        $user_model->first_name=$request->first_name;
        $user_model->last_name=$request->last_name;
        $user_model->contact_number=$request->contact_number;
        $user_model->dob=date('Y-m-d', strtotime($request->dob));
        $user_model->email=$request->email;        
        $user_model->image=$imageName;
        $user_model->remember_token='';
        $user_model->password_reset_token='';
        $user_model->auth_key='';
        $user_model->is_active='Y';
        $user_model->approved_member='Y';
        $user_model->ip_address=$request->ip();
        $user_model->updated_by=auth()->user()->id;
        $user_model->updated_date=date('Y-m-d H:i:s');
        //dd($user_model);
            if($user_model->save()){
                if(isset($_FILES['file']['name']) && ($_FILES['file']['name'])!=''){
                    request()->file->move(public_path('media/userimage'), $imageName);
                }
                return redirect('dashboard')->with('success','User has been updated successfully');
            }else{
                return redirect('dashboard')->with('error','Something Error: In data save!');
            }
        }else{
            return redirect('dashboard')->with('error','Something Error: In data fetch!');
        }
    }

}
