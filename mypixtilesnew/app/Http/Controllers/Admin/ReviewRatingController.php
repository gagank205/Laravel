<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;
use App\common_model\ReviewRating;
 

class ReviewRatingController extends Controller
{
	public function index()
	{	
		//dd('Hello');
		 return view('backend.review-rating.index');
	}

	public function data(Request $request)
    {
    	
      $reviewrating =ReviewRating::
                                select('review_rating.id','review_rating.star','review_rating.comments','users.first_name_en','restaurant_branch.branch_name_en')
                               ->LeftJoin('users','from_user_id','users.id')
                               ->LeftJoin('restaurant_branch','restaurant_branch_id','restaurant_branch.id')
              				         ->get();
              			return Datatables::of($reviewrating) 
							            ->addColumn('action', function ($reviewrating) {
                            if($reviewrating->is_active=='Y'){
                             $class='glyphicon-remove-circle';
                            }else{
                             $class='glyphicon-ok-circle';
                            }

                         if($reviewrating->is_active=='Y'){
                             $status_title = 'Inactive';
                         }else{
                          $status_title = 'Active';
                         }
                       return 
                      '<a href="'.url('review-rating/edit',$reviewrating->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

                      <a href="'.url('review-rating/status',$reviewrating->id).'" id="is_active" data-status="'.$reviewrating->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>

                      <a href="'.url('review-rating/delete',$reviewrating->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                      })
                     ->addColumn('status',function($reviewrating){
                            if($reviewrating->is_active=='Y'){
                                return '<span style="width: 110px;"><span class="m-badge  m-badge--success m-badge--wide">Active</span></span>';
                         }else{
                                return '<span style="width: 110px;"><span class="m-badge  m-badge  m-badge--danger m-badge--wide">Inactive</span></span>';
                        }
                })->rawColumns(['status', 'action'])    
							->make(true);                   
	    			}

        
}	