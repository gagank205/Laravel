@extends('layouts_backend.masters',['title'=>'User Management'])
@section('content')
	<div class="m-subheader ">
  	@if(session()->get('success'))
  	<div class="col-5 pull-right">
  	<div class="alert alert-success alert-dismissible fade show elementToFadeInAndOut" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		</button>
		{{ session()->get('success') }}
	</div>
	</div>
	@elseif(session()->get('error'))
	<div class="col-5 pull-right">
  	<div class="alert alert-danger alert-dismissible fade show elementToFadeInAndOut" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		</button>
		{{ session()->get('error') }}
	</div>
	</div>
  	@endif
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">Report Managment</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="{{url('dashboard')}}" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
				<li class="m-nav__item">
					<a href="#"><span class="m-nav__link-text">Report Management</span></a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">		
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<table>
				<tr>
					<td><a href="{{route('report-management.index')}}"><button class="btn btn-info">User</button></a></td>
					<td><a href="{{route('report-management_order')}}"><button class="btn btn-info">Order</button></a></td>
                  	<td><a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a></td>
				</tr>
			</table>
			<div class="m-portlet__head-caption">
				<!-- <div class="m-portlet__head-title">
					<a href="{{url('user/create')}}"><button type="button" class="btn btn-primary">Add User</button></a>
					<a href="{{url('user/index')}}" id='reset' class="btn-space"><button type="button" class="btn btn-primary">Reset</button></a>
				</div> -->
			</div>
		</div>
		<div class="m-portlet__body">
		<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
				<thead class='m-datatable__head'>
					<tr class="m-datatable__row">
						<th style="width: 10%" class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>ID</th>
						<th class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>First Name</th>
						<th class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>Last Name</th>
						<th class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>Contect Number</th>
						<th style="width: 10%" class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>Date of Birth</th>
						<th style="width: 10%" class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>Email</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
		<!-- END EXAMPLE TABLE PORTLET-->
		<<!-- div class="modal fade" id="m_typeahead_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">User Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="la la-remove"></span>
					</button>
				</div>
				<form class="m-form m-form--fit m-form--label-align-right" id="view_user_form">
					<div class="modal-body">
						<div class="form-group m-form__group row m--margin-top-20">
							<div class="col-lg-6">
								<label>First name</label>
								<input class="form-control m-input" id="f_name" disabled type="text">
							</div>
							<div class="col-lg-6">
								<label>Last name</label>
								<input class="form-control m-input" id="l_name" disabled type="text">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>User role</label>
								<input class="form-control m-input" id="user_role" disabled type="text">
							</div>
							<div class="col-lg-6">
								<label>Email</label>
								<input class="form-control m-input" id="email" disabled type="email">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>Contact number</label>
								<input class="form-control m-input" id="contact_num" disabled type="text">
							</div>
							<div class="col-lg-6">
								<label>Date of birth</label>
								<input class="form-control m-input" id="dob" disabled type="text">
							</div>
						</div>
						<div class="form-group m-form__group row m--margin-bottom-20">
							<div class="col-lg-6">
								<label>User profile</label><br>
								<img src="" height="150px" width="200px" id="user_image">
							</div>
							<div class="col-lg-6">
								<label>Approved member</label><br>
								<span class="m-badge  m-badge--success m-badge--wide active">Approved</span>
								<span class="m-badge  m-badge--danger m-badge--wide inactive">Disapproved</span>
								<span class="m-badge  m-badge--danger m-badge--wide pending">Pending</span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-brand m-btn" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div> -->
</div>
@stop
@push('scripts')
<!-- <script type="text/javascript" src="{{asset('js/UserFormValidation.js')}}"></script> -->
<script>
	$(function() {
	    var user_table = $('#m_table_2').DataTable({
	    	lengthMenu:{{env('PAGE_LIST')}},
	        processing: true,
	        serverSide: true,
	        order: [ [0, 'desc'] ],
	        ajax: '{!! url('report-management/data') !!}',
	        columns: [
	            { data: 'id', name: 'id' },
	           /* { data: 'user_role_id', name: 'user_role_id' },*/
	            { data: 'first_name', name: 'first_name' },
	            { data: 'last_name', name: 'last_name' },
	            { data: 'contact_number', name: 'contact_number' },
	            { data: 'dob', name: 'dob' },
	            { data: 'email', name: 'email' },

	        ]	         
	    }); 
	    // $('<label style="margin-left: 10px;">Filter by ' +
	    //     '<select class="" id="user_status">'+
	    //         '<option value="">Select status</option>'+
	    //         '<option value="Y">Active</option>'+
	    //         '<option value="N">Inactive</option>'+
	    //     '</select>' + 
	    //     '</label>').appendTo("#m_table_2_wrapper #m_table_2_length");
		
		// $('#user_status').on('change', function(){
	 //  		var filter_value = $(this).val();
	 //  		var new_url = "{!! url('user/data')!!}"+'/'+filter_value;
	 //  		user_table.ajax.url(new_url).load(); 
		// });

		// $('#reset').on('click',function(e){        
  //       	e.preventDefault();       
  //       	$('#user_status').val('');
  //       	$('#user_status').trigger('change');
  //       	$('#m_table_2').DataTable().search('').draw();
  //   	}); 	
	});
	</script>
	<script src="{{asset('assets/demo/custom/crud/forms/widgets/typeahead.js')}}" type="text/javascript"></script>
@endpush
