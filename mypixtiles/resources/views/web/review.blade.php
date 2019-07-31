@extends('web.header')
@extends('layouts.my-app') 
<!-- @extends('layouts.frant') -->  
@section('content')

<!-- <html lang="en"> -->

<!-- -->

<!-- <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mypixtiles</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet'
        type='text/css'> -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->


   <!--  <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/file-upload.css">
    <script src="./js/dropzone.js"></script> -->
<!-- </head> -->
<style type="text/css">
    #shipping_form input {
      border: 1px solid #e4e4e4;
      font-weight: 100;
    }
    #shipping_form textarea {
      border: 1px solid #e4e4e4;
      font-weight: 100;   
    }
</style>
<body class="review-bg">
    <div class="container-fluid" style="border-bottom: 2px solid #e2e2e2;">
        <div class="row review-head">
            <!-- <div class="col-md-2 col-sm-2 col-sx-2">
                <div class="bck-btn">
                    <a href="{{url('/web')}}"><i class="fa fa-angle-left"></i></a>
                </div>
            </div> -->
            <div class="col-md-12 col-sm-12 col-sx-12">
                <div class="review-head">
                    <h6>Style Photos</h6>
                    <div class="row img-row">
                        @foreach($cms_data as $post)
                        <div class="frame">
                            <!-- <img src="{{url('new/images/cleanIcon.svg')}}" class="img-fluid" id="clean"> -->
                            <img  indexid="{{$post->id}}"  src="{{url('media/frame/'.$post->frame_image)}}" class="img-fluid" id="{{$post->title}}" style="width: 75px;height: 75px;">
                            <p>{{$post->title}}</p>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            
            <!-- <div class="col-md-2 col-sm-2 col-sx-2">
                <div class="form-menu">
                    <div class="dropdown ">
                        <img src="{{url('new/images/menuIcon.svg')}}" onclick="myFunction()" class="dropbtn">
                        <div id="myDropdown" class="dropdown-content">
                            <a href="#" data-toggle="modal" data-target="#myModal">Frequent Questions</a>
                            <a href="#" data-toggle="modal" data-target="#myCode">Add Promo Code</a>
                            </ul>
                        </div>
                        <script>
                            function myFunction() {
                                document.getElementById("myDropdown").classList.toggle("show");
                            }
                            window.onclick = function (event) {
                                if (!event.target.matches('.dropbtn')) {
                                    var dropdowns = document.getElementsByClassName("dropdown-content");
                                    var i;
                                    for (i = 0; i < dropdowns.length; i++) {
                                        var openDropdown = dropdowns[i];
                                        if (openDropdown.classList.contains('show')) {
                                            openDropdown.classList.remove('show');
                                        }
                                    }
                                }
                            }
                        </script>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <div class="from-bg" style="">
        <div class="col-md-12" style="">
            @if(session()->get('success'))
                <div class="col-4 pull-right"></div>
                <div class="col-5 pull-right">
                <div class="alert alert-success alert-dismissible fade show elementToFadeInAndOut" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                    {{ session()->get('success') }}
                </div>
                </div>
                @elseif(session()->get('error'))
                <div class="col-4 pull-right"></div>
                <div class="col-5 pull-right">
                <div class="alert alert-danger alert-dismissible fade show elementToFadeInAndOut" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                    {{ session()->get('error') }}
                </div>
                </div>
                @endif
        </div> 
        <div class="container img-container" style="margin-top: 40px;">
            <div class="gallery row">
                 @foreach($cms as $cs)
                <div class="col-sm-6 col-md-3" style="margin:10px">
                    <div class="image-wrap">
                        <div class="image-frame" onClick="ShowModal(this)" data-id="{{$cs->id}}" data-name="{{url('media/cart/'.$cs->customize_frame)}}">
                            
                        </div>
                        @if($cs->image_type == 'fb')
                          <img src="{{$cs->customize_frame}}" class="img-Cart" style="width:200px" >
                        @elseif($cs->image_type == 'google_photo')
                          <img src="{{$cs->customize_frame}}" class="img-Cart" style="width:200px" >
                        @else
                          <img src="{{url('media/cart/'.$cs->customize_frame)}}" class="img-Cart" style="width:200px" >
                        @endif
                    </div>
                </div>
                 @endforeach
              
              
            </div>
        </div>
        <div class="no-tiles-placeholder show parent" style="margin-top: 30px;">
            <div class="no-tiles-text">Pick some photos!</div>
            <div class="SquareUploadButton animated">
                <div class="plus-icon first">
                    <svg viewBox="0 0 37.76 38.93">
                        <path fill="rgb(176,176,176)" class="plus-shape"
                            d="M21.22,0V17.2H37.76v4.39H21.22V38.93H16.54V21.59H0V17.2H16.54V0Z"></path>
                    </svg>
                </div>
               <div class="second"> 
                    <div class="split">
                        <div class="img-uplod-split">
                            <div class="">
                                <div class="drop-zone" aria-disabled="false" style="position: relative;">
                                <img class="icon" src="{{url('new/images/uploadIcon.svg')}}"><strong>Upload Photos</strong>
                                <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
                                    {!! csrf_field() !!} 
                                    <input accept="image/*" type="file"  name="image_upload[]" multiple="" autocomplete="off"
                                    style="position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; opacity: 1e-05; " id="gallery-photo-add" >
                                </form>
                                 
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="button bottom ">
                        <div class="cloud-icons">
                          <!--   <a href="{{url('facebookLogin')}}"><img class="cloud-icon smaller" src="{{url('new/images/facebook.svg')}}" ></a> -->

                            <img class="cloud-icon smaller" src="{{url('new/images/facebook.svg')}}"  id="facebook_image">

                            <img class="cloud-icon smaller" src="{{url('new/images/instagram.svg')}}">
                            <!-- <button onclick="authenticate().then(loadClient)">authorize and load</button> -->
                            <img class="cloud-icon smaller" onclick="authenticate().then(loadClient)" src="{{url('new/images/googlephotos.svg')}}" id="google_photo" >
                            <img class="cloud-icon smaller" src="{{url('new/images/googledrive.svg')}}">
                        </div>
                        <div class="text">Choose from Online Services</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    
            




<section style="padding: 30px 0px 30px 0px;background: #e76369;">
<div class="checkout">
    <div class="footer-btn check_out">
       Checkout
    </div>
</div>

<div class="place_order">
    <div class="col-md-12 order">
               <button class="col-md-12 form-control" data-toggle="modal" data-target="#myCode" style="background: none;border: none;text-align: left;color: #fff;border-bottom: 1px solid #fff;" ><i class="fa fa-home"></i> Add Promo Code</button>
        <button class="col-md-12 form-control" style="background: none;border: none;text-align: left;color: #fff;border-bottom: 1px solid #fff;" onClick="ShippingModal(this)"><i class="fa fa-home"></i> Add Shipping Address</button>
        <button class="col-md-12 form-control" style="background: none;border: none;text-align: left;color: #fff;border-bottom: 1px solid #fff;" onClick="BillingModal(this)"><i class="fa fa-home"></i> Add Billing Address</button>
        <button class="col-md-12 form-control" style="background: none;border: none;text-align: left;color: #fff;border-bottom: 1px solid #fff;margin-bottom: 20px;"  onClick="PaymentModal(this)"><i class="fa fa-shopping-cart"></i> Add Payment Method</button>
        <div class="form-group">
    <form action="{{url('add_order_cod')}}" method="get">
            <input type="hidden" name="user_id" value="{{Session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')}}"> 
            <input type="hidden" class="form-control" id="or"
                aria-describedby="emailHelp" name="cod">
            <input type="submit" class="btn btn-lg footer-btn" style="width: 400px;" id="or" value="Place Order">
    </form>
        </div>
    </div>
    <!-- <div class="footer-btn">
        Place Order
    </div> -->
</div>
       <!--  <div class="footer-section" data-toggle="modal" data-target="#myCheckout" style="border-bottom: 2px solid #e2e2e2;">
            <div class="footer-btn">
                <a href="#">Checkout</a>
            </div>
        </div> -->
</section>

    <!-- Frequent Questions -->
    <div class="container">
        <!-- Button to Open the Modal -->
        <!-- <button type="button"  data-toggle="modal" data-target="#myModal">
              Open modal
            </button> -->
        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3 class="modal-title">Frequent Questions</h3>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <h5>How much do Mixtiles cost?</h5>
                        <p>Each order starts with $58 for the first 3 tiles, then $12 for each additional tile in that
                            set. So for example, an order of 6 tiles would be $94. Prices are in USD.</p>

                        <h5>How big are the tiles?</h5>
                        <p>They’re about 20 by 20 cm and 2 cm thick (8 by 8 inches and just under an inch thick).</p>

                        <h5>Have you got any other sizes?</h5>
                        <p>Not for now, but we'd love to. Hopefully soon!</p>

                        <h5>How long does shipping take?</h5>
                        <p>Usually about a week. In some countries it takes a little longer, but the app will show you
                            your expected delivery date before you confirm your order.</p>

                        <h5>How do Mixtiles work?</h5>
                        <p>There are sticky pads on the back of them. You peel off the protective paper and stick them
                            on the wall. Easy as pie! (We enjoy pie.</p>.
                        <h5>How much do Mixtiles cost?</h5>
                        <p>Each order starts with $58 for the first 3 tiles, then $12 for each additional tile in that
                            set. So for example, an order of 6 tiles would be $94. Prices are in USD.</p>

                        <h5>How big are the tiles?</h5>
                        <p>They’re about 20 by 20 cm and 2 cm thick (8 by 8 inches and just under an inch thick).</p>

                        <h5>Have you got any other sizes?</h5>
                        <p>Not for now, but we'd love to. Hopefully soon!</p>

                        <h5>How long does shipping take?</h5>
                        <p>Usually about a week. In some countries it takes a little longer, but the app will show you
                            your expected delivery date before you confirm your order.</p>

                        <h5>How do Mixtiles work?</h5>
                        <p>There are sticky pads on the back of them. You peel off the protective paper and stick them
                            on the wall. Easy as pie! (We enjoy pie.</p>

                        <!-- Modal footer -->
                    </div>

                </div>
            </div>
        </div>

    </div>


    <!-- Promo Code coupon -->
    <div class="container">
        <!-- Button to Open the Modal -->
        <!-- <button type="button"  data-toggle="modal" data-target="#myModal">
              Open modal
            </button> -->
        <!-- The Modal -->
        <div class="modal" id="myCode" style="z-index: 9999;">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-code">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3 class="modal-title">Add Promo Code</h3>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <!-- <div class="bottom-button-container">
                        <button type="submit">Done</button>
                    </div> -->
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body code-modal-body">
                        <p>YOUR CODE</p>
                        <form action="{{url('add_code')}}" method="post">
                            <div class="form-group">
                        {{ csrf_field() }}     
                                <input type="name" name="promocode" value="@if(session()->get('promocode')) {{session()->get('promocode')}} @endif" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Code">
                            </div>
                            <br/>
                            <div class="form-group">
                                <input type="submit" name="submit" value="submit" class="btn btn-info btn-xs">
                        @if(session()->get('promocode'))
                                <a href="{{route('code_remove')}}" class="btn btn-info btn-xs">Cancel</a>
                        @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="modal" id="myCheckout" style="margin-top: 100px;">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-checkout">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3 class="modal-title">Close</h3>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body code-modal-body">
                            


                         <!--     <a href="#" data-toggle="modal" style="text-decoration: none; color: white;" data-target="#myCode"><button class="col-md-12 form-control" style="background: none;border: none;text-align: left;color: rgb(232, 103, 109);"><i class="fa fa-shopping-cart"></i> Add Promo Code</button></a> -->
                            <button class="col-md-12 form-control" style="background: none;border: none;text-align: left;color: rgb(232, 103, 109);" onClick="ShippingModal(this)"><i class="fa fa-home"></i> Add Shipping Address</button>
                            <button class="col-md-12 form-control" style="background: none;border: none;text-align: left;color: rgb(232, 103, 109);" onClick="BillingModal(this)"><i class="fa fa-home"></i> Add Billing Address</button>
                            <button class="col-md-12 form-control" style="background: none;border: none;text-align: left;color: rgb(232, 103, 109);"  onClick="PaymentModal(this)"><i class="fa fa-shopping-cart"></i> Add Payment Method</button>
                            <div class="form-group">
                        <form action="{{url('add_order_cod')}}" method="get">
                                <input type="hidden" name="user_id" value="{{Session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')}}"> 
                                <input type="hidden" class="form-control" id="or"
                                    aria-describedby="emailHelp" name="cod">
                                <input type="submit" class="btn btn-lg footer-btn" id="or" value="Place Order">
                        </form>
                            </div>
                    </div>
<!--                     <div class="footer-btn">
                        <a href="#">Checkout</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!--  -->


    <!-- popup for remove image --> 
        <div class="modal" id="myCartImage">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-checkout">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a href="" data-dismiss="modal" class="close" ><h3 class="modal-title">Dismiss</h3></a>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div style="box-shadow: 0px 0px 1px 0px;height: 50px;text-align: center;padding: 10px;">
                        <p style="font-weight: 600;color: #a28a8a;"  onClick="ShowPreviewModal(this)" >Preview</p>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body code-modal-body">
                        <form method="post" action="{{ url('removeCartItem')}}" id="content_form" enctype="multipart/form-data">
                        {!! csrf_field() !!}    
                                <input type="hidden" class="form-control" id="cart_id" name="cart_id">
                                <input type="submit" class="col-md-12" value=
                                "Remove" style="background: none;border: none;font-weight: 700;
                                color:#ffa482;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- end -->    

    <!-- popup for add shipping address details --> 
        <div class="modal" id="myShippingAddress">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-checkout" style="width: 600px;">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a href="" data-dismiss="modal" class="close" ><h3 class="modal-title">Add Shipping Details</h3></a>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body code-modal-body" id="shipping_form">
                    @if($count_shipping == 'true')
                        <form action="{{ url('edit_order_shipping')}}" method="post">
                        {!! csrf_field() !!}    
                            <div class="col-md-12 form-group">
                              <input type="hidden" name="user_id" value="{{Session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')}}" >   
                              <input type="text" class="form-control" id="fullname" placeholder="Fullname" name="fullname" value="{{$shipping->fullname}}" required="">
                            </div>
                            <div class="col-md-12 form-group">
                              <textarea class="form-control" name="address" placeholder="Street Address" required="">{{$shipping->address}}</textarea>
                            </div>
                            <div class="col-md-12 form-group" >
                               <select class="form-control" name="country" required>
                                   <option value="">Select Country</option>
                                   @foreach($country as $count)
                                        <option value="{{$count->id}}" <?php if(!empty($shipping)) { if($shipping->country == $count->name){?> SELECTED <?php } } ?>>{{$count->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group" >
                              <select class="form-control" name="state" required>
                                   <option value="">Select State</option>
                                   @foreach($state as $sta)
                                        <option value="{{$sta->id}}" <?php if(!empty($shipping)) { if($shipping->state == $sta->name){?> SELECTED <?php } } ?>>{{$sta->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group" >
                              <select class="form-control" name="city" required>
                                   <option value="">Select City</option>
                                   @foreach($cityname as $cites)
                                        <option value="{{$cites->id}}" <?php if(!empty($shipping)) { if($shipping->city == $cites->name){?> SELECTED <?php } } ?>>{{$cites->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group" >
                              <input type="text" class="form-control" id="postal_code" placeholder="Postal Code" name="postal_code" value="{{$shipping->postal_code}}" required="">
                            </div>
                            <div class="col-md-12 form-group" >
                              <input type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile" value="{{$shipping->mobile}}"  required="">
                            </div>
                            <div class="col-md-12 form-group" >
                                <button type="submit" class="col-md-12 btn btn-danger">Submit</button>
                            </div>
                        </form>
                    @else
                        <form action="{{ url('add_shipping_details')}}" method="post">
                        {!! csrf_field() !!}    
                            <div class="col-md-12 form-group">
                              <input type="hidden" name="user_id" value="{{Session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')}}" >   
                              <input type="text" class="form-control" id="fullname" placeholder="Fullname" name="fullname" required="">
                            </div>
                            <div class="col-md-12 form-group">
                              <textarea class="form-control" name="address" placeholder="Street Address" required=""></textarea>
                            </div>
                            <div class="col-md-12 form-group" >
                               <select class="form-control" name="country" required>
                                   <option value="">Select Country</option>
                                   @foreach($country as $count)
                                        <option value="{{$count->id}}" <?php if(!empty($shipping)) { if($shipping->country == $count->name){?> SELECTED <?php } } ?>>{{$count->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group" >
                              <select class="form-control" name="state" required>
                                   <option value="">Select State</option>
                                   @foreach($state as $sta)
                                        <option value="{{$sta->id}}" <?php if(!empty($shipping)) { if($shipping->state == $sta->name){?> SELECTED <?php } } ?>>{{$sta->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group" >
                              <select class="form-control" name="city" required>
                                   <option value="">Select City</option>
                                   @foreach($cityname as $cites)
                                        <option value="{{$cites->id}}" <?php if(!empty($shipping)) { if($shipping->city == $cites->name){?> SELECTED <?php } } ?>>{{$cites->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group">
                              <input type="text" class="form-control" id="postal_code" placeholder="Postal Code" name="postal_code" required="">
                            </div>
                            <div class="col-md-12 form-group" >
                              <input type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile"  required="">
                            </div>
                            <div class="col-md-12 form-group" >
                                <button type="submit" class="col-md-12 btn btn-danger">Submit</button>
                            </div>
                        </form>
                    @endif        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="mybillingAddress">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-checkout" style="width: 600px;">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a href="" data-dismiss="modal" class="close" ><h3 class="modal-title">Add Billing Details</h3></a>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body code-modal-body" id="shipping_form">
                    @if($count_billing == 1)
                        <form action="{{ url('edit_order_billing')}}" method="post">
                        {!! csrf_field() !!}    
                            <div class="col-md-12 form-group">
                              <input type="hidden" name="user_id" value="{{Session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')}}" >   
                              <input type="text" class="form-control" id="fullname" placeholder="Fullname" name="fullname" value="{{$billing->fullname}}" required="">
                            </div>
                            <div class="col-md-12 form-group">
                              <textarea class="form-control" name="address" placeholder="Street Address" required="">{{$billing->address}}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                              <select class="form-control" name="country" required>
                                   <option value="">Select Country</option>
                                   @foreach($country as $co)
                                        <option value="{{$co->id}}" <?php if(!empty($billing)) { if($billing->country == $co->name){?> SELECTED <?php } } ?>>{{$co->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group">
                              <select class="form-control" name="state" required>
                                   <option value="">Select State</option>
                                   @foreach($state as $sta)
                                        <option value="{{$sta->id}}" <?php if(!empty($billing)) { if($billing->state == $sta->name){?> SELECTED <?php } } ?>>{{$sta->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group">
                              <select class="form-control" name="city" required>
                                   <option value=""> Select City</option>
                                   @foreach($cityname as $cites)
                                        <option value="{{$cites->id}}" <?php if(!empty($billing)) { if($billing->city == $cites->name){?> SELECTED <?php } } ?>>{{$cites->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group">
                              <input type="text" class="form-control" id="postal_code" placeholder="Postal Code" name="postal_code" value="{{$billing->postal_code}}" required="">
                            </div>
                            <div class="col-md-12 form-group" >
                              <input type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile" value="{{$billing->mobile}}"  required="">
                            </div>
                            <div class="col-md-12 form-group" >
                                <button type="submit" class="col-md-12 btn btn-danger">Submit</button>
                            </div>
                        </form>
                    @else
                        <form action="{{ url('add_billing_details')}}" method="post">
                        {!! csrf_field() !!}    
                            <div class="col-md-12 form-group">
                              <input type="hidden" name="user_id" value="{{Session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')}}" >   
                              <input type="text" class="form-control" id="fullname" placeholder="Fullname" name="fullname" required="">
                            </div>
                            <div class="col-md-12 form-group">
                              <textarea class="form-control" name="address" placeholder="Street Address" required=""></textarea>
                            </div>
                              <div class="col-md-12 form-group" >
                              <select class="form-control" name="country" required>
                                   <option value="">Select Country</option>
                                   @foreach($country as $co)
                                        <option value="{{$co->id}}" >{{$co->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group" >
                              <select class="form-control" name="state" required>
                                   <option value="" >Select State</option>
                                   @foreach($state as $sta)
                                        <option value="{{$sta->id}}" >{{$sta->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group">
                              <select class="form-control" name="city" required>
                                   <option value="">Select City</option>
                                   @foreach($cityname as $cites)
                                        <option value="{{$cites->id}}" >{{$cites->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="col-md-12 form-group" style="float: left;">
                              <input type="text" class="form-control" id="postal_code" placeholder="Postal Code" name="postal_code" required="">
                            </div>
                            <div class="col-md-12 form-group" >
                              <input type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile"  required="">
                            </div>
                            <div class="col-md-12 form-group" >
                                <button type="submit" class="col-md-12 btn btn-danger">Submit</button>
                            </div>
                        </form>
                    @endif        
                    </div>
                </div>
            </div>
        </div>
    <!-- end -->    


    <!-- popup for add shipping address details --> 
    <div class="modal" id="myPaymentModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-checkout" style="width: 600px;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <a href="" data-dismiss="modal" class="close" ><h3 class="modal-title">Payment</h3></a>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body code-modal-body" id="shipping_form" style="box-shadow: #585050 0px 0px 1px 0px;">
                        <h4><i class="fa fa-credit-card"></i> Use Paypal</h4>
                </div>
                <div class="modal-body code-modal-body" id="shipping_form" style="box-shadow: #585050 0px 0px 1px 0px;">
                        <h4><i class="fa fa-credit-card"></i> Add Credit Card</h4>
                </div>
                <div class="modal-body code-modal-body">
                        <h4>
                            <label for="chk"> <input type="radio" style="font-size: 20px;" name="cod" id="chk" value="cod" onclick="$('#myPaymentModal').modal('hide')"> <i class="fa fa-credit-card"></i> Cash on delivery </label></h4>
                </div>
				<div class="modal-body code-modal-body">
                        <h4>
                            <label for="klarna"> <input type="radio" style="font-size: 20px;" name="klarna" id="klarna" value="klarna" onclick="$('#myPaymentModal').modal('hide')"> <i class="fa fa-credit-card"></i> Klarna Payment </label></h4>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->   



    <!-- popup for add shipping address details --> 
    <div class="modal" id="mySocialModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-checkout" style="width: 450px;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <a href="" data-dismiss="modal" class="close" ><h3 class="modal-title">Choose Photo's from social</h3></a>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <!-- Modal body -->

                <div id="fb-root">
                </div>
                <div id="extend_pics" style="overflow-x: auto;padding: 0px;" ></div>
            </div>
        </div>
    </div>
    <!-- end -->   


    <!-- POPUP FOR GOOGLE PHOTOS --> 
    <div class="modal" id="myGooglePhotoModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-checkout" style="width: 450px;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <a href="" data-dismiss="modal" class="close" ><h3 class="modal-title">Choose Photo's on Google Photo</h3></a>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <!-- Modal body -->

                <div id="fb-root">
                </div>
                <div id="extend_google_pics" style="overflow-x: auto;padding: 0px;" ></div>
            </div>
        </div>
    </div>
    <!-- end -->   



    <!-- popup for Show preview image  --> 
    <div class="modal" id="myPreviewImage">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-checkout" style="width: 600px;margin-top: 60px;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <a href="" data-dismiss="modal" class="close" ><h3 class="modal-title">Preview</h3></a>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div id="cart_image"></div>          
            </div>
        </div>
    </div>
    <!-- end -->   
    <script type="text/javascript">
        $(document).ready(function(){ 
            $('#chk').click(function(){
                $("#or").val("cod");
            });
			
			$('#klarna').click(function(){
                $("#or").val("klarna");
            });
        });

    </script>

    <script>
         var global_id = '';
           var indexid = '';
        $(document).ready(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
        
                        reader.onload = function(event) {
                            $($.parseHTML('<div class="col-sm-6 col-md-3" style="margin:10px"><div class="image-wrap" ><div data-name="'+event.target.result+'" onclick="ShowModal(this)" class="image-frame" ></div><img src="'+event.target.result+'" ></div>'))
                                .appendTo(placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
        
            $('#gallery-photo-add').on('change', function() {


               
                 let image_upload = new FormData();
                let TotalImages = $(this)[0].files.length;  //Total Images
                let images  = $(this)[0];  

                for (let i = 0; i < TotalImages; i++) {
                    console.log(TotalImages);
                  image_upload.append('images['+i+']', images.files[i]);
                }
                image_upload.append('TotalImages', TotalImages);
                 image_upload.append('farme_id', indexid);
              
                $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                     });

                 $.ajax({
                        url:'{{url('/upload_image')}}',
                        data:image_upload,
                        dataType:'json',
                        
                        async:false,
                        type:'post',
                        processData: false,
                        contentType: false,
                        success:function(response){
                        console.log(response);
                    },
                });

                imagesPreview(this, 'div.gallery');
                setTimeout(function() {
                   var imgWrap = $('.image-frame');
                      var newItem = '';
                    newItem += "@foreach($cms_data as $post)";
                    <?php $fr2 = asset('media/frame/'.$post->frame_image); ?>
                        if(global_id == '{{$post->title}}') {
                           //  alert(id); 
                            imgWrap.attr('class','image-frame');
                            $('.image-frame').css('background-image', 'none');
                            $('.image-frame').css('background-image', 'url(<?php echo $fr2 ?>)');
                        }
                
                    newItem += "@endforeach";
                }, 100);
                 //$('.img-fluid').click();
            });

          
            $('.img-fluid').on('click', function() {
                 global_id = $(this).attr('id');
                 indexid = $(this).attr('indexid');

                           var id = $(this).attr('id');
   
                var imgWrap = $('.image-frame');
                var newItem = '';
                // alert(id); 
            newItem += "@foreach($cms_data as $post)";
                <?php $fr2 = asset('media/frame/'.$post->frame_image); ?>
                if(id == '{{$post->title}}') {
                   //  alert(id); 
                    imgWrap.attr('class','image-frame')
                    $('.image-frame').css('background-image', 'none');
                    $('.image-frame').css('background-image', 'url(<?php echo $fr2 ?>)');
                }
        
            newItem += "@endforeach";
            });
        });
    </script>
    <script type="text/javascript">
    function ShowModal(elem){
        $("#myCartImage").modal('show');
        var dataId = $(elem).data("id");
        var dataName = $(elem).data("name");
        $('#cart_id').val(dataId);
        $('#cart_image').html('<center><img src="'+dataName+'" alt=""  width="300"></center>');
    }

    function ShippingModal(elem){
        $("#myShippingAddress").modal('show');
    
    }
    function BillingModal(elem){
        $("#mybillingAddress").modal('show');
    
    }

    function PaymentModal(elem){
        $("#myPaymentModal").modal('show');
    
    }


    function SocialModal(elem){
        $("#mySocialModal").modal('show');
    
    }

    function googlePhotoModal(elem){
        $("#myGooglePhotoModal").modal('show');
    
    }

    function ShowPreviewModal(elem){
        $("#myPreviewImage").modal('show');
    
    }


    $(function() {
       var imgWrap = $('.image-frame');

                    var newItem = '';
                newItem += "@foreach($cms_data as $key => $post)";
                <?php $fr2 = asset('media/frame/'.$post->frame_image); ?>
                    if('{{$key}}' == '0') {
                          global_id = '{{$post->title}}';
                          indexid= '{{$post->id}}';
                         setTimeout(function() {
                        imgWrap.attr('class','image-frame')
                        $('.image-frame').css('background-image', 'none');
                        $('.image-frame').css('background-image', 'url(<?php echo $fr2 ?>)');
                    }, 100);
                    }
            
                newItem += "@endforeach";
    });
    </script>



    <script>
        /**
         * This is the getPhoto library
         */

         $('#facebook_image').click(function(){
            getPhotos( function( photos ) {
                $("#extend_pics").html('');
                for (var item of photos) {

                    $("#extend_pics").append("<div class='' style='float:left;' ><form id='target' action='{{url('facebookLogin')}}'><input type='hidden' value='"+item.url+"' name='fb_image'><input type='hidden' value='"+indexid+"' name='frame_id'><input type='hidden' value='fb' name='image_type'><button><img src='"+item.url+"' style='width:141px;' /> </button></form></div>");

                }
            
            });
        });
        var docReady = $.Deferred();
        var facebookReady = $.Deferred();
        $(document).ready(docReady.resolve);
        window.fbAsyncInit = function() {
            FB.init({
              appId      : '1242807732568311',
              channelUrl : '//conor.lavos.local/channel.html',
              status     : true,
              cookie     : true,
              xfbml      : true
            });
            //facebookReady.resolve();
        };

        function makeFacebookPhotoURL( id, accessToken ) {
            return 'https://graph.facebook.com/' + id + '/picture?access_token='+accessToken;
        }
        function login( callback ) {
            FB.login(function(response) {
                if (response.authResponse) {
                    if (callback) {
                        callback(response);
                    }
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            },{scope: 'user_photos'} );
        }
        function getAlbums( callback ) {
            FB.api(
                    '/me/albums',
                    {fields: 'id,cover_photo'},
                    function(albumResponse) {
                        //console.log( ' got albums ' );
                        if (callback) {
                            callback(albumResponse);
                        }
                    }
                );
        }
        function getPhotosForAlbumId( albumId, callback ) {
            FB.api(
                    '/'+albumId+'/photos',
                    {fields: 'id'},
                    function(albumPhotosResponse) {
                        //console.log( ' got photos for album ' + albumId );
                        if (callback) {
                            callback( albumId, albumPhotosResponse );
                        }
                    }
                );
        }
        function getLikesForPhotoId( photoId, callback ) {
            FB.api(
                    '/'+albumId+'/photos/'+photoId+'/likes',
                    {},
                    function(photoLikesResponse) {
                        if (callback) {
                            callback( photoId, photoLikesResponse );
                        }
                    }
                );
        }
        function getPhotos(callback) {
            var allPhotos = [];
            var accessToken = '';
            login(function(loginResponse) {
                accessToken = loginResponse.authResponse.accessToken || '';
                getAlbums(function(albumResponse) {
                        var i, album, deferreds = {}, listOfDeferreds = [];
                        for (i = 0; i < albumResponse.data.length; i++) {
                            album = albumResponse.data[i];
                            deferreds[album.id] = $.Deferred();
                            listOfDeferreds.push( deferreds[album.id] );
                            getPhotosForAlbumId( album.id, function( albumId, albumPhotosResponse ) {
                                    var i, facebookPhoto;
                                    for (i = 0; i < albumPhotosResponse.data.length; i++) {
                                        facebookPhoto = albumPhotosResponse.data[i];
                                        allPhotos.push({
                                            'id'    :   facebookPhoto.id,
                                            'added' :   facebookPhoto.created_time,
                                            'url'   :   makeFacebookPhotoURL( facebookPhoto.id, accessToken )
                                        });
                                    }
                                    deferreds[albumId].resolve();
                                });
                        }
                        $.when.apply($, listOfDeferreds ).then( function() {
                            if (callback) {
                                callback( allPhotos );
                            }
                        }, function( error ) {
                            if (callback) {
                                callback( allPhotos, error );
                            }
                        });
                    });
                SocialModal();
            });
        }
    </script>

    <script>
        $.when(docReady, facebookReady).then(function() {
            // if (typeof getPhotos !== 'undefined') {
            //     getPhotos( function( photos ) {
            //         //console.log( photos );
            //         $("#extend_pics").html('');
            //         for (var item of photos) {
            //             //photosArr.push({url : item.url});
            //             $("#extend_pics").append("<div class='' style='float:left;' onClick='socialFunction(this)' data-id='"+item.url+"'><img src='"+item.url+"' style='width:141px;border:5px solid #c3a7a7;' /></div>");
            //         }
                
            //     });
            // }
        });
        // call facebook script
        (function(d){
         var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "http://connect.facebook.net/en_US/all.js";
         d.getElementsByTagName('head')[0].appendChild(js);
        }(document));



        $( "#target" ).submit(function( event ) {
          alert( "Handler for .submit() called." );
          event.preventDefault();
        });

    </script>


<!-- Start Script For Get All Photos on GOOGLE PHOTO -->
<script src="https://apis.google.com/js/api.js"></script>
<script>
  function authenticate() {
    return gapi.auth2.getAuthInstance()
        .signIn({scope: "https://www.googleapis.com/auth/photoslibrary https://www.googleapis.com/auth/photoslibrary.readonly https://www.googleapis.com/auth/photoslibrary.readonly.appcreateddata"})
        .then(function() { console.log("Sign-in successful"); },
              function(err) { console.error("Error signing in", err); });
  }
  function loadClient() {
    gapi.client.setApiKey("AIzaSyAYkLmkSf1Ub4SiSYw9urdh1bgQrbZJTQM");
    return gapi.client.load("https://content.googleapis.com/discovery/v1/apis/photoslibrary/v1/rest")
        .then(function() {
            execute();
            console.log("GAPI client loaded for API");
            googlePhotoModal();
         },
              function(err) { console.error("Error loading GAPI client for API", err); });
  }
  // Make sure the client is loaded and sign-in is complete before calling this method.
 function execute() {
    return gapi.client.photoslibrary.mediaItems.search({
      "resource": {}
    })
        .then(function(response) {
                console.log("Response", response);
                $("#extend_google_pics").html('');
                let arr = response.result.mediaItems;
                for (let item of arr) {
                    $("#extend_google_pics").append("<div class='' style='float:left;' ><form id='target' action='{{url('facebookLogin')}}'><input type='hidden' value='"+item.baseUrl+"' name='fb_image'><input type='hidden' value='"+indexid+"' name='frame_id'><input type='hidden' value='google_photo' name='image_type'><button><img src='"+item.baseUrl+"' style='width:141px;' /> </button></form></div>");
                }

              },
              function(err) { console.error("Execute error", err); });
  }
  gapi.load("client:auth2", function() {
    gapi.auth2.init({client_id: "868276036150-3lj7qbn7fihd9rb7vsecbtlonm4cl147.apps.googleusercontent.com"});
  });
</script>
<!-- End GOOGLE PHOTO -->
<script type="text/javascript">
    setTimeout(function() {
    $('.alert').slideUp("slow");
    }, 1000);
</script>
<script>
$(document).ready(function(){
  $(".place_order").hide();
  $(".checkout").click(function(){
    $(".place_order").show();
    $(".check_out").hide();
  });
  // $(".place_order").click(function(){
  // //  $(".check_out").show();
  // });
});
</script>

</body>

</html>
@endsection