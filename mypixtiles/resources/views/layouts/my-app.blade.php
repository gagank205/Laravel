<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ijustpaid') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=2d345502-7fdc-434a-a224-13bbe384c63e"> </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
      <!--   <section class="social__icon">
        <div class="container">
            <div class="col-md-12 col-xs-12 col-sm-12 icon__div">
              <ul>
                <span>Follow us :</span>
                <li><i class="fa fa-facebook"></i></li>
                <li><i class="fa fa-instagram"></i></li>
                <li><i class="fa fa-twitter"></i></li>
                <li><i class="fa fa-youtube-play"></i></li>
                <li><i class="fa fa-pinterest"></i></li>
              </ul>
          </div>
       </div>
   </section> -->

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background: #e76369;">
            <div class="container" style="max-width: 1317px !important;padding: 0px;">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Ijustpaid') }}
                </a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto pull-right" style="list-style: none;">
                        <!-- Authentication Links -->
                        @guest                        
                            <li class="nav-item" style="margin-right:20px; ">
                                <a class="nav-link" href="{{ url('webLogin') }}" style="color:#fff;">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('webRegister') }}" style="color:#fff;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div style="margin-top: 10px;">
                                 <div id="google_translate_element"></div>
                                <script type="text/javascript">
                                    function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                                    }
                                </script>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #fff;font-weight: bold;margin-top: 5px;">
                                    {{ Auth::user()->first_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="padding: 0px;">
                                <table style="margin:0px 10px 0px 10px;">
                                  <tr style="border-bottom: 1px solid #dedede;">
                                    <td><i class="fa fa-chevron-right"></i></td> 
                                    <td><a class="navbar-brand" href="{{ url('user-profile') }}" style="width: 100%;text-align: center;">Profile</a> </td>
                                  </tr>
                                  <tr style="border-bottom: 1px solid #dedede;">
                                    <td><i class="fa fa-chevron-right"></i></td>
                                    <td><a class="navbar-brand" href="{{ url('change-password') }}" style="width: 100%;text-align: center;">Change Password</a> </td>
                                  </tr>
                                  <tr style="border-bottom: 1px solid #dedede;">
                                    <td><i class="fa fa-chevron-right"></i></td>
                                    <td><a class="navbar-brand" href="{{ url('address') }}" style="width: 100%;text-align: center;">Address</a> </td>
                                  </tr>
                                   <tr style="border-bottom: 1px solid #dedede;">
                                    <td><i class="fa fa-chevron-right"></i></td>
                                    <td><a class="navbar-brand" href="{{ url('order-detail') }}" style="width: 100%;text-align: center;">Order Detail</a> </td>
                                  </tr>
                                  <tr style="border-bottom: 1px solid #dedede;">
                                    <td><i class="fa fa-chevron-right"></i></td>
                                    <td><a class="navbar-brand" href="{{ url('user-logout') }}" style="width: 100%;text-align: center;">Logout</a></td>
                                  </tr>
                                </table>    
                                </div>
                            </li>
                            <li style="margin:10px;">
                                <a href="{{ url('/web') }}">
								@if(Auth::user()->image)
								 <img src="{{ asset('media/userimage/'.Auth::user()->image) }}" alt="" width="50" />
							 @endif
                                     <!--<img src="media/userimage/{{ Auth::user()->image }}" alt="" width="50" />!-->
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-0">
            @yield('content')
        </main>
    </div>
</body>
</html>
