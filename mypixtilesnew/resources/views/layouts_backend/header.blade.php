<head>
	<meta charset="utf-8" />
	<title>Mypixtiles | {{$title}}</title>
	 <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="State colors">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!--end::Web font -->

	<!--begin:: Global Mandatory Vendors -->
	<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->

	<link href="{{asset('vendors/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />

	<!--end:: Global Mandatory Vendors -->

	<!--begin:: Global Optional Vendors -->

	<link href="{{asset('vendors/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/nouislider/distribute/nouislider.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/owl.carousel/dist/asset/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/owl.carousel/dist/asset/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/animate.css/animate.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/jstree/dist/themes/default/style.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/chartist/dist/chartist.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/vendors/flaticon/css/flaticon.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/vendors/metronic/css/styles.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('vendors/vendors/fontawesome5/css/all.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

	<!--end:: Global Optional Vendors -->

	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

	<!--begin::Global Theme Styles -->
	<link href="{{asset('assets/demo/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	
	<link href="{{asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
	<!--RTL version:<link href="../../asset/demo/base/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />-->

	<!--begin::Page Vendors Styles -->
	<link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

	<link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	
	
	<!--RTL version:<link href="../../../assets/vendors/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
	
	<!--end::Global Theme Styles -->
	
	<link rel="shortcut icon" href="{{asset('assets/demo/media/img/logo/favicon.ico')}}" />
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<script src="{{asset('vendors/jquery/dist/jquery.js')}}" type="text/javascript"></script>
	<script type="text/javascript" src="{{asset('js/EmployeeForm.js')}}"></script>
</head>