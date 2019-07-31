<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\common_model\User;
use App\Http\Requests\UserForm;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use App\common_model\Userrole;
use App\common_model\BlockUser;
use Auth;
use Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('backend.user.index');
    }
    
    //list data
    public function data(Request $request){
        if(isset($request->filter_data) ){
            if($request->filter_role){
                $user = User::
                            where(['is_active'=>$request->filter_data,'user_role_id'=>$request->filter_role,'is_admin'=>env('NOT_DELETED')])
                            ->where('users.id','!=',Auth::user()->id)
                            ->orderBy('users.id','desc')
                            ->get();    
            }
            else{
                $user = User::
                            where(['is_active'=>$request->filter_data,'is_admin'=>env('NOT_DELETED')])
                            ->where('users.id','!=',Auth::user()->id)
                            ->orderBy('users.id','desc')
                            ->get();
            }
        }else{
            if($request->filter_role){
                $user = User::
                            where(['is_admin'=>env('NOT_DELETED'),'user_role_id'=>$request->filter_role])
                            ->where('users.id','!=',Auth::user()->id)
                            ->orderBy('users.id','desc')
                            ->get();
            }
            else{
                $user = User::
                            where(['is_admin'=>env('NOT_DELETED')])
                            ->where('users.id','!=',Auth::user()->id)
                            ->orderBy('users.id','desc')
                            ->get();
            }
        }        
        
        return Datatables::of($user)
                ->addColumn('action', function ($user){
                if($user->is_active=='Y'){
                    $class='glyphicon-remove-circle';
                }else{
                    $class='glyphicon-ok-circle';
                }

                if($user->is_active=='Y'){
                    $status_title = 'Inactive';
                }else{
                    $status_title = 'Active';
                }

                return '
                <a href="'.url('user/edit',$user->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"title="Edit"><i class="la la-edit"></i></a>
                
                <a href="'.url('user/status',$user->id).'" id="is_active" data-status="'.$user->is_active.'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

                <a href="" id="data_show" data-url="'.url('user/show',$user->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" 
                    data-public_path="'.url('media/userimage').'" data-toggle="modal" data-target="#m_typeahead_modal" title="View">
                    <i class="flaticon-eye"></i></a>

                <a href="'.url('user/delete',$user->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';              

                })
                ->addColumn('status',function($user){

                    if($user->is_active=='Y'){
                        return '<span style="width: 110px;"><span class="m-badge  m-badge--success m-badge--wide">Active</span></span>';
                    }else{
                        return '<span style="width: 110px;"><span class="m-badge  m-badge  m-badge--danger m-badge--wide">Inactive</span></span>';
                    }
                })->rawColumns(['status', 'action'])
                ->make(true);
    }
    /**/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $userrole=Userrole::select('id','name')->where(['is_active'=>env('ACTIVE')])->get();
        return view('backend.user.create_form',['userrole'=>$userrole]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserForm $request){
        if($request->ajax()){
            return true;
        }
        if(isset(request()->image)){

            $new_name = time()."_".rand(1, 999).".".request()->image->getClientOriginalExtension();
            /*$ext=explode('/',request()->file->getMimeType());
            $imageName = date('YmdHis').'_'.rand(111,999).".".$ext[1]; */
        }else{
            $new_name='';
        }
        $user_model=new User();
        $user_model->user_role_id=$request->user_role;
        $user_model->first_name=$request->first_name;
        $user_model->last_name=$request->last_name;
        $user_model->contact_number=$request->contact_number;
        $user_model->dob=date('Y-m-d', strtotime($request->dob));
        $user_model->email=$request->email;
        $user_model->password=Hash::make($request->password);
        $user_model->image=$new_name;
        $user_model->is_admin='N';
        $user_model->email_verified_at=date('Y-m-d H:i:s');
        $user_model->remember_token='';
        $user_model->password_reset_token='';
        $user_model->auth_key='';
        $user_model->is_active='Y';
        $user_model->approved_member='Y';
        $user_model->ip_address=$request->ip();
        $user_model->created_by=auth()->user()->id;
        $user_model->created_date=date('Y-m-d H:i:s');
        $user_model->updated_by=auth()->user()->id;
        $user_model->updated_date=date('Y-m-d H:i:s');

        if($user_model->save()){
            // Upload image path
            $destinationPath = public_path('media/userimage');
            if(!file_exists($destinationPath)){
                File::makeDirectory($destinationPath, $mode = 0777, true, true);
            }
            if(isset(request()->image) && request()->image!=null){
                request()->image->move($destinationPath, $new_name);        
            }
            /*if(isset(request()->file)){
                request()->file->move(public_path('media/userimage'), $imageName);        
            }*/
            return redirect('user/index')->with('success','User has been added successfully');
        }else{
            return redirect('user/index')->with('error','Something Error: In data save!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $user=User::where(['id'=>$id])->first();
        $userrole=Userrole::select('id','name')->where(['id'=>$user->user_role_id,])->first();
        if($user){
            return Response::json(['user'=>$user,'userrole'=>$userrole]);
            //return view('backend.user.view',['user'=>$user,'userrole'=>$userrole]);
        }else{
            return redirect('user/index')->with('error','Something Error: In data fetch!');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $user=User::where(['id'=>$id])->first();
        $userrole=Userrole::select('id','name')->where([])->get();
        if($user){
            return view('backend.user.edit_form',['user'=>$user,'userrole'=>$userrole]);
        }else{
            return redirect('user/index')->with('error','Something Error: In data fetch!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserForm $request, $id){
        if($request->ajax()){
            return true;
        }
        $user_model=User::where(['id'=>$id])->first();
        
        if(isset(request()->image)){
            $new_name = time()."_".rand(1, 999).".".request()->image->getClientOriginalExtension();
        }else{
            $new_name=$user_model->image;
        }
        /*if(isset($_FILES['file']['name']) && ($_FILES['file']['name'])!=''){
            $ext=explode('/',request()->file->getMimeType());
            $imageName = date('YmdHis').'_'.rand(111,999).".".$ext[1];            
        }else{
            $imageName=$user_model->image;
        }*/
        if($user_model){
        $user_model->user_role_id=$request->user_role;
        $user_model->first_name=$request->first_name;
        $user_model->last_name=$request->last_name;
        $user_model->contact_number=$request->contact_number;
        $user_model->dob=date('Y-m-d', strtotime($request->dob));
        $user_model->email=$request->email;        
        $user_model->image=$new_name;
        $user_model->is_admin='N';
        $user_model->email_verified_at=date('Y-m-d H:i:s');
        $user_model->remember_token='';
        $user_model->password_reset_token='';
        $user_model->auth_key='';
        $user_model->is_active='Y';
        // $user_model->is_delete='N';
        $user_model->approved_member='Y';
        $user_model->ip_address=$request->ip();
        $user_model->created_by=auth()->user()->id;
        $user_model->created_date=date('Y-m-d H:i:s');
        $user_model->updated_by=auth()->user()->id;
        $user_model->updated_date=date('Y-m-d H:i:s');

            if($user_model->save()){
                $destinationPath = public_path('media/userimage');
                if(!file_exists($destinationPath)){
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }
                if(isset(request()->image) && request()->image!=null){
                    request()->image->move($destinationPath, $new_name);        
                }
                /*if(isset($_FILES['file']['name']) && ($_FILES['file']['name'])!=''){
                    request()->file->move(public_path('media/userimage'), $imageName);        
                }*/
                return redirect('user/index')->with('success','Record has been updated successfully');
            }else{
                return redirect('user/index')->with('error','Something Error: In data save!');
            }
        }else{
            return redirect('user/index')->with('error','Something Error: In data fetch!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $user=User::where(['id'=>$id])->first();
        if($user){
            $user->delete();
            return redirect('user/index')->with('success','Record has been deleted successfully');
        }else{
            return redirect('user/index')->with('error','Something Error: In data fetch!');   
        }
    }
    //Update Status
    public function status($id){
        $user=User::where(['id'=>$id])->first();
        if($user){
            if($user->is_active==env('ACTIVE')){
                $status=env('INACTIVE');
            }else{
                $status=env('ACTIVE');
            }
            $user->is_active=$status;
            $user->updated_date=date('Y-m-d H:i:s');
            $user->updated_by=auth()->user()->id;
            if($user->save()){
                if($user->is_active == 'Y'){
                    return redirect('user/index')->with('success','Record has been activated successfully');
                }
                else{
                    return redirect('user/index')->with('success','Record has been inactivated successfully');
                }
            }else{
                return redirect('user/index')->with('success','Something Error: In data save!');
            }
        }else{
            return redirect('user/index')->with('error','Something Error: In data fetch!');   
        }
    }

    //approve or dissapproved user
    public function approved(Request $request,$id){
        $user=User::find($id);
        if($user){
            if($user->approved_member=='P'){
                $user->approved_member='Y';
            }
            else if($user->approved_member=='Y'){
                $user->approved_member='N';
                $block_user = BlockUser::where(['blocked_by_user_id'=>auth()->user()->id,'blocked_user_id'=>$id])->first();
                if($block_user){
                    $block_user->is_block = 'Y';
                    $block_user->blocked_by_admin = 'Y';
                    $block_user->updated_by = auth()->user()->id;
                    $block_user->updated_date = date('Y-m-d H:i:s');
                    $block_user->ip_address=$request->ip();
                }else{
                    $block_user = new BlockUser();
                    $block_user->user_device_id = '';
                    $block_user->blocked_user_id = $id;
                    $block_user->blocked_by_user_id = auth()->user()->id;
                    $block_user->is_block = 'Y';
                    $block_user->blocked_by_admin = 'Y';
                    $block_user->created_by = auth()->user()->id;
                    $block_user->created_date = date('Y-m-d H:i:s');
                    $block_user->updated_by = auth()->user()->id;
                    $block_user->updated_date = date('Y-m-d H:i:s');
                    $block_user->ip_address=$request->ip();
                }
                $block_user->save();
            }else{
                $user->approved_member='Y';
                $block_user_data = BlockUser::where(['blocked_user_id'=>$id,'blocked_by_user_id'=>auth()->user()->id,
                                    'blocked_by_admin'=>'Y'])->first();
                $block_user_data->is_block = 'N';
                $block_user_data->blocked_by_admin = 'N';
                $block_user_data->updated_by = auth()->user()->id;
                $block_user_data->updated_date = date('Y-m-d H:i:s');
                $block_user_data->save();
            }
            $user->updated_date=date('Y-m-d H:i:s');
            $user->updated_by=auth()->user()->id;
            if($user->save()){
                if($user->approved_member=='N'){
                    return redirect('user/index')->with('success','User has been block successfully');      
                }else{
                    return redirect('user/index')->with('success','User has been unblock successfully');            
                }
            }else{
                return redirect('user/index')->with('error','Something Error: In data save!');      
            }
        }else{
            return redirect('user/index')->with('error','Something Error!');
        }
    }
}
