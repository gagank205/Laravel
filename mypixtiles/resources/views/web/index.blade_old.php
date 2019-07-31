@extends('layouts.my-app')
@extends('web.header')
@section('content')
    <section class="container structure">
      <div class="col-md-12">
        <header>
            <img src="{{url('new/images/background.png')}}" class="img-fluid">
            <div class="logo">
            <img src="{{url('new/images/logo.png')}}" class="img-fluid">
            </div>
            <h1>Turn your photos into affordable, stunning wall art</h1>
        </header>
        <div class="video">
            <iframe allowtransparency="true" title="Wistia video player" allowFullscreen frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" src="https://fast.wistia.net/embed/iframe/twg93kgvh9" width="800" height="450"></iframe>
            <h6>"This is heaven"</h6>
            <div class="pressLogo">
                <img src="{{url('new/images/pressLogo.jpg')}}" class="img-fluid">
            </div>
        </div>
      </div>  
    </section>
    <section class="White-section">
        <div class="Pitch-pricing"> 
            <h2>Three tiles are $58</h2>
            <h3>Each additional tile is $12</h3>
            <h3>Shipping is always free</h3>
        </div>
    </section>
    <section>
        <div>
            <h3>Millions Of Tiles Sold</h3>
            <h5>GRACING WALLS OF ALL KINDS</h5>
        </div>
    </section>
    <section class="center slider slid">
            <div class="social-slider">
              <img src="{{url('new/images/slide-1.png')}}">
              <div class="socail-data">
                <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                <p>@CatalynBear</p>
                <h6>The playroom is looking more like home for our girls every day.</h6>
              </div>  
            </div>
            <div class="social-slider">
              <img src="{{url('new/images/slide-2.png')}}">
              <div class="socail-data">
                <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                <p>@CatalynBear</p>
                <h6>The playroom is looking more like home for our girls every day.</h6>
              </div> 
            </div>
            <div class="social-slider">
              <img src="{{url('new/images/slide-3.jpg')}}">
              <div class="socail-data">
                <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                <p>@CatalynBear</p>
                <h6>The playroom is looking more like home for our girls every day.</h6>
              </div> 
            </div>
            <div class="social-slider">
              <img src="{{url('new/images/slide-4.jpg')}}">
              <div class="socail-data">
                <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                <p>@CatalynBear</p>
                <h6>The playroom is looking more like home for our girls every day.</h6>
              </div> 
            </div>
            <div class="social-slider">
              <img src="{{url('new/images/slide-5.jpeg')}}">
              <div class="socail-data">
                <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                <p>@CatalynBear</p>
                <h6>The playroom is looking more like home for our girls every day.</h6>
              </div> 
            </div>
            <div class="social-slider">
              <img src="{{url('new/images/slide-6.jpg')}}">
              <div class="socail-data">
                <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                <p>@CatalynBear</p>
                <h6>The playroom is looking more like home for our girls every day.</h6>
              </div> 
            </div>
            <div class="social-slider">
              <img src="{{url('new/images/slide-7.jpg')}}">
              <div class="socail-data">
                <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                <p>@CatalynBear</p>
                <h6>The playroom is looking more like home for our girls every day.</h6>
              </div> 
            </div>
            <div class="social-slider">
              <img src="{{url('new/images/slide-8.jpg')}}">
              <div class="socail-data">
                <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                <p>@CatalynBear</p>
                <h6>The playroom is looking more like home for our girls every day.</h6>
              </div> 
            </div>
            <div class="social-slider">
              <img src="{{url('new/images/slide-9.jpeg')}}">
              <div class="socail-data">
                <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                <p>@CatalynBear</p>
                <h6>The playroom is looking more like home for our girls every day.</h6>
              </div> 
            </div>
            <div class="social-slider">
                <img src="{{url('new/images/slide-10.jpeg')}}">
                <div class="socail-data">
                  <img src="{{url('new/images/instagram-logo.png')}}" class="img-fluid">
                  <p>@CatalynBear</p>
                  <h6>The playroom is looking more like home for our girls every day.</h6>
                </div> 
            </div>
          </section>

<section class="White-section">
  <div class="col-md-12">
    <div class="Pitch-pricing"> 
        <h2>One perfect size</h2>
        <h3>Tiles are 8" by 8". They're removable, reusable and leave no marks.</h3>
    </div>
  </div>
</section>

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
    <div class="footer-btn"> 
        <a href="{{ url('start') }}">Let's Go</a>
    </div>
  </div>  
</section>
  
</body>
</html>

  @endsection
