@extends('layouts_backend.masters',['title'=>'Site Configuration'])
@section('content')
<div class="m-subheader ">

	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">Site Configuration</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="{{ROUTE('dashboard')}}" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>				
				<li class="m-nav__item">
					<a href="{{url('site-configuration/index')}}" class="m-nav__link">
						<span class="m-nav__link-text">Site Configuration</span>
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
								Add Site Configuration
							</h3>
						</div>
					</div>
					<div class="pull-right back-btn">
						<a href="{{url('site-configuration/index')}}"><button type="button" class="btn btn-primary">Back</button></a>
					</div>
				</div>

				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" 
				action="{{ url('site-configuration/store')}}" name="siteconfig_form" id="siteconfig_form">
					@csrf
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>Config Key:</label>
								<input type="text" class="form-control m-input" maxlength='60' name="config_key" placeholder="Enter config key">
								<span class="m-form__help error config_key"></span>
							</div>
							<div class="col-lg-6">
								<label>Config Value:</label>
								<input type="text" class="form-control m-input" maxlength='255' name="config_value" placeholder="Enter config key">
								<span class="m-form__help error config_value"></span>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" name="siteconfig_submit" id="siteconfig_submit" class="btn btn-primary">Save</button>
									<a href="{{url('site-configuration/index')}}">
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
<script type="text/javascript" src="{{asset('js/SiteConfigurationFormValidation.js')}}"></script>
@endpush