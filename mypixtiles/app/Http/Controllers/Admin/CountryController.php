<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;
use App\common_model\Country;
 

class CountryController extends Controller
{
  public function index()
  { 
    //dd('Hello');
     return view('backend.country.index');
  }

  public function data(Request $request)
    {
      
        $module = Country::select('id','name');
                  
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
                      '<a href="'.url('country/edit',$module->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

                      <a href="'.url('country/status',$module->id).'" id="is_active" data-status="'.$module->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>
                      
                      <a href="'.url('country/delete',$module->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
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