@extends('layouts_backend.masters',['title'=>'Userrole Management'])
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
			<h3 class="m-subheader__title m-subheader__title--separator">User Role Management</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="{{ROUTE('dashboard')}}" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>								
				<li class="m-nav__item">
					<span class="m-nav__link-text">User Role Management</span>
				</li>				
			</ul>
		</div>
	</div>
</div>

<!-- END: Subheader -->
<div class="m-content">		
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<a href="{{url('userrole/create')}}"><button type="button" class="btn btn-primary">Add Role</button></a>
					<a href="{{url('userrole/index')}}"  id='reset'  class="btn-space"><button type="button" class="btn btn-primary">Reset</button></a>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
		<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
				<thead class='m-datatable__head'>
					<tr class="m-datatable__row">
						<th style="width: 10%" class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>ID</th>
						<th style="width: 30%" class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>User Role</th>						
						<th style="width: 10%" class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>Status</th>
						<th style="width: 20%" class='m-datatable__cell--center m-datatable__cell m-datatable__cell--check'>Actions</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
		<!-- END EXAMPLE TABLE PORTLET-->
</div>	
@stop
@push('scripts')
<script type="text/javascript" src="{{asset('js/UserroleFromValidation.js')}}"></script>
<script>
	$(function() {
	    var userrole_table = $('#m_table_2').DataTable({
	    	lengthMenu:{{env('PAGE_LIST')}},
	        processing: true,
	        serverSide: true,
	        order: [ [0, 'desc'] ],
	        ajax: '{!! url('userrole/data') !!}',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'user_role', name: 'user_role' },	            
	            { data: 'status', name: 'status' },	            
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	        ]
	    });
	    /*$('<label style="margin-left: 10px;">Filter by ' +
	        '<select class="" id="userrole_status">'+
	            '<option value="">Select status</option>'+
	            '<option value="Y">Active</option>'+
	            '<option value="N">Inactive</option>'+
	        '</select>' + 
	        '</label>').appendTo("#m_table_2_wrapper #m_table_2_length");
	     */
	    $('#userrole_status').on('change', function(){
	  		var filter_value = $(this).val();	  		
	  		var new_url = "{!! url('userrole/data')!!}"+'/'+filter_value;
	  		userrole_table.ajax.url(new_url).load(); 
		});

	    $('#reset').on('click',function(e){        
        	e.preventDefault();       
        	$('#userrole_status').val('');
        	$('#userrole_status').trigger('change');
        	$('#m_table_2').DataTable().search('').draw();
    	});
	});
	</script>
@endpush
