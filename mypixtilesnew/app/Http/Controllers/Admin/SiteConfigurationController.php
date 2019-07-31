<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\SiteConfigurationForm;
use App\common_model\SiteConfiguration;
use Yajra\Datatables\Datatables;

class SiteConfigurationController extends Controller
{
    public function index()
    {
        return view('backend.site_configuration.index');
    }
    public function data(Request $request)
    {
        if(isset($request->filter_data))
        {
            $siteconfig = SiteConfiguration::where(['is_active'=>$request->filter_data])
                            ->orderBy('id','desc')
                            ->get();
        }else{
            $siteconfig = SiteConfiguration::orderBy('id','desc')
                            ->get();
        }
        return Datatables::of($siteconfig)
                ->addColumn('action', function ($siteconfig) {
                    if($siteconfig->is_active=='Y'){
                        $class='glyphicon-remove-circle';
                    }else{
                        $class='glyphicon-ok-circle';
                    }

                    if($siteconfig->is_active=='Y'){
                        $status_title = 'Inactive';
                    }else{
                        $status_title = 'Active';
                    }

                    return '<a href="'.url('site-configuration/edit',$siteconfig->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

                        <a href="'.url('site-configuration/status',$siteconfig->id).'" id="is_active" data-status="'.$siteconfig->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

                        <a href="'.url('site-configuration/delete',$siteconfig->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                })
                ->addColumn('status',function($siteconfig){
                    if($siteconfig->is_active=='Y'){
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
        return view('backend/site_configuration/create_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteConfigurationForm $request)
    {
        if($request->ajax()){
            return true;
        }
        $array_=array(
        'config_key'=>$request->config_key,
        'config_value'=>$request->config_value,
        'created_date'=>date('Y-m-d H:i:s'),
        'updated_date'=>date('Y-m-d H:i:s'),
        'created_by'=>auth()->user()->id,
        'updated_by'=>auth()->user()->id,
        'ip_address'=>$request->ip(),
        'is_active'=>'Y',
        );

        $siteconfig=NEW SiteConfiguration($array_);
        if($siteconfig->save()){
            return redirect('site-configuration/index')->with('success','Site configuration has been added successfully');    
        }else{
            return redirect('site-configuration/index')->with('error','Something Error: In data save!');
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
        $siteconfig_data=SiteConfiguration::where(['id'=>$id])->first();
        if($siteconfig_data){
            return view('backend/site_configuration/edit_form',['siteconfig_data'=>$siteconfig_data]);    
        }else{
            return redirect('site-configuration/index')->with('error','Something Error!');
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteConfigurationForm $request, $id)
    {

        if($request->ajax()){
            return true;
        }
        $siteconfig_model=SiteConfiguration::find($id);
        //$siteconfig_model->config_key=$request->config_key;
        $siteconfig_model->config_value=$request->config_value;
        $siteconfig_model->updated_date=date('Y-m-d H:i:s');        
        $siteconfig_model->updated_by=auth()->user()->id;
        //dd($siteconfig_model);
        if($siteconfig_model->save()){
            return redirect('site-configuration/index')->with('success','Site configuration has been updated successfully');
        }else{
            return redirect('site-configuration/index')->with('error','Something Error: In data save!');
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
        $siteconfig_model=SiteConfiguration::find($id);
        if($siteconfig_model){
            $siteconfig_model->delete();
            return redirect('site-configuration/index')->with('success','Record has been deleted successfully');
        }else{
            return redirect('site-configuration/index')->with('error','Something Error: In data save!');        
        }
    }

    public function status($id)
    {
        $siteconfig_model=SiteConfiguration::find($id);
        if($siteconfig_model){
            if($siteconfig_model->is_active=='Y'){
                $siteconfig_model->is_active='N';
            }else{
                $siteconfig_model->is_active='Y';
            }   
            $siteconfig_model->updated_date=date('Y-m-d H:i:s');        
            $siteconfig_model->updated_by=auth()->user()->id;        
            if($siteconfig_model->save()){
                if($siteconfig_model->is_active=='N'){
                return redirect('site-configuration/index')->with('success','Record has been inactivated successfully');      
                }else{
                return redirect('site-configuration/index')->with('success','Record has been activated successfully');            
                }
              
            }else{
                return redirect('site-configuration/index')->with('error','Something Error: In data save!');      
            }
        }else{
            return redirect('site-configuration/index')->with('error','Something Error!');    
        }
    }
}