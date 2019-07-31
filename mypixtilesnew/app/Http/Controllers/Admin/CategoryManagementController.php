<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\CategoryManagementForm;
use App\common_model\CategoryManagement;
use Yajra\Datatables\Datatables;

class CategoryManagementController extends Controller
{
    public function index()
    {
        return view('backend.category_management.index');
    }
    public function data(Request $request)
    {
        if(isset($request->filter_data))
        {
            $category = CategoryManagement::where(['is_active'=>$request->filter_data])
                            ->orderBy('id','desc')
                            ->get();
        }else{
            $category = CategoryManagement::orderBy('id','desc')
                            ->get();
        }
        return Datatables::of($category)
                ->addColumn('action', function ($category) {
                    if($category->is_active=='Y'){
                        $class='glyphicon-remove-circle';
                    }else{
                        $class='glyphicon-ok-circle';
                    }

                    if($category->is_active=='Y'){
                        $status_title = 'Inactive';
                    }else{
                        $status_title = 'Active';
                    }

                    return '<a href="'.url('category-management/edit',$category->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>

                        <a href="'.url('category-management/status',$category->id).'" id="is_active" data-status="'.$category->is_active.'" class="btn-status m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="'.$status_title.'"><i class="glyphicon '.$class.'"></i></a>
                        
                        <a href="'.url('category-management/delete',$category->id).'" id="delete_btn" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                })
                ->addColumn('status',function($category){
                    if($category->is_active=='Y'){
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
        return view('backend/category_management/create_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryManagementForm $request)
    {
        if($request->ajax()){
            return true;
        }
        //dd($request);
        if(isset(request()->image)){
            $icon_name = time()."_".rand(1, 999).".".request()->image->getClientOriginalExtension();
        }else{
            $icon_name='';
        }
        $array_=array(
        'name'=>$request->name,
        'category_icon'=>$icon_name,
        'created_date'=>date('Y-m-d H:i:s'),
        'updated_date'=>date('Y-m-d H:i:s'),
        'created_by'=>auth()->user()->id,
        'updated_by'=>auth()->user()->id,
        'is_active'=>'Y',
        );

        $category=NEW CategoryManagement($array_);
        if($category->save()){
            $destinationPath = public_path('media/categoryicon');
            if(isset(request()->image) && request()->image!=null){
                request()->image->move($destinationPath, $icon_name);
            }
            return redirect('category-management/index')->with('success','Category has been added successfully');    
        }else{
            return redirect('category-management/index')->with('error','Something Error: In data save!');
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
        $category_data=CategoryManagement::where(['id'=>$id])->first();
        if($category_data){
            return view('backend/category_management/edit_form',['category_data'=>$category_data]);    
        }else{
            return redirect('category-management/index')->with('error','Something Error!');
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryManagementForm $request, $id)
    {

        if($request->ajax()){
            return true;
        }
        $category_model=CategoryManagement::find($id);
        if(isset(request()->image)){
            $categoryicon = time()."_".rand(1, 999).".".request()->image->getClientOriginalExtension();
        }else{
            $categoryicon=$category_model->category_icon;
        }
        if($category_model){
            $category_model->name=$request->name;
            $category_model->category_icon=$categoryicon;
            $category_model->updated_date=date('Y-m-d H:i:s');        
            $category_model->updated_by=auth()->user()->id;
            if($category_model->save()){
                $destinationPath = public_path('media/categoryicon');
                if(isset(request()->image) && request()->image!=null){
                    request()->image->move($destinationPath, $categoryicon);        
                }
                return redirect('category-management/index')->with('success','Category has been updated successfully');
            }else{
                return redirect('category-management/index')->with('error','Something Error: In data save!');
            }    
        }else{
            return redirect('category-management/index')->with('error','Something Error: In data fetch!');
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
        $category_model=CategoryManagement::find($id);
        if($category_model){
            $category_model->delete();
            return redirect('category-management/index')->with('success','Record has been deleted successfully');
        }else{
            return redirect('category-management/index')->with('error','Something Error: In data fetch!');        
        }
    }

    public function status($id)
    {
        $category_model=CategoryManagement::where(['id'=>$id])->first();
        if($category_model){
            if($category_model->is_active=='Y'){
                $category_model->is_active='N';
            }else{
                $category_model->is_active='Y';
            }   
            $category_model->updated_date=date('Y-m-d H:i:s');        
            $category_model->updated_by=auth()->user()->id;        
            if($category_model->save()){
                if($category_model->is_active=='N'){
                    return redirect('category-management/index')->with('success','Record has been inactivated successfully');
                }else{
                    return redirect('category-management/index')->with('success','Record has been activated successfully');
                }
              
            }else{
                return redirect('category-management/index')->with('error','Something Error: In data save!');      
            }
        }else{
            return redirect('category-management/index')->with('error','Something Error!');    
        }
    }
}