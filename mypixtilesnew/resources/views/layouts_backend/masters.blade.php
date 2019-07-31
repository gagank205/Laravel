<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
@include('layouts_backend.header',['title'=>$title??''])
<!-- end::Head -->
<!-- begin::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" id="top">
	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
        @include('layouts_backend.header-bar')
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            @include('layouts_backend.sidebar_new')

            @include('layouts_backend.contenct')
        </div>
        @include('layouts_backend.footer')
    </div>
    <a href="#top" id="bottom">
        <div id="m_scroll_top" class="m-scroll-top">
            <i class="la la-arrow-up"></i>
        </div>
    </a>
		 @stack('scripts')
</body>

<!-- end::Body -->
</html>
<script type="text/javascript">
    $('#bottom').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    });
</script>