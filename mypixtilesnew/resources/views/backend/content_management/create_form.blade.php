@extends('layouts_backend.masters',['title'=>'Content Management'])
@section('content')
<div class="m-subheader ">

	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">Content Management</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="{{ROUTE('dashboard')}}" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>				
				<li class="m-nav__item">
					<a href="{{url('content-management/index')}}" class="m-nav__link">
						<span class="m-nav__link-text">Content Management</span>
					</a>
				</li>
				<li class="m-nav__separator">-</li>
				<li class="m-nav__item">
					<span class="m-nav__link-text">Add</span>
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
								Add Content
							</h3>
						</div>
					</div>
					<div class="pull-right back-btn">
						<a href="{{url('content-management/index')}}"><button type="button" class="btn btn-primary">Back</button></a>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" 
				action="{{ url('content-management/store')}}" name="content_form" id="content_form">
					@csrf
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>Enter Title:</label>
								<input type="text" class="form-control m-input" name="title" placeholder="Enter title name" maxlength='60'>
								<span class="m-form__help error title"></span>
							</div>
						</div>
						<div class="form-group m-form__group row has-success">
							<div class="col-lg-12 col-md-9 col-sm-12">
								<label>Enter Content:</label>
								<textarea class="summernote" name="content"></textarea>
								<span class="m-form__help error content"></span>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" name="content_submit" id="content_submit" class="btn btn-primary">Save</button>
									<a href="{{url('content-management/index')}}">
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