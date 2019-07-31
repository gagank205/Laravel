<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordForm;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

public function index(){
    return view('backend/changepassword/changepassword');
}

public function store(ChangePasswordForm $request){
    if($request->ajax()){
        return true;
    }
    $user_id = Auth::User()->id;
    $obj_user = User::find($user_id);
    $obj_user->password = Hash::make($request->password);
    $obj_user->save();
    Auth::logout();
    return redirect('/');
}

}
