@extends('layouts.my-app') 
@extends('layouts.frant')  
@section('content')

<body>
  
<section class="logo-section">

	<div class="container-fluid">
		<div class="col-md-6 col-xs-12 col-sm-12 logo_image">
			<img src="{{asset('new_frant/images/logo.png')}}">
		</div>

		<div class="col-md-6 col-xs-12 col-sm-12 logo_image">
			<button type="button" onclick="window.location='{{route("/review/data/")}}'">Create Your Pixtile</button>
		</div>
	</div>

</section>

<!-- second-section -->

<section class="second__section__bg_color">
	<div class="container-fluid"> 
	   <div class="clearfix">
		  <div class="col-md-6 col-xs-12 col-sm-12 logo_image1">
			 <p style="padding-top: 100px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>	
			<button type="button" onclick="window.location = '{{route("/review/data/")}}'">Create Your Pixtile</button>
		  </div>

		 <div class="col-md-6 col-xs-12 col-sm-12 side_image">
			<img src="{{asset('new_frant/images/side_image.png')}}">
		 </div>		
	   </div>
	</div>
</section>

<h2 class="center__text">Pixtiles are 20x20cm and cost only 120 kr/each</h2>

<section class="card_image">

	<div class="container">
		<div class="clearfix">
			<div class="col-md-4 col-xs-12 col-12 three_image">
				<div class="card_image__text">
					<img src="{{asset('new_frant/images/side_image.png')}}">
					<span> <i class="fa fa-camera" aria-hidden="true"></i> Simple </span>
					<p>Easy to mound and very good quality.</p>
			   </div>
		   </div>

			<div class="col-md-4 col-xs-12 col-12 three_image">
				<div class="card_image__text">
				<img src="{{asset('new_frant/images/side_image.png')}}">
				<span> <i class="fa fa-camera" aria-hidden="true"></i> Simple </span>
				<p>Easy to mound and very good quality.</p>
			</div>
		</div>

			<div class="col-md-4 col-xs-12 col-12 three_image">
				<div class="card_image__text">
				<img src="{{asset('new_frant/images/side_image.png')}}">
				<span> <i class="fa fa-camera" aria-hidden="true"></i> Simple </span>
				<p>Easy to mound and very good quality.</p>
			</div>
			</div>
		</div>
		
	</div>
</section>

<section>
	<div class="container">
  <div class="col-md-12">
    <div class="Pitch-pricing" style="text-align: center;"> 
        <h2 class="perfact_size">One perfect size</h2>
        <h3>Tiles are 8" by 8". They're removable, reusable and leave no marks.</h3>
    </div>
  </div>
  <div class="col-md-12" style="text-align: center;"> 
    <div class="stars">
      <img src="{{url('new/images/stars.png')}}" class="img-fluid">
    </div>
    <br/>
    <div class="subtitle">4.8 STARS, 10,000+ APP STORE REVIEWS </div>
    <div class="Pitch-guarantee">You'll love our product or we'll return your money</div> 
  </div>
</div>
</section>

<section class="footer__section__link">
	<div class="container">
  <center>	
  <div class="bottom-menu">
     <!--  <table id="footer_mene">
      	<tr>
      		<td><a href="#" target="_blank">Jobs</a></td>
      		<td>|</td>
      		<td><a href="#" target="_blank">Terms of use</a></td>
      		<td>|</td>
      		<td><a href="#" target="_blank">Privacy Policy</a></td>
      		<td>|</td>
      		<td><a href="#" target="_blank">Impressum</a></td>
      		<td>|</td>
      		<td><a href="#" target="_blank">Contact</a></td>
      	</tr>
      </table> -->
      <ul>
      	<li><a href="#" target="_blank">Jobs</a></li>
      	<li><a href="#" target="_blank">Terms of use</a></li>
      	<li><a href="#" target="_blank">Privacy Policy</a></li>
      	<li><a href="#" target="_blank">Impressum</a></li>
      	<li><a href="#" target="_blank">Contact</a></li>
      </ul>
    </div> 
  </center>

</section>



</body>
</html>
@endsection

