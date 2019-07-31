@extends('layouts_backend.masters',['title'=>'Userrole Management'])
@section('content')
<div class="m-subheader ">

	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">User Role Management</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="{{ROUTE('dashboard')}}" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
				<li class="m-nav__item">
					<a href="{{url('userrole/index')}}" class="m-nav__link">
						<span class="m-nav__link-text">User Role Management</span>
					</a>
				</li>
				<li class="m-nav__separator">-</li>
				<li class="m-nav__item">
					<span class="m-nav__link-text">Edit</span>
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
								Edit User role 
							</h3>
						</div>
					</div>
					<div class="pull-right back-btn">
						<a href="{{url('userrole/index')}}"><button type="button" class="btn btn-primary">Back</button></a>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" 
				action="{{ url('userrole/update',$role_value->id)}}" name="userrole_form" id="userrole_form">
					@csrf
					@method('PATCH')
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>Role:</label>
								 <input type="text" class="form-control m-input" name="name" maxlength='25' placeholder="Enter user role name" value="{{$role_value->name}}">
								<span class="m-form__help error name"></span>
							</div>
						</div>
						<div class="m-form__group form-group">
							<label for="">Module and Actions:</label>
							<div class="m-checkbox-inline">
								@foreach($module_array as $key=>$val)
								<div class="module_action_checkbox">
								<div class="module_parent">
								<label class="m-checkbox m-checkbox--solid m-checkbox--state-brand bold">
								 	<input type="checkbox" name='module[]' class='module_class' data-check='false' data-class="action_click_{{$key}}" id="module_click" value="{{$val['module_id']}}">{{$val['module_name']}}
									<span></span>
								</label>
								</div>
									@foreach($val['action'] as $k=>$value)
									<div class="action_child">
									<label class="m-checkbox m-checkbox--solid m-checkbox--state-success">
									 	<input type="checkbox" name="action[]" class="action_click_{{$key}} action_" data-class="action_click_{{$key}}" value="{{$val['module_id'].'_'.$value['action_id']}}" {{$value['status']}} >{{$value['action_name']}}
									 	<span></span>
									</label>
									</div>
									@endforeach 
								</div>
									<br><br>
								@endforeach
							</div>
							<span class="m-form__help error module"></span>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" name="userrole_submit" id="userrole_submit" class="btn btn-primary">Save</button>
									<a href="{{url('userrole/index')}}">
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
<script type="text/javascript" src="{{asset('js/UserroleFromValidation.js')}}"></script>
@endpush