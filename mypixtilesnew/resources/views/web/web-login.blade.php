@extends('layouts.my-app') 
@extends('web.header') 
@section('content')
<body class="from-bg">
<!--     <section class="form-head">
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
    </section> -->
    <section>

        <div class="content form">
            @if(session()->get('success'))
            <div class="col-12">
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
            <div class="col-12">
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
            <!-- <form action="{{url('review/data')}}"> -->
            <form method="POST" action="{{ url('post-login') }}">  
             @csrf

                <div class="form-label"><img src="{{asset('new_frant/images/logo.png')}}"></div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                   <!--  <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ __('E-Mail') }}"> -->
                </div>
                <!-- <div class="form-group">
                    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last Name">
                </div> -->
                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> -->
                </div>
                <div class="form-check">
                </div>
                <div class="bottom-button-container">
                    <button type="submit" class="btn btn-primary form-btn">{{ __('Login →') }}</button>
                    <!-- <button type="submit" class="btn btn-primary form-btn">Pick Photos →</button> -->
                    <a class="nav-link" href="{{ url('webRegister') }}">{{ __('Register') }}</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
@endsection