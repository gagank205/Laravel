@extends('layouts.my-app') 
@extends('layouts.frant')  
@section('content')
<body>
	 <section class="container structure">
	<input type="hidden" name="klarna" id="klarna_id" value="<?php echo $_GET['sid'] ?>">
	<header class="site-header" id="header">
		<h1 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h1>
	</header>

	<div class="main-content">
		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
		<p class="main-content__body" data-lead-id="main-content-body">Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being you.</p>
	</div>

	<footer class="site-footer" id="footer">
		<p class="site-footer__fineprint" id="fineprint">Copyright ©2014 | All Rights Reserved</p>
	</footer>
	 <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			var karna = $('#klarna_id').val();

			$.ajax({

				 url: "{{ url('/thankyou_user') }}",
				 data: { karna_id:karna },
				 type: 'GET',
				  success: function(response){ 
				  		
            	  }
			});
		
		});

	</script>
</section>

</body>
</html>
 @endsection