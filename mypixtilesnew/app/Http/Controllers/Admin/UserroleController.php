<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\common_model\Userrole;
use Yajra\Datatables\Datatables;
use App\common_model\Moduleaction;
use App\common_model\Module;
use App\common_model\Roleaction;
use App\Http\Requests\UserroleForm;

class UserroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.userrole.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    function data(Request $request){

         if($request->filter_data && ($request->filter_data=='N' || $request->filter_data=='Y')) {
            $role=Userrole::select('name as user_role','id','is_active')
                            ->where(['is_active'=>$request->filter_data])
                            ->get();
         }else{
            $role=Userrole::select('name as user_role','id','is_active')->get();
         }
            return Datatables::of($role)
                ->addColumn('action', function ($role) {
                    if($role->is_active=='Y'){
                        $class='glyphicon-remove-circle';
                    }else{
                        $class='glyphicon-ok-circle';
                    }

                    if($role->is_active=='Y'){
                        $status_title = 'Inactive';
                    }else{
                        $status_title = 'Active';
                    }

                    return '<a href="'.url('userrole/edit',$role->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>
                   
                   <a href="'.url('userrole/status',$role->id).'" id="is_active" data-status="'.$role->is_active.'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" 
                    title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

                   <a href="'.url('userrole/delete',$role->id).'" id="delete_country" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                })
                ->addColumn('status',function($role){
                    if($role->is_active=='Y'){
                        return '<span style="width: 110px;"><span class="m-badge  m-badge--success m-badge--wide">Active</span></span>';
                    }else{
                        return '<span style="width: 110px;"><span class="m-badge  m-badge  m-badge--danger m-badge--wide">Inactive</span></span>';
                    }                     
                })->rawColumns(['status', 'action'])                       
                ->make(true);
    }
    public function create()
    {
        $module = Module::where(['is_active'=>'Y'])->get();
        $module_array=[];
        foreach ($module as $key => $value) {
            $module_action = Moduleaction::with(['module','action'])->where(['module_id'=>$value->id,'is_active'=>'Y'])->get();
            $module_array[$key]=array('module_id'=>$value->id,'module_name'=>$value->module_name,'action'=>[]);
            foreach ($module_action as $k => $val) {
                $module_array[$key]['action'][]=array('action_id'=>$val->action_id,'action_name'=>$val->action->action_name);
            }    
        }
        return view('backend.userrole.create_form',['module_array'=>$module_array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserroleForm $request)
    {
        if($request->ajax()){
            return true;
        }       
        $userrole = NEW Userrole();
        $userrole->name = $request->name;
        $userrole->created_by=auth()->user()->id;
        $userrole->created_date=date('Y-m-d H:i:s');
        $userrole->updated_by=auth()->user()->id;        
        $userrole->updated_date=date('Y-m-d H:i:s');
        $userrole->is_active='Y';
        if($userrole->save()){                       
            foreach ($request->action as $key => $value) {
                $role_action= NEW Roleaction();
                $role_action->role_id = $userrole->id;
                $array = explode('_',$value);
                $module_id = $array[0];
                $action_id = $array[1];
                $role_action->module_id = $module_id;
                $role_action->action_id = $action_id;
                $role_action->created_by=auth()->user()->id;
                $role_action->created_date=date('Y-m-d H:i:s');
                $role_action->updated_by=auth()->user()->id;        
                $role_action->updated_date=date('Y-m-d H:i:s');
                $role_action->is_active='Y';
                $role_action->save();
                
            }            
             return redirect('userrole/index')->with('success','Userrole has been added successfully');
        }else{            
             return redirect('userrole/index')->with('error','Something Error: In data save!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $user_role = Userrole::where(['id'=>$id])->first();
        $module = Module::where(['is_active'=>'Y'])->get();
        $module_array=[];
        foreach ($module as $key => $value) {            
            // $module_action = Moduleaction::select('module_action.module_id','module_action.action_id','if(role_action.role_id is null,"","checked") as status')
            //                                ->join('role_action',['module_action.module_id'=>'role_action.module_id','module_action.action_id'=>'role_action.action_id','role_action.role_id'=>26])
            //                                ->WHERE(['module_action.module_id'=>$value->id])->get();

            $module_action=\DB::select('
                SELECT `module_action`.`module_id`,`action`.`action_name`,`module_action`.`action_id`, IF(`role_action`.`role_id` IS NULL,"","checked") AS `status` 
                FROM `module_action`

                LEFT JOIN `role_action` ON `module_action`.`module_id` = `role_action`.`module_id` AND 
                                           `module_action`.`action_id` = `role_action`.`action_id` AND 
                                           `role_action`.`role_id` = "'.$id.'" AND role_action.is_active="Y"
                LEFT JOIN `action`  ON `module_action`.`action_id`=`action`.`id` 
                WHERE `module_action`.`module_id` = "'.$value->id.'" and module_action.is_active="Y"');
            
            $module_array[$key]=array('module_id'=>$value->id,'module_name'=>$value->module_name,'action'=>[]);

            foreach ($module_action as $k => $val) {
                $module_array[$key]['action'][]=array('action_id'=>$val->action_id,'action_name'=>$val->action_name,'status'=>$val->status);
            }
        }
            
        return view('backend.userrole.edit_form',['module_array'=>$module_array,'role_value'=>$user_role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserroleForm $request, $id)
    {
        
        if($request->ajax()){
            return true;
        }
        $userrole = Userrole::select('id','name')->where(['id'=>$id])->first();
        if(count((array)$userrole)>0){
            $userrole->name=$request->name;   
            $userrole->updated_by=auth()->user()->id;
            $userrole->updated_date=date('Y-m-d H:i:s');
            if($userrole->save()){
                Roleaction::where(['role_id'=>$id])->update(['is_active' => 'N']);
                foreach ($request->action as $key => $value) {
                    $array = explode('_',$value);
                    $module_id = $array[0];
                    $action_id = $array[1];
                    $role_action=Roleaction::where(['role_id'=>$id,'module_id'=>$module_id,'action_id'=>$action_id])->first();
                    if($role_action){
                        $role_action->is_active='Y';
                        $role_action->created_date=date('Y-m-d H:i:s');
                        $role_action->created_by=auth()->user()->id;
                        $role_action->updated_date=date('Y-m-d H:i:s');
                        $role_action->updated_by=auth()->user()->id;
                    }else{
                        $role_action=new Roleaction();
                        $role_action->role_id=$id;
                        $role_action->module_id=$module_id;
                        $role_action->action_id=$action_id;
                        $role_action->is_active='Y';
                        $role_action->created_date=date('Y-m-d H:i:s');
                        $role_action->created_by=auth()->user()->id;
                        $role_action->updated_date=date('Y-m-d H:i:s');                                
                        $role_action->updated_by=auth()->user()->id;
                    }
                    $role_action->save();
                }
                return redirect('userrole/index')->with('success','Userrole has been updated successfully');
            }else{
                return redirect('userrole/index')->with('error','Something Error: In data save!');
            }
        }else{
            return redirect('userrole/index')->with('error','Something Error: No Active data Found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userrole_model=Userrole::find($id);
        if($userrole_model){
            $userrole_model->delete();
            return redirect('userrole/index')->with('success','Record has been deleted successfully');
        }else{
            return redirect('userrole/index')->with('error','Something Error: In data save!');        
        }
    }

    public function status($id)
    {
        $userrole_model=Userrole::find($id);
        if($userrole_model){
            if($userrole_model->is_active=='Y'){
                $userrole_model->is_active='N';
            }else{
                $userrole_model->is_active='Y';
            }   
            $userrole_model->updated_date=date('Y-m-d H:i:s');        
            $userrole_model->updated_by=auth()->user()->id;        
            if($userrole_model->save()){
                if($userrole_model->is_active=='N'){
                    return redirect('userrole/index')->with('success','Record has been inactivated successfully');
                }else{
                    return redirect('userrole/index')->with('success','Record has been activated successfully');            
                }
              
            }else{
                return redirect('userrole/index')->with('error','Something Error: In data save!');      
            }
        }else{
            return redirect('userrole/index')->with('error','Something Error!');    
        }
    }
}

