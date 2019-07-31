@extends('layouts.my-app') 
@extends('web.header')
@section('content')
<body class="from-bg">
    <section class="form-head">
        <div class="bck-btn"><a href="{{url('/web')}}"><i class="fa fa-angle-left"></i></a></div>
        <div class="form-menu">
            <div class="dropdown ">
                <img src="{{url('new/images/menuIcon.svg')}}" onclick="myFunction()" class="dropbtn">
                <div id="myDropdown" class="dropdown-content">
                    <a href="#">Frequent Questions</a>
                    <a href="#">Talk to Us</a>
                    <a href="#">Add Promo Code</a>
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
    </section>
    <section>

        <div class="content form">
            @if(session()->get('success'))
            <div class="col-12" style="margin-top: 25px;">
                <div class="col-3 pull-right"></div>
                <div class="col-5 pull-right">
                <div class="alert alert-success alert-dismissible fade show elementToFadeInAndOut" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                    {{ session()->get('success') }}
                </div>
                </div>
                <div class="col-4 pull-right"></div>
            </div>
            @elseif(session()->get('error'))
            <div class="col-12" style="margin-top: 25px;">
                <div class="col-3 pull-right"></div>
                <div class="col-5 pull-right">
                <div class="alert alert-danger alert-dismissible fade show elementToFadeInAndOut" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                    {{ session()->get('error') }}
                </div>
                </div>
                <div class="col-4 pull-right"></div>
            </div>
            @endif
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" 
                action="{{ url('changePassword/store')}}" name="changepassword_form" id="changepassword_form">
                    @csrf
                    <div class="form-label">Change Password</div>
                    <input type="hidden" name="ajax_route" id='ajax_route' value="{{ROUTE('changePassword')}}">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">                                                      
                            <div class="col-lg-12">
                               <!--  <label>Current Password:</label> -->
                                <input type="password" class="form-control m-input" name="current_password" placeholder="Current Password" id="current-password" max='25'>
                                <span class="m-form__help error current_password"></span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">                                                      
                            <div class="col-lg-12">
                               <!--  <label>New Password:</label> -->
                                <input type="password" class="form-control m-input" name="password" placeholder="New Password" id="new-password" max='25'>
                                <span class="m-form__help error password"></span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">                                                      
                            <div class="col-lg-12">
                                <!-- <label>Confirm New Password:</label> -->
                                <input type="password" class="form-control m-input" name="password_confirmation" placeholder="Confirm Password" id="current-password" max='25'>
                                <span class="m-form__help error password_confirmation"></span>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" name="city_submit" id="city_submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </section>
</body>
</html>
@endsection