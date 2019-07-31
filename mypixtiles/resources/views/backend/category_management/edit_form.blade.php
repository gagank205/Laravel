@extends('layouts_backend.masters',['title'=>'Category Management'])
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
<div class="m-subheader ">

	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">Category Management</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="{{ROUTE('dashboard')}}" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>				
				<li class="m-nav__item">
					<a href="{{url('category-management/index')}}" class="m-nav__link">
						<span class="m-nav__link-text">Category Management</span>
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
								Edit Product Category
							</h3>
						</div>
					</div>
					<div class="pull-right back-btn">
						<a href="{{url('category-management/index')}}"><button type="button" class="btn btn-primary">Back</button></a>
					</div>
				</div>

				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" 
				action="{{ route('category-management.update',$category_data->id)}}" name="category_form" id="category_form" 
				enctype="multipart/form-data">
					@csrf
					@method('PATCH')
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>Product Category Name:</label>
								<input type="text" class="form-control m-input" maxlength='60' name="name" placeholder="Enter product category name" value="{{$category_data->name}}">
								<span class="m-form__help error name"></span>
							</div>
						</div>
						<div class="form-group m-form__group row">							
							<div class="col-lg-4">
								<label>Product Category Icon</label>
								<input id="file-1" type="file" name="image" class="file" data-min-file-count="1" 
								value="{{url('/media/categoryicon',$category_data['category_icon'])}}">
								<span class="m-form__help error category_icon"></span>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" name="category_submit" id="category_submit" class="btn btn-primary">Save</button>
									<a href="{{url('category-management/index')}}">
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
<script type="text/javascript" src="{{asset('js/CategoryFromValidation.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
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
            remove :true,
            allowedFileExtensions: ['jpg','jpeg', 'png', 'gif'],
            initialPreview:"{{url('media/categoryicon',$category_data->category_icon)}}",
            initialPreviewAsData:true,
            overwriteInitial: true,
            maxFileSize:2000,
            maxFilesNum: 1,
            initialPreviewConfig:{overwriteInitial: true},
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
    </script>
@endpush