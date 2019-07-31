@extends('layouts_backend.masters',['title'=>'Module Management'])
@section('content')
<div class="m-subheader ">

	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">Module Management</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="{{ROUTE('dashboard')}}" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>				
				<li class="m-nav__item">
					<a href="" class="m-nav__link">
						<span class="m-nav__link-text">Module Management</span>
					</a>
				</li>
				<li class="m-nav__separator">-</li>
				<li class="m-nav__item">
					<a href="" class="m-nav__link">
						<span class="m-nav__link-text">Edit Module</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<!--begin::Portlet-->
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
							</span>
							<h3 class="m-portlet__head-text">
								Edit module
							</h3>
						</div>
					</div>
					<div class="pull-right back-btn">
						<a href="{{url('module/index')}}"><button type="button" class="btn btn-primary">Back</button></a>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" 
				action="{{ url('module/update',$module_model->id)}}" name="module_form" id="module_form">
					@csrf
					@method('PATCH')
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">							
							<div class="col-lg-4">
								<label>Name:</label>
								<input type="text" class="form-control m-input" name="module_name" maxlength='25' placeholder="Enter module name" value="{{$module_model->module_name}}">
								<span class="m-form__help error module_name"></span>
							</div>
							<div class="col-lg-4">
								<label>Menu Name:</label>
								<input type="text" class="form-control m-input" name="menu_name" maxlength='25' placeholder="Enter module name" value="{{$module_model->menu_name}}">
								<span class="m-form__help error menu_name"></span>
							</div>
							<div class="col-lg-4">
								<label>Icon</label>
								<input type="text" class="form-control m-input" name="icon" maxlength='60' placeholder="Enter module icon" value="{{$module_model->icon}}">
								<span class="m-form__help error icon"></span>
							</div>
						</div>
						<div class="m-form__group form-group">
							<label for="">Action:</label>
							<div class="m-checkbox-inline">
								
								@foreach($action as $key=>$val)
								<label class="m-checkbox">

								@if(in_array($val->id,$id))
								<input type="checkbox" name='action[]' value="{{$val->id}}" checked>	
									{{$val->action_name}}
								 	<span></span>
								@else
								<input type="checkbox" name='action[]' value="{{$val->id}}">
									{{$val->action_name}}
								 	<span></span>
								@endif
								 
								 	
								 </label>
								@endforeach
							</div>
							<span class="m-form__help action"></span>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" name="module_submit" id="module_submit" class="btn btn-primary">Save</button>
									<a href="{{url('module/index')}}">
									<button type="button" class="btn btn-secondary">Cancel</button>
									</a>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--end::Form-->
			</div>
		</div>
			<!--end::Portlet-->
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('js/ModuleFromValidation.js')}}"></script>
@endpush