<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;
use App\common_model\OrderManagement;


class OrderManagementController extends Controller
{
  // Order listing
  public function index()
  { 
    //dd('Hello');
    return view('backend.order-management.index');
  }

  // Order listing datatable with ajax
  public function data(Request $request)
  {
    $order =OrderManagement::
    select('order_management.id', 'order_management.order_type', 'users.first_name_en', 'restaurant_branch.branch_name_en','order_management.cancel_order')
    ->LeftJoin('users','user_id','users.id')
    ->LeftJoin('restaurant_branch','restaurant_branch_id','restaurant_branch.id')
    ->get();

    return Datatables::of($order) 
    ->addColumn('action',function($order){
      if($order->is_active=='Y'){
        $class='glyphicon-remove-circle';
      }else{
        $class='glyphicon-ok-circle';
      }

      if($order->is_active=='Y'){
        $status_title = 'Active';
      }else{
        $status_title = 'InActive';
      }

      return 
      '<a href="'.url('order-management/edit',$order->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

      <a href="'.url('order-management/delete',$order->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
    })
    ->addColumn('status',function($order){
      if($order->cancel_order=='N'){
        return '<span style="width: 110px;"><span class="m-badge  m-badge--success m-badge--wide">Order Not Cancel</span></span>';
      }else{
        return '<span style="width: 110px;"><span class="m-badge  m-badge  m-badge--danger m-badge--wide">Order Cancel</span></span>';
      }
    })->rawColumns(['status', 'action'])                       
    ->make(true);
  }


} 