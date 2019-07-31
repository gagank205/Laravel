<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\FrameManagementForm;
use App\common_model\FrameManagement;
use Yajra\Datatables\Datatables;

class FrameManagementController extends Controller
{
    public function index()
    {
        return view('backend.frame_management.index');
    }
    public function data(Request $request)
    {
        if(isset($request->filter_data))
        {
            $cms = FrameManagement::where(['is_active'=>$request->filter_data])
                            ->orderBy('id','desc')
                            ->get();
        }else{
            $cms = FrameManagement::
                            orderBy('id','desc')
                            ->get();
        }
        return Datatables::of($cms)
                ->addColumn('action', function ($cms) {
                    if($cms->is_active=='Y'){
                        $class='glyphicon-remove-circle';
                    }else{
                        $class='glyphicon-ok-circle';
                    }

                    if($cms->is_active=='Y'){
                        $status_title = 'Inactive';
                    }else{
                        $status_title = 'Active';
                    }
                    return '<a href="'.url('frame-management/edit',$cms->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

                        <a href="'.url('frame-management/status',$cms->id).'" id="is_active" data-status="'.$cms->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

                        <a href="'.url('frame-management/delete',$cms->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                })
                ->addColumn('status',function($cms){
                    if($cms->is_active=='Y'){
                        return '<span style="width: 110px;"><span class="m-badge  m-badge--success m-badge--wide">Active</span></span>';
                    }else{
                        return '<span style="width: 110px;"><span class="m-badge  m-badge  m-badge--danger m-badge--wide">Inactive</span></span>';
                    }
                })
                ->addColumn('frame_image',function($cms){
                    if($cms->is_active=='Y'){
                        return '<img src="'.url('media/frame',$cms->frame_image).'" width="110" alt="" />';
                    }else{
                        return '<img src="'.url('media/frame',$cms->frame_image).'" width="110" alt="" />';
                    }
                })->rawColumns(['status', 'action', 'frame_image'])                       
                ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/frame_management/create_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FrameManagementForm $request)
    {
        if($request->ajax()){
            return true;
        }

        if(isset(request()->frame)){
            $new_name = time()."_".rand(1, 999).".".request()->frame->getClientOriginalExtension();
        }else{
            $new_name='';
        }

        $array_=array(
        'title'       => $request->title,
        'description' => $request->description,
        'frame_image' => $new_name,
        'created_date'=> date('Y-m-d H:i:s'),
        'updated_date'=> date('Y-m-d H:i:s'),
        'created_by'  => auth()->user()->id,
        'updated_by'  => auth()->user()->id,
        'is_active'   => 'Y',
        'ip_address'  => $request->ip()
        );
        $cms=NEW FrameManagement($array_);
        if($cms->save()){
            $destinationPath = public_path('media/frame');
            if(!file_exists($destinationPath)){
                File::makeDirectory($destinationPath, $mode = 0777, true, true);
            }
            if(isset(request()->frame) && request()->frame!=null){
                request()->frame->move($destinationPath, $new_name);        
            }
            return redirect('frame-management/index')->with('success','Frame has been added successfully');    
        }else{
            return redirect('frame-management/index')->with('error','Something Error: In data save!');
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
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cms_data=FrameManagement::where(['id'=>$id])->first();
        if($cms_data){
            return view('backend/frame_management/edit_form',['cms_data'=>$cms_data]);    
        }else{
            return redirect('frame-management/index')->with('error','Something Error!');
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FrameManagementForm $request, $id)
    {

        if($request->ajax()){
            return true;
        }

        if(isset(request()->image)){
            $new_name = time()."_".rand(1, 999).".".request()->image->getClientOriginalExtension();
                $cms_model=FrameManagement::find($id);
                $cms_model->title       = $request->title;
                $cms_model->description = $request->description;
                $cms_model->frame_image = $new_name;
                $cms_model->updated_date= date('Y-m-d H:i:s');        
                $cms_model->updated_by  =   auth()->user()->id;
         }else{
           
                $cms_model=FrameManagement::find($id);
                $cms_model->title       = $request->title;
                $cms_model->description = $request->description;
                $cms_model->updated_date= date('Y-m-d H:i:s');        
                $cms_model->updated_by  =   auth()->user()->id;
        }

       
        if($cms_model->save()){
            $destinationPath = public_path('media/frame');
            if(!file_exists($destinationPath)){
                File::makeDirectory($destinationPath, $mode = 0777, true, true);
            }
            if(isset(request()->image) && request()->image!=null){
                request()->image->move($destinationPath, $new_name);        
            }
            return redirect('frame-management/index')->with('success','Content management has been updated successfully');
        }else{
            return redirect('frame-management/index')->with('error','Something Error: In data save!');
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
        $cms_model=FrameManagement::find($id);
        if($cms_model){
            $cms_model->delete();
            return redirect('frame-management/index')->with('success','Record has been deleted successfully');
        }else{
            return redirect('frame-management/index')->with('error','Something Error: In data save!');        
        }
    }

    public function status($id)
    {
        $cms_model=FrameManagement::where(['id'=>$id])->first();
        if($cms_model){
            if($cms_model->is_active=='Y'){
                $cms_model->is_active='N';
            }else{
                $cms_model->is_active='Y';
            }   
            $cms_model->updated_date=date('Y-m-d H:i:s');        
            $cms_model->updated_by=auth()->user()->id;        
            if($cms_model->save()){
                if($cms_model->is_active=='N'){
                    return redirect('frame-management/index')->with('success','Record has been inactivated successfully');      
                }else{
                    return redirect('frame-management/index')->with('success','Record has been activated successfully');            
                }
              
            }else{
                return redirect('frame-management/index')->with('error','Something Error: In data save!');      
            }
        }else{
            return redirect('frame-management/index')->with('error','Something Error!');    
        }
    }
}