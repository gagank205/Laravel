<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;
use App\common_model\MyCart;


class MyCartController extends Controller
{
  public function index()
  { 
    //dd('Hello');
    return view('backend.my-cart.index');
  }

  public function data(Request $request)
  {
    $module = MyCart::join('users', 'my_cart.user_id', '=', 'users.id')
    ->join('restaurant_branch', 'restaurant_branch.id', '=', 'my_cart.restaurant_branch_id')
    ->select('my_cart.id','users.first_name_en','users.last_name_en','restaurant_branch.branch_name_en','my_cart.food_quantity','my_cart.price','my_cart.cancel_order')
    ->get();
    return Datatables::of($module) 
    ->addColumn('action',function($module){
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
      return 
      '<a href="'.url('restaurant-user-management/edit',$module->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

      <a href="'.url('restaurant-user-management/status',$module->id).'" id="is_active" data-status="'.$module->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

      <a href="" id="data_show" data-url="'.url('restaurant-user-management/show',$module->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"  data-public_path="'.url('media/userimage').'" title="View">
      <i class="flaticon-eye"></i></a>

      <a href="'.url('restaurant_management/delete',$module->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
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


} 