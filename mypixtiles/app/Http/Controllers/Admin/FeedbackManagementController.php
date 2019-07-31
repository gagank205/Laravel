<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;
use App\common_model\FeedbackManagement;
 

class FeedbackManagementController extends Controller
{
  public function index()
  { 
    //dd('Hello');
     return view('backend.feedback-management.index');
  }

  public function data(Request $request)
    {
      
      $feedback =FeedbackManagement::
                                select('feedback_management.id','feedback_management.feedback','feedback_management.email_id','users.first_name_en','restaurant_branch.branch_name_en','menu_management.cafe_menu_name_en')
                               ->LeftJoin('users','user_id','users.id')
                               ->LeftJoin('restaurant_branch','restaurant_branch_id','restaurant_branch.id')
                               ->LeftJoin('menu_management','menu_id','menu_management.id')
                         ->get();
                return Datatables::of($feedback) 
                     ->addColumn('action', function ($feedback) {
                            if($feedback->is_active=='Y'){
                             $class='glyphicon-remove-circle';
                        }else{
                            $class='glyphicon-ok-circle';
                            }

                         if($feedback->is_active=='Y'){
                             $status_title = 'Inactive';
                         }else{
                          $status_title = 'Active';
                         }
                       return 
                      '<a href="'.url('feedback-management/edit',$feedback->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

                      <a href="'.url('feedback-management/status',$feedback->id).'" id="is_active" data-status="'.$feedback->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

                      <a href="'.url('feedback-management/delete',$feedback->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                      })
                     ->addColumn('status',function($feedback){
                            if($feedback->is_active=='Y'){
                                return '<span style="width: 110px;"><span class="m-badge  m-badge--success m-badge--wide">Active</span></span>';
                         }else{
                                return '<span style="width: 110px;"><span class="m-badge  m-badge  m-badge--danger m-badge--wide">Inactive</span></span>';
                        }
                })->rawColumns(['status', 'action'])  
              ->make(true);                   
            }

        public function create()
    {
        $feedback=EventManagement::select('id','event_title')->where(['is_active'=>'Y'])->get();
        $category=CategoryManagement::select('id','voucher_category_name')->where(['is_active'=>'Y'])->get();        
        return view('backend.voucher-management.create_form',['event'=>$event,'category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherManagementForm $request)
    {
        
        if($request->ajax()){
            return true;
        }

        $event=NEW VoucherManagement();        
        $event->voucher_category_id=$request->voucher_category_id;
        $event->event_id=$request->event_id;        
        $event->voucher_name=$request->voucher_name;
        $event->voucher_description=$request->voucher_description;
        $event->no_of_voucher=$request->no_of_voucher;
        $event->voucher_price=$request->voucher_price;        
        $event->created_date=date('Y-m-d H:i:s');
        $event->updated_date=date('Y-m-d H:i:s');
        $event->created_by=auth()->user()->id;
        $event->updated_by=auth()->user()->id;
        $event->is_active='Y';
        $event->ip_address=$request->ip();
        
        if($event->save()){           
            return redirect('voucher-management/index')->with('success','Voucher has been added successfully');
        }else{
            return redirect('voucher-management/index')->with('error','Something Error: In data save!');
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
        $voucher=voucherManagement::find($id);
        if($voucher){
            $event=EventManagement::select('id','event_title')->where(['is_active'=>'Y'])->get();
            $category=CategoryManagement::select('id','voucher_category_name')->where(['is_active'=>'Y'])->get();        
            return view('backend/voucher-management/edit_form',['category'=>$category,'event'=>$event,'voucher'=>$voucher]);
        }else{
            return redirect('voucher-management/index')->with('error','Something Error!');
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoucherManagementForm $request, $id)
    {

        if($request->ajax()){
            return true;
        }

        $voucher= VoucherManagement::where(['id'=>$id])->first();       
        $voucher->voucher_category_id=$request->voucher_category_id;
        $voucher->event_id=$request->event_id;        
        $voucher->voucher_name=$request->voucher_name;
        $voucher->voucher_description=$request->voucher_description;
        $voucher->no_of_voucher=$request->no_of_voucher;
        $voucher->voucher_price=$request->voucher_price;                
        $voucher->updated_date=date('Y-m-d H:i:s');        
        $voucher->updated_by=auth()->user()->id;
        $voucher->is_active='Y';
        $voucher->ip_address=$request->ip();
        if($voucher->update()){            
            return redirect('voucher-management/index')->with('success','Voucher has been updated successfully');
        }else{
            return redirect('voucher-management/index')->with('error','Something Error: In data save!');
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
        $event_model=VoucherManagement::find($id);
        if($event_model){
            
            if($event_model->delete()){
                
                return redirect('voucher-management/index')->with('success','Record has been deleted successfully');
            }else{

                 return redirect('voucher-management/index')->with('error','Something Error: In data save!');        
            }
        }else{
            return redirect('voucher-management/index')->with('error','Something Error!');
        }

        
    }

    public function status($id)
    {
        $event_model=VoucherManagement::where(['id'=>$id])->first();
        if($event_model){
            if($event_model->is_active=='Y'){
                $event_model->is_active='N';
            }else{
                $event_model->is_active='Y';
            }   
            $event_model->updated_date=date('Y-m-d H:i:s');        
            $event_model->updated_by=auth()->user()->id;        
            if($event_model->save()){
                if($event_model->is_active=='N'){
                return redirect('voucher-management/index')->with('success','Record has been deactivated successfully');      
                }else{
                return redirect('voucher-management/index')->with('success','Record has been activated successfully');            
                }
              
            }else{
                return redirect('voucher-management/index')->with('error','Something Error: In data save!');      
            }
        }else{
            return redirect('voucher-management/index')->with('error','Something Error!');    
        }
    }

        
} 