<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\ContentManagementForm;
use App\common_model\ContentManagement;
use Yajra\Datatables\Datatables;

class ContentManagementController extends Controller
{
    public function index()
    {
        return view('backend.content_management.index');
    }
    public function data(Request $request)
    {
        if(isset($request->filter_data))
        {
            $cms = ContentManagement::where(['is_active'=>$request->filter_data])
                            ->orderBy('id','desc')
                            ->get();
        }else{
            $cms = ContentManagement::
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
                    return '<a href="'.url('content-management/edit',$cms->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

                        <a href="'.url('content-management/status',$cms->id).'" id="is_active" data-status="'.$cms->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

                        <a href="'.url('content-management/delete',$cms->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                })
                ->addColumn('status',function($cms){
                    if($cms->is_active=='Y'){
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
    public function create()
    {
        return view('backend/content_management/create_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentManagementForm $request)
    {
        if($request->ajax()){
            return true;
        }
        $content=ContentManagement::insert([
            'title'=>$request->title,
            'content'=>$request->content,
            'lang_id' => 1,
            'slug'=>strtolower(str_replace(' ','-',trim($request->title))),
            'created_date'=>date('Y-m-d H:i:s'),
            'updated_date'=>date('Y-m-d H:i:s'),
            'created_by'=>auth()->user()->id,
            'updated_by'=>auth()->user()->id,
            'is_active'=>'Y',
            'ip_address'=>$request->ip()
        ]);

       // print_r($content); die; 

       /* $cms=NEW ContentManagement($array_a);*/
        if($content){
            return redirect('content-management/index')->with('success','Content management has been added successfully');    
        }else{
            return redirect('content-management/index')->with('error','Something Error: In data save!');
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
        $cms_data=ContentManagement::where(['id'=>$id])->first();
        if($cms_data){
            return view('backend/content_management/edit_form',['cms_data'=>$cms_data]);    
        }else{
            return redirect('content-management/index')->with('error','Something Error!');
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContentManagementForm $request, $id)
    {

        if($request->ajax()){
            return true;
        }
        $cms_model=ContentManagement::find($id);
        $cms_model->title=$request->title;
        $cms_model->content=$request->content;
        $cms_model->slug=strtolower(str_replace(' ','-',trim($request->title)));
        $cms_model->updated_date=date('Y-m-d H:i:s');        
        $cms_model->updated_by=auth()->user()->id;
        if($cms_model->save()){
            return redirect('content-management/index')->with('success','Content management has been updated successfully');
        }else{
            return redirect('content-management/index')->with('error','Something Error: In data save!');
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
        $cms_model=ContentManagement::find($id);
        if($cms_model){
            $cms_model->delete();
            return redirect('content-management/index')->with('success','Record has been deleted successfully');
        }else{
            return redirect('content-management/index')->with('error','Something Error: In data save!');        
        }
    }

    public function status($id)
    {
        $cms_model=ContentManagement::where(['id'=>$id])->first();
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
                    return redirect('content-management/index')->with('success','Record has been inactivated successfully');      
                }else{
                    return redirect('content-management/index')->with('success','Record has been activated successfully');            
                }
              
            }else{
                return redirect('content-management/index')->with('error','Something Error: In data save!');      
            }
        }else{
            return redirect('content-management/index')->with('error','Something Error!');    
        }
    }
}