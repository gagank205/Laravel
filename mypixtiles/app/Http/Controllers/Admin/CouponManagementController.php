<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\CouponManagementForm;
use App\common_model\CouponManagement;
use Yajra\Datatables\Datatables;

class CouponManagementController extends Controller
{
    public function index()
    {
        return view('backend.coupon_management.index');
    }
    public function data(Request $request)
    {
        if(isset($request->filter_data))
        {
            $cms = CouponManagement::where(['is_active'=>$request->filter_data])
                            ->orderBy('id','desc')
                            ->get();
        }else{
            $cms = CouponManagement::
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
                    return '<a href="'.url('coupon-management/edit',$cms->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

                        <a href="'.url('coupon-management/status',$cms->id).'" id="is_active" data-status="'.$cms->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

                        <a href="'.url('coupon-management/delete',$cms->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                })
                ->addColumn('status',function($cms){
                    if($cms->is_active=='Y'){
                        return '<span style="width: 110px;"><span class="m-badge  m-badge--success m-badge--wide">Active</span></span>';
                    }else{
                        return '<span style="width: 110px;"><span class="m-badge  m-badge  m-badge--danger m-badge--wide">Inactive</span></span>';
                    }
                })
                ->rawColumns(['status', 'action'])                       
                ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/coupon_management/create_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponManagementForm $request)
    {
        if($request->ajax()){
            return true;
        }

        $array_=array(
        'coupon_code'       => $request->coupon_code,
        'coupon_name'       => $request->coupon_name,
        'coupon_description'=> $request->coupon_description,
        'discount_type'     => $request->discount_type,
        'discount'          => $request->discount,
        'start_date'        => $request->start_date,
        'end_date'          => $request->end_date,
        'created_date'      => date('Y-m-d H:i:s'),
        'updated_date'      => date('Y-m-d H:i:s'),
        'created_by'        => auth()->user()->id,
        'updated_by'        => auth()->user()->id,
        'is_active'         => 'Y',
        'ip_address'        => $request->ip()
        );
        $cms=NEW CouponManagement($array_);
        if($cms->save()){
            return redirect('coupon-management/index')->with('success',' Coupon has been added successfully');
        }else{
            return redirect('coupon-management/index')->with('error','Something Error: In data save!');
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
        $cms_data=CouponManagement::where(['id'=>$id])->first();
        if($cms_data){
            return view('backend/coupon_management/edit_form',['cms_data'=>$cms_data]);    
        }else{
            return redirect('coupon-management/index')->with('error','Something Error!');
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponManagementForm $request, $id)
    {

        if($request->ajax()){
            return true;
        }
        $cms_model=CouponManagement::find($id);
        $cms_model->coupon_code       = $request->coupon_code;
        $cms_model->coupon_name       = $request->coupon_name;
        $cms_model->coupon_description= $request->coupon_description;
        $cms_model->discount_type     = $request->discount_type;
        $cms_model->discount          = $request->discount;
        $cms_model->start_date        = $request->start_date;
        $cms_model->end_date          = $request->end_date;
        $cms_model->updated_date      = date('Y-m-d H:i:s');        
        $cms_model->updated_by        = auth()->user()->id;
        // print_r($cms_model);die;
        if($cms_model->save()){
            return redirect('coupon-management/index')->with('success','Coupon has been updated successfully');
        }else{
            return redirect('coupon-management/index')->with('error','Something Error: In data save!');
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
        $cms_model=CouponManagement::find($id);
        if($cms_model){
            $cms_model->delete();
            return redirect('coupon-management/index')->with('success','Record has been deleted successfully');
        }else{
            return redirect('coupon-management/index')->with('error','Something Error: In data save!');        
        }
    }

    public function status($id)
    {
        $cms_model=CouponManagement::where(['id'=>$id])->first();
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
                    return redirect('coupon-management/index')->with('success','Record has been inactivated successfully');      
                }else{
                    return redirect('coupon-management/index')->with('success','Record has been activated successfully');            
                }
              
            }else{
                return redirect('coupon-management/index')->with('error','Something Error: In data save!');      
            }
        }else{
            return redirect('coupon-management/index')->with('error','Something Error!');    
        }
    }
}