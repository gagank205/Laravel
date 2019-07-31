<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;
use App\common_model\CategoryMaster;
 

class CategoryMasterController extends Controller
{
	public function index()
	{	
		//dd('Hello');
		 return view('backend.category-master.index');
	}

	public function data(Request $request)
    {
    	
      $catmaster =CategoryMaster::
                                select('category_master.id','category_master.category_name','category_master.category_description','language_management.lanuage_name')
                               ->LeftJoin('language_management','lang_id','language_management.id')
              				         ->get();
              				      return Datatables::of($catmaster) 
							                 ->addColumn('action', function ($catmaster) {
                               if($catmaster->is_active=='Y'){
                                 $class='glyphicon-remove-circle';
                              }else{
                                   $class='glyphicon-ok-circle';
                                   }

                                 if($catmaster->is_active=='Y'){
                                    $status_title = 'Inactive';
                                   }else{
                                    $status_title = 'Active';
                                 }
                            return 
                            '<a href="'.url('category-master/edit',$catmaster->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

                             <a href="'.url('category-master/status',$catmaster->id).'" id="is_active" data-status="'.$catmaster->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

                              <a href="'.url('category-master/delete',$catmaster->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                             })
                              ->addColumn('status',function($catmaster){
                                     if($catmaster->is_active=='Y'){
                                       return '<span style="width: 110px;"><span class="m-badge  m-badge--success m-badge--wide">Active</span></span>';
                                   }else{
                                     return '<span style="width: 110px;"><span class="m-badge  m-badge  m-badge--danger m-badge--wide">Inactive</span></span>';
                                   }
                                   })->rawColumns(['status', 'action'])  
                         ->make(true);                    
	    			        }

        
}	