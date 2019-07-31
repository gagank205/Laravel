@extends('layouts_backend.masters',['title'=>'Dashboard Management'])
@section('content')
<div class="m-subheader">
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
</div>
<div class="container">
<section class="content">
	  <!---//////////////////////--->
      <div class="row" style="background-color: white;">
        <div class="col-12 ">
          	<div class="box">
              <div class="row no-gutters py-2">
                <div class="col-sm-6 col-lg-3">
                  <div class="border-light">
                  	<span class="text-primary" style="font-size: 30px; margin-left: 20px;">Total users {{$user}}</span>
                    <div class="flexbox mb-1" style="margin-top:12px;">
                      <span>
                        <img src="{{asset('media/icon/user.png')}}">
                        User List
                      </span>
                    </div>
                    <div class="progress progress-xxs mt-10 mb-0">
                      <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="border-light">
                  	<span class="text-primary" style="font-size: 30px; margin-left: 20px;">Total Member {{$member}}</span>
                    <div class="flexbox mb-1" style="margin-top:12px;">
                      <span>
                        <img src="{{asset('media/icon/user.png')}}">
                        Member List
                      </span>
                    </div>
                    <div class="progress progress-xxs mt-10 mb-0">
                      <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="border-light">
                  	<span class="text-primary" style="font-size: 30px; margin-left: 20px;">Total Coupon {{$coupon}}</span>
                    <div class="flexbox mb-1" style="margin-top:12px;">
                      <span>
                        <img src="{{asset('media/icon/coupon.png')}}">
                        Coupon List
                      </span>
                    </div>
                    <div class="progress progress-xxs mt-10 mb-0">
                      <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="border-light">
                  	<span class="text-primary" style="font-size: 30px; margin-left: 20px;">Total Frame {{$frame}}</span>
                    <div class="flexbox mb-1" style="margin-top:12px;">
                      <span>
                        <img src="{{asset('media/icon/frame.png')}}">
                        Frame List
                      </span>
                    </div>
                    <div class="progress progress-xxs mt-10 mb-0">
                      <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
        </div>
        
      </div>  
	</section>
</div>


@endsection
@push('scripts')
	<script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
	<script type="text/javascript" src="{{asset('js/dashboard.js')}}"></script>
	<input type="hidden" name="txt_url" value="{{ROUTE('dashboard.all')}}">
@endpush
