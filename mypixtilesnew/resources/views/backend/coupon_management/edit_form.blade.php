@extends('layouts_backend.masters',['title'=>'Coupon Management'])
@section('content')
<div class="m-subheader ">

	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">Coupon Management</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="{{ROUTE('dashboard')}}" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>				
				<li class="m-nav__item">
					<a href="{{url('coupon-management/index')}}" class="m-nav__link">
						<span class="m-nav__link-text">Coupon Management</span>
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
								Edit Coupon
							</h3>
						</div>
					</div>
					<div class="pull-right back-btn">
						<a href="{{url('coupon-management/index')}}"><button type="button" class="btn btn-primary">Back</button></a>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" 
				action="{{ route('coupon-management.update',$cms_data->id)}}" name="content_form" id="content_form" >
					@csrf
					@method('patch')
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>Coupon Name:</label>
								<input type="text" class="form-control m-input" name="coupon_name" placeholder="Enter coupon name" value="{{$cms_data->coupon_name}}" maxlength='60'>
								<span class="m-form__help error coupon_name"></span>
							</div>
							<div class="col-lg-6">
								<label>Coupon Code:</label>
								<input type="text" class="form-control m-input" name="coupon_code" placeholder="Enter coupon code" value="{{$cms_data->coupon_code}}" maxlength='60'>
								<span class="m-form__help error coupon_code"></span>
							</div>
						</div>
						<div class="form-group m-form__group row has-success">
							<div class="col-lg-12">
								<label>Description:</label>
								<textarea  class="form-control m-input" name="coupon_description">{{$cms_data->coupon_description}}</textarea>
								<span class="m-form__help error coupon_description"></span>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>Discount Type:</label>
								<select class="form-control m-input" name="discount_type">
									<option selected="" value="{{$cms_data->discount_type}}">{{$cms_data->discount_type}}</option>
									<option value="FLAT">FLAT</option>
									<option value="PERCENTAGE">PERCENTAGE</option>
								</select>
								<span class="m-form__help error discount_type"></span>
							</div>
							<div class="col-lg-6">
								<label>Discount:</label>
								<input type="text" class="form-control m-input" name="discount" placeholder="Enter discount" maxlength='60' value="{{$cms_data->discount}}">
								<span class="m-form__help error discount"></span>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>Start date:</label>
								<input type="date" class="form-control m-input" name="start_date" placeholder="start date" maxlength='60' value="{{$cms_data->start_date}}">
								<span class="m-form__help error start_date"></span>
							</div>
							<div class="col-lg-6">
								<label>End date:</label>
								<input type="date" class="form-control m-input" name="end_date" placeholder="End date" maxlength='60' value="{{$cms_data->end_date}}">
								<span class="m-form__help error end_date"></span>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" name="content_submit" id="content_submit" class="btn btn-primary">Save</button>
									<a href="{{url('coupon-management/index')}}">
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
	<script type="text/javascript" src="{{asset('js/ContentManagementFromValidation.js')}}"></script>
	<script src="{{asset('vendors/jquery/dist/jquery.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendors/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendors/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendors/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendors/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendors/wnumb/wNumb.js')}}" type="text/javascript"></script>
	<script src="{{asset('vendors/summernote/dist/summernote.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/demo/custom/crud/forms/widgets/summernote.js')}}" type="text/javascript"></script>
@endpush