<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\common_model\Moduleaction;
use App\common_model\Module;
use Yajra\Datatables\Datatables;


class ModuleactionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('backend.moduleaction.index');
    }

    public function data(Request $request){
            $model_obj = Moduleaction::where(['is_delete'=>'N']);
            
            if(isset($request->filter_data)){
            $model_obj->andWhere(['is_active'=>$reuqest->filter_data]);  
            }
            $model=$model_obj->get();
            return Datatables::of($model)
                ->addColumn('action', function ($model){
                    if($model->is_active=='Y'){
                        $class='glyphicon-remove-circle';
                    }else{
                        $class='glyphicon-ok-circle';
                    }

                    return '<a href="'.url('moduleaction/edit',$model->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                    
                    <a href="'.url('moduleaction/status',$model->id).'" id="is_active" data-status="'.$model->is_active.'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="glyphicon '.$class.'"></i></a>

                    <a href="'.url('moduleaction/delete',$model->id).'" id="delete_moduleaction" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>';
                })
                  ->addColumn('status',function($model){
                    if($model->is_active=='Y'){
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
        
        $module=Module::select('id','module_name')->where(['is_active'=>'Y','is_delete'=>'N'])->get();
        return view('backend.moduleaction.create_form',['module'=>$module]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        //
    }

}
