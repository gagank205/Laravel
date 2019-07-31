@extends('layouts_backend.masters',['title'=>'Category Management'])
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
      <h3 class="m-subheader__title m-subheader__title--separator">Review Rating</h3>
      <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
          <a href="{{ROUTE('dashboard')}}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
          </a>
        </li>       
        
        <li class="m-nav__item">
          <span class="m-nav__link-text">Review Rating</span>
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
          <!-- <a href="{{url('category-management/create')}}"><button type="button" class="btn btn-primary">Add Restaurant</button></a> -->
          <a href="{{url('category-management/index')}}"  id='reset'  class="btn-space"><button type="button" class="btn btn-primary">Reset</button></a>
        </div>
      </div>
    </div>
    <div class="m-portlet__body">
    <!--begin: Datatable -->
      <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
        <thead>
          <tr>
            <th style="width: 10%">ID</th>
            <th style="width: 10%">Branch Name</th>
            <th style="width: 10%">User Name</th>
            <th style="width: 10%">Star</th>
            <th style="width: 10%">Comments</th>
            <th style="width: 10%">Status</th>
            <th style="width: 20%">Actions</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>  
@stop
@push('scripts')
<script type="text/javascript" src="{{asset('js/CategoryFromValidation.js')}}"></script>

<script>
  $(function() {
      var category_table = $('#m_table_2').DataTable({
        lengthMenu:{{env('PAGE_LIST')}},
          processing: true,
          serverSide: true,
          order: [ [0, 'desc'] ],
          ajax: '{!! url('review-rating/data') !!}',
          columns: [
              { data: 'id', name: 'id' },
              { data: 'branch_name_en', name: 'branch_name_en' },
              { data: 'first_name_en', name: 'first_name_en ' },
              { data: 'star', name: 'star' },
               { data: 'comments', name: 'comments' },
              { data: 'status', name: 'status' },
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });
      // $('<label style="margin-left: 10px;">Filter by ' +
      //     '<select class="" id="category_status">'+
      //         '<option value="">Select status</option>'+
      //         '<option value="Y">Active</option>'+
      //         '<option value="N">Inactive</option>'+
      //     '</select>' + 
      //     '</label>').appendTo("#m_table_2_wrapper #m_table_2_length");
    
    $('#category_status').on('change', function(){
      var filter_value = $(this).val();
        var new_url = "{!! url('category-management/data')!!}"+'/'+filter_value;
        category_table.ajax.url(new_url).load();
    });
     $('#reset').on('click',function(e){        
          e.preventDefault();       
          $('#category_status').val('');
          $('#category_status').trigger('change');
          $('#m_table_2').DataTable().search('').draw();
      });
  });
  </script>
@endpush
