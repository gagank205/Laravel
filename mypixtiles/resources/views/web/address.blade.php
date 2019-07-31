@extends('layouts.my-app')
@extends('web.header')
@section('content')
<body>

	 <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->get('success'))
            <div class="col-12 pull-right">
            <div class="alert alert-success alert-dismissible fade show elementToFadeInAndOut" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                {{ session()->get('success') }}
            </div>
            </div>
            @elseif(session()->get('error'))
            <div class="col-12 pull-right">
            <div class="alert alert-danger alert-dismissible fade show elementToFadeInAndOut" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                {{ session()->get('error') }}
            </div>
            </div>
            @endif
             </div>
              </div>

	<section class="form-head">



		<div class="bck-btn"><a href="http://localhost/mypixtiles_laravel/public/web"><i class="fa fa-angle-left"></i></a></div></section>

		<div class="container-fluid">
			
			<form action="{{route('edit_shipping')}}" method="post">
			<div class="row">
				<div class="col-md-6">
					<h2><u>Shipping Management</u></h2>
						<div class="form-group">
							{{csrf_field()}}
							<label>Fullname</label>
							<input type="text" name="shipping_fullname" value="@if(!empty($shipping->fullname)){{$shipping->fullname}}@endif" class="form-control"  required autofocus>
							 @if ($errors->has('shipping_fullname'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('shipping_fullname') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>address</label>
							<input type="text" name="shipping_address" value="@if(!empty($shipping->address)){{$shipping->fullname}}@endif" class="form-control"   required>
							 @if ($errors->has('shipping_address'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('shipping_address') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>Country</label>
							<select  required class="form-control" name="shipping_country" onchange="select_state(this.value)">
								<option value="">Select Country</option>
								@if(!empty($country))
								@foreach($country as $conu)
									<option value="<?php echo $conu->id;?>"
									<?php if(!empty($shipping->country)){ if($shipping->country ==$conu->id){?> SELECTED <?php  }  }  ?>>{{$conu->name}}</option>
								@endforeach
									@endif
							</select>
							 @if ($errors->has('shipping_country'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('shipping_country') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>State</label>
							<select required class="form-control" name="shipping_state" onchange="select_city(this.value)" id="state"> 
									<option value="">Select State</option>
							@if(!empty($shipping_state))
								@foreach($shipping_state as $sstate)
									<option value="{{$sstate->id}}" <?php if(!empty($shipping->id) && $sstate->id == $shipping->state){ ?> SELECTED <?php } ?> >{{$sstate->name}}</option>
								@endforeach
							@endif
							</select>
							 @if ($errors->has('shipping_state'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('shipping_state') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>City</label>
							<select  required class="form-control" name="shipping_city" id="city">
								<option value="">Select City</option>
								@if(!empty($shipping_city))
									@foreach($shipping_city as $scity)
										<option value="{{$scity->id}}" <?php if(!empty($shipping->id)){ if($shipping->city == $scity->id){ ?> SELECTED <?php } } ?>>{{$scity->name}}</option>
									@endforeach
								@endif
							</select>
							 @if ($errors->has('shipping_city'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('shipping_city') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>postal_code</label>
							<input required type="text" name="shipping_postal_code" value="@if(!empty($shipping->address)){{$shipping->postal_code}}@endif" class="form-control">
							 @if ($errors->has('shipping_postal_code'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('shipping_postal_code') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>mobile</label>
							<input required type="text" name="shipping_mobile" value="@if(!empty($shipping->address)){{$shipping->mobile}}@endif" class="form-control">
							 @if ($errors->has('shipping_mobile'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('shipping_mobile') }}</strong>
		                        </span>
		                    @endif
						</div>
				</div>
				<div class="col-md-6">
					<h2><u>Billing Management</u></h2>	
						<div class="form-group">
							<label>Fullname</label>
							<input  required type="text" name="booking_fullname" value="@if(!empty($billing->address)){{$billing->fullname}}@endif" class="form-control">
							 @if ($errors->has('booking_fullname'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('booking_fullname') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>address</label>
							<input required type="text" name="booking_address" value="@if(!empty($billing->address)){{$billing->fullname}}@endif" class="form-control">
							 @if ($errors->has('booking_address'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('booking_address') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>Country</label>
							<select required class="form-control" name="booking_country" onchange="select_book_state(this.value)">
								<option value="">Select Country</option>
									@if(!empty($coun))
								@foreach($coun as $country)
									<option value="<?php echo $country->id;?>"
									<?php if(!empty($billing->country)){ if($billing->country ==$country->id){?> SELECTED <?php  }  }  ?>>{{$country->name}}</option>
								@endforeach
								@endif
							</select>
							 @if ($errors->has('booking_country'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('booking_country') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>State</label>
							<select required class="form-control" name="booking_state" onchange="select_book_city(this.value)" id="bookstate"> 
								<option value="">Select State</option>
								@if(!empty($billing_state))
								@foreach($billing_state as $bstate)
									<option value="{{$bstate->id}}" <?php if(!empty($billing->id) && $bstate->id == $billing->state){ ?> SELECTED <?php } ?> >{{$bstate->name}}</option>
								@endforeach
							@endif
							</select>
							 @if ($errors->has('booking_state'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('booking_state') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>City</label>
							<select required class="form-control" name="booking_city" id="bookcity">
								<option value="">Select City</option>
								@if(!empty($billing_city))
									@foreach($billing_city as $bcity)
										<option value="{{$bcity->id}}" <?php if(!empty($billing->city)){ if($bcity->id == $billing->city) {?>SELECTED <?php  } } ?>>{{$bcity->name}}</option>
									@endforeach
								@endif
							</select>
							 @if ($errors->has('booking_city'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('booking_city') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>postal_code</label>
							<input required type="text" name="booking_postal_code" value="@if(!empty($billing->postal_code)){{$billing->fullname}}@endif" class="form-control">
							 @if ($errors->has('booking_postal_code'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('booking_postal_code') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<label>mobile</label>
							<input required type="text" name="booking_mobile" value="@if(!empty($billing->address)){{$billing->mobile}}@endif" class="form-control">
							 @if ($errors->has('booking_mobile'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('booking_mobile') }}</strong>
		                        </span>
		                    @endif
						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="Submit" class="btn btn-info">
						</div>
					
				</div>
				
			</div>
			</form>
		</div>
        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
		<script src="{{url('new/slick/slick.js')}}" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
    		$(document).on('ready', function() {
        		$(".center").slick({
            	dots: true,
            	infinite: true,
            	centerMode: true,
            	slidesToShow: 3,
            	slidesToScroll: 1
        	});
        	$(".variable").slick({
            	dots: true,
            	infinite: true,
            	variableWidth: true
        	});
        		$(".lazy").slick({
           	 		lazyLoad: 'ondemand', // ondemand progressive anticipated
           	 		infinite: true
        	});
    	});

    	function select_state(id)
    	{
    		$.ajax({
    			url:"{{url('state')}}",
    			method: 'GET',
    		   dataType: 'html',
    			data: { country_id:id },
    	     contentType: "application/json; charset=utf-8",
    			success:function(res){
    				console.log(res);
    				setTimeout(function(){ $('#state').html(res); }, 100);
    			}	

    		});
    	}

    	function select_city(id)
    	{
    		$.ajax({
    			url:"{{url('city')}}",
    			method: 'GET',
    			dateType: 'html',
    			data: { state_id:id },
    	     contentType: "application/json; charset=utf-8",
    			success:function(res){ 

    			//	console.log(res.html);
    					setTimeout(function(){  $('#city').html(res); }, 1000);
    				
    			}	

    		});
    	}

    	function select_book_state(id)
    	{
    		$.ajax({
    			url:"{{url('state')}}",
    			method: 'GET',
    		   dataType: 'html',
    			data: { country_id:id },
    	     contentType: "application/json; charset=utf-8",
    			success:function(res){
    				console.log(res);
    				setTimeout(function(){ $('#bookstate').html(res); }, 100);

    				
    			}	

    		});
    	}

    	function select_book_city(id)
    	{
    		$.ajax({
    			url:"{{url('city')}}",
    			method: 'GET',
    			dateType: 'html',
    			data: { state_id:id },
    	     contentType: "application/json; charset=utf-8",
    			success:function(res){ 

    			//	console.log(res.html);
    					setTimeout(function(){  $('#bookcity').html(res); }, 1000);
    				
    			}	

    		});
    	}

</script>
        
    </body>

    </html>
      @endsection