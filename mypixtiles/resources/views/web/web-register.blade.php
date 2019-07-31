@extends('layouts.my-app') 
@extends('web.header') 
@section('content')
<body class="from-bg">
<!--     <section class="form-head">
        <div class="bck-btn"><a href="{{url('/web')}}"><i class="fa fa-angle-left"></i></a></div>
        <div class="form-menu">
            <div class="dropdown ">
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
            @endif
            <form method="POST" action="{{ url('post-register') }}">  
             @csrf

                <div class="form-label"><img src="{{asset('new_frant/images/logo.png')}}"></div>
                <div class="form-group">
                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('Name') }}" required autofocus>

                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="contact_number" type="number" maxlength="10" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number" value="{{ old('contact_number') }}" placeholder="{{ __('Mobile') }}" required>

                    @if ($errors->has('contact_number'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact_number') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>

                </div>
                <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif                  
                </div>
                <div class="form-check">
                </div>
                <div class="bottom-button-container">
                    <button type="submit" class="btn btn-primary form-btn">{{ __('Register →') }}</button>
                    <a class="nav-link" href="{{ url('webLogin') }}">{{ __('Login') }}</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
@endsection