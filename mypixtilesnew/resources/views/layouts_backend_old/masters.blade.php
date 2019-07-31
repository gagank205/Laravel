<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
@include('layouts_backend.header')
<!-- end::Head -->
<!-- begin::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<!-- BEGIN: Header -->
		@include('layouts_backend.header-bar')
		<!-- END: Header -->
		<!-- begin::Body -->
		@include('layouts_backend.sidebar')
		@include('layouts_backend.contenct')
	</div>
</div>
<!-- end:: Body -->
<!-- begin::Footer -->
@include('layouts_backend.footer')

</body>

<!-- end::Body -->
</html>