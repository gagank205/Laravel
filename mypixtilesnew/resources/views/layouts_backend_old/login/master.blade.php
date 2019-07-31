<!DOCTYPE html>
<html lang="en">
@include('layouts_backend.login.header')

	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url('http://192.168.1.135/theme_metronic/public/assets/app/media/img/bg/bg-3.jpg')">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="{{asset('assets/app/media/img/logos/logo-1.png')}}">
							</a>
						</div>
						@yield('content')					
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin:: Global Mandatory Vendors -->
		@include('layouts_backend.login.footer')

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>