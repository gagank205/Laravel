<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleForm;
use App\common_model\Module;
use App\common_model\Actionmaster;
use App\common_model\Moduleaction;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.module.index');
    }
    public function data(Request $request)
    {
        /*if($request->filter_data && $request->filter_data!=''){
            $module = Module::where(['is_active'=>$request->filter_data])
                            ->orderBy('id','desc')
                            ->get();
        }else{*/
            $module = Module::orderBy('id','desc')->get();    
        // }
        
        
        return Datatables::of($module)
             ->addColumn('action', function ($module){
                if($module->is_active=='Y'){
                    $class='glyphicon-remove-circle';
                }else{
                    $class='glyphicon-ok-circle';
                }

                if($module->is_active=='Y'){
                    $status_title = 'Inactive';
                }else{
                    $status_title = 'Active';
                }
                return '
                <a href="'.url('module/edit',$module->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"  title="Edit"><i class="la la-edit"></i></a>
                
                <a href="'.url('module/status',$module->id).'" id="is_active" data-status="'.$module->is_active.'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"  
                    title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>';              

                })
                ->addColumn('status',function($module){

                    if($module->is_active=='Y'){
                        return '<span style="width: 110px;"><span class="m-badge  m-badge--success m-badge--wide">Active</span></span>';
                    }else{
                        return '<span style="width: 110px;"><span class="m-badge  m-badge  m-badge--danger m-badge--wide">Inactive</span></span>';
                    }
                })->rawColumns(['status', 'action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    function check($controller, $action)  {
        
        $controller = Inflector::camelize($controller);
        App::import('Controller', $controller.'Controller');
        $aMethods = get_class_methods($controller.'Controller');
        if($aMethods) {
            foreach ($aMethods as $idx => $method) {
                if($action==$method) return true;
            }
        } else  {
            //this is probably NOT a controller!
        }
        return false;
    }

    public function create()
    {        
        
        $action=Actionmaster::select('id','action_name','route')->where(['is_active'=>'Y'])->get();
        return view('backend.module.create_form',['action'=>$action]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleForm $request)
    {
        if($request->ajax()){
            return true;
        }
        
        $Module_model=new Module();
        $Module_model->module_name=str_replace("-"," ",$request->module_name);
        $Module_model->menu_name=$request->menu_name;
        $Module_model->icon=$request->icon;        
        $Module_model->created_by=auth()->user()->id;
        $Module_model->created_date=date('Y-m-d H:i:s');
        $Module_model->updated_by=auth()->user()->id;        
        $Module_model->updated_date=date('Y-m-d H:i:s');        
        $Module_model->is_active='Y';
        if($Module_model->save()){            
            foreach($request->action as $key=>$val){
                $action = new Moduleaction();
                $action->module_id=$Module_model->id;
                $action->action_id=$val;
                $action->is_active='Y';
                $action->created_by=auth()->user()->id;
                $action->updated_by=auth()->user()->id;        
                $action->save();
            }
            return redirect('module/index')->with('success','Module has been added successfully');
        }else{
            return redirect('module/index')->with('error','Something Error: In data save!');
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
        $module_model=Module::select('id','module_name','menu_name','icon')->where(['id'=>$id])->first();
        $action=Actionmaster::select('id','action_name','route')->where(['is_active'=>'Y',])->get();
        $module_action=Moduleaction::select ('action_id')->where(['is_active'=>'Y','module_id'=>$id])->get();
        $id=array();
        foreach($module_action as $key=>$val){
            $id[]=$val->action_id;
        }
        // echo"<pre>";print_r($id);die;
        if(count((array)$module_model)>0){
            return view('backend.module.edit_form',compact('module_model','action','id'));
        }else{
            return redirect('module/index')->with('error','Something Error: No Active data Found!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleForm $request, $id)
    {
        if($request->ajax()){
            return true;
        }
        $module_model=Module::select('id','module_name','icon')->where(['id'=>$id])->first();
        if(count((array)$module_model)>0){
            $module_model->module_name=str_replace("-"," ",$request->module_name);        
            $module_model->menu_name=$request->menu_name;
            $module_model->icon=$request->icon;        
            $module_model->updated_by=auth()->user()->id;
            $module_model->updated_date=date('Y-m-d H:i:s');            
            if($module_model->save()){
                Moduleaction::where(['module_id'=>$id])->update(['is_active' => 'N']);
                
                foreach ($request->action as $key => $value) {
                    $moduleaction=Moduleaction::where(['module_id'=>$id,'action_id'=>$value])->first();
                    if($moduleaction){
                        $moduleaction->is_active='Y';
                        $moduleaction->updated_date=date('Y-m-d H:i:s');                                
                        $moduleaction->updated_by=auth()->user()->id;                           
                    }else{
                        $moduleaction=new Moduleaction();
                        $moduleaction->module_id=$id;
                        $moduleaction->action_id=$value;                        
                        $moduleaction->created_date=date('Y-m-d H:i:s');                                
                        $moduleaction->created_by=auth()->user()->id;
                    }
                    $moduleaction->save();
                }                       
                return redirect('module/index')->with('success','Module has been updated successfully');
            }else{
                return redirect('module/index')->with('error','Something Error: In data save!');
            }
        }else{
            return redirect('module/index')->with('error','Something Error: No Active data Found!');
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
        $module_model=Module::find($id);
        $module_model->updated_date=date('Y-m-d H:i:s');
        $module_model->updated_by=auth()->user()->id;      
        if($module_model->save()){
             return redirect('module/index')->with('success',"Module has been deleted successfully");
        }else{
            return redirect('module/index')->with('error','Something Error: No Active data Found!');  
        }
    }

    public function status($id){
        $module_model=Module::find($id);
        if(count((array)$module_model)>0){
            if($module_model->is_active=='Y'){
                $status='N';
                $message='inactivated';
            }else{
                $status='Y';
                $message='activated';
            }
            $module_model->is_active=$status;
            if($module_model->save()){
                 if($module_model->is_active=='N'){
                    return redirect('category-management/index')->with('success','Record has been inactivated successfully');
                }else{
                    return redirect('category-management/index')->with('success','Record has been activated successfully');
                }
            }else{
                 return redirect('module/index')->with('error','Something Error: In data save!');
            }
        }else{
            return redirect('module/index')->with('error','Something Error: No Active data Found!');   
        }
    }
}
