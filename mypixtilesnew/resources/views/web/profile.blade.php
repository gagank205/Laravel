@extends('layouts.my-app') 
@extends('web.header') 
@section('content')

<body>
    <section class="form-head"><div class="bck-btn"><a href="http://localhost/mypixtiles_laravel/public/web"><i class="fa fa-angle-left"></i></a></div></section>
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
                <div class="col-3"></div>
                <div class="col-5">
                <div class="alert alert-danger alert-dismissible fade show elementToFadeInAndOut" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                    {{ session()->get('error') }}
                </div>
                </div>
                <div class="col-4 pull-right"></div>
            </div>
            @endif
        </div>
    <section class="container" style="margin-top: 80px; ">
        <div class="col-md-12" style="background: #e6e6e6;height: 370px;">
            <h5 style="padding: 20px 0px 13px 0px;">Profile Details</h5>
            <div class="col-md-5" style="float: left;">
                 <img src="{{asset('media/userimage/')}}/{{ Auth::user()->image }}" alt="" width="250" />
            </div>
            <div class="col-md-7" style="float: left;">
    <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
                <table style="width:100%">
                  <tr>
                    {{csrf_field()}}
                    <th>First Name</th>
                    <td>:</td> 
                    <td><input type="text" name="first_name" class="form-control" value="{{$userdata->first_name}}"></td>
                  </tr>
                  <tr>
                    <th>Last Name</th>
                    <td>:</td>
                    <td><input type="text" name="last_name" class="form-control" value="{{$userdata->last_name}}"></td>
                  </tr>
                  <tr>
                    <th>Date Of Birth</th>
                    <td>:</td>
                    <td><input type="date" name="dob" class="form-control" id="m_datepicker_2" value="{{$userdata->dob}}"></td>
                  </tr>
                  <tr>
                    <th>contact_number</th>
                    <td>:</td>
                    <td><input type="text" name="contact_number" class="form-control" value="{{$userdata->contact_number}}"></td>
                  </tr>
                   <tr>
                    <th>Email</th>
                    <td>:</td>
                    <td><input type="email" name="email" class="form-control" value="{{$userdata->email}}"></td>
                  </tr>
                  <br/>
                  <tr>
                    <th>profile image</th>
                    <td>:</td>
                    <td><input type="file" name="image" class="form-control"></td>
                  </tr>
                  <tr>
                      <td><input type="submit" name="submit" value="submit" class="btn btn-info"></td>
                  </tr>
              </table>
            
    </form>
              
            </div>
           <!--  <header>
                <img src="{{url('new/images/background.png')}}" class="img-fluid">
                <div class="logo">
                    <img src="{{url('new/images/logo.png')}}" class="img-fluid">
                </div>
                <h1>Turn your photos into affordable, stunning wall art</h1>
            </header> -->
           <!--  <div>
                <video controls class="video">
                    <source src="https://www.youtube.com/watch?v=0GPpgIZSLb8" type="video/mp4">
                </video>
                <h6>"This is heaven"</h6>
                <div class="pressLogo">
                    <img src="{{url('new/images/pressLogo.jpg')}}" class="img-fluid">
                </div>
            </div> -->
        </div>
    </section>
    <script src="{{asset('vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/demo/custom/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>

    <section class="pitch-reviews">
            <div class="col-md-12">
                <div class="stars">
                    <img src="{{url('new/images/stars.png')}}" class="img-fluid">
                </div>
                <div class="subtitle">4.8 STARS, 10,000+ APP STORE REVIEWS </div>
                <div class="Pitch-guarantee">You'll love our product or we'll return your money</div>
            </div>
        </section>
        <section class="container ">
            <div class="bottom-menu">
                <ul>
                    <li><a href="#" target="_blank">Jobs</a></li>
                    <li><a href="#" target="_blank">Terms of use</a></li>
                    <li><a href="#" target="_blank">Privacy Policy</a></li>
                    <li><a href="#" target="_blank">Impressum</a></li>
                    <li><a href="#" target="_blank">Contact</a></li>
                </ul>
            </div>
        </section>
        <section>
            <div class="footer-section">
               <!--  <div class="footer-btn">
                    <a href="{{ url('start') }}">Let's Go</a>
                </div> -->
                @guest
                    <div class="footer-btn">
                        <a href="{{ url('webLogin') }}">Let's Go</a>
                    </div>
                @else
                    <div class="footer-btn">
                        <a href="{{url('review/data')}}">Let's Go</a>
                    </div>
                @endguest
            </div>
        </section>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#msg').hide(2000);
            })

        </script>
</body>

</html>
@endsection