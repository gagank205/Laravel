@extends('layouts_backend.masters',['title'=>'User Management'])
@section('content')
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">User Management</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="{{url('dashboard')}}" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>				
				<li class="m-nav__item">
					<a href="{{url('user/index')}}" class="m-nav__link">
						<span class="m-nav__link-text">User Management</span>
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
								Add User
							</h3>
						</div>
					</div>
					<div class="pull-right back-btn">
						<a href="{{url('user/index')}}"><button type="button" class="btn btn-primary">Back</button></a>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" action="{{ url('user/store')}}" name="user_form" id="user_form" enctype="multipart/form-data">
					@csrf
					@method('post')
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>First Name</label>
								<input type="text" class="form-control m-input" maxlength='60' name="first_name" placeholder="Enter first name in english">
								<span class="m-form__help error first_name"></span>
							</div>
							<div class="col-lg-6">
								<label>Last Name</label>
								<input type="text" class="form-control m-input" maxlength='60' name="last_name" placeholder="Enter last name in english">
								<span class="m-form__help error last_name"></span>
							</div>
						</div>		
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>Email </label>
								<input type="text" class="form-control m-input" maxlength='60' name="email" placeholder="Enter email">
								<span class="m-form__help error email"></span>
							</div>
							<div class="col-lg-6">
								<label>Contact number</label>
								<input type="text" class="form-control m-input" maxlength='15' name="contact_number" placeholder="Enter contact number">
								<span class="m-form__help error contact_number"></span>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-4">
								<label>Role</label>								
								<select name="user_role" id='m_select2_1' class="form-control m-select2">
										@foreach($userrole as $key=>$val)
										<option value="{{$val['id']}}">{{$val['name']}}</option>
										@endforeach
								</select>
								<span class="m-form__help error user_role"></span>
							</div>
							<div class="col-lg-4">
								<label>Password </label>
								<input type="password" class="form-control m-input" maxlength='60' name="password" placeholder="Enter password">
								<span class="m-form__help error password"></span>
							</div>
							<div class="col-lg-4">
								<label>Date of birth</label>
								<div class="input-group date">
									<input type="text" class="form-control m-input" name="dob" readonly placeholder="Select date" id="m_datepicker_2"/>
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar-check-o"></i>
										</span>
									</div>
								</div>
								<span class="m-form__help error dob"></span>
							</div>
						</div>
					</div>
					<div class="form-group m-form__group row">	
						<div class="col-lg-4">
							<label>User Profile</label>
							<input id="file-1" type="file" name="image" class="file" data-overwrite-initial="false" data-min-file-count="1">
							<span class="m-form__help error user_image"></span>
						</div>
					</div>
					
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" name="user_submit" id="user_submit" class="btn btn-primary">Save</button>
									<a href="{{url('user/index')}}">
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
<script type="text/javascript" src="{{asset('js/UserFormValidation.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="{{asset('assets/demo/custom/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>

    <script src="{{asset('vendors/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $("#file-1").fileinput({
            theme: 'fa',
			showUpload:false,
			showRemove:false,			
            uploadUrl: "/image-view",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },            
            remove :false,
            allowedFileExtensions: ['jpg','jpeg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize:2000,
            maxFilesNum: 1,
        });
    </script>
    <script type="text/javascript"></script>
    <script src="{{asset('vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/demo/custom/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
@endpush