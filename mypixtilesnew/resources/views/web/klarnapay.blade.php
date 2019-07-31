@extends('layouts.my-app') 
@extends('layouts.frant')  
@section('content')
   <body>
        <section class="container structure">
            <div class="col-md-12">
                <header>
                    <h1>&nbsp;</h1>
                </header>
                
            </div>
            
          <div id="klarna_container"></div>

        </section>
        
  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
       

<script>

$(document).ready(function(){
    $.ajax({
        url: "{{ url('/klarnaPayorder/'.$uid) }}",
        success: function(response){ 
            $('#klarna_container').html(response);
        }
    })
});


 //var khtml = JSON.parse(getkSnippet());

  var checkoutContainer = document.getElementById('klarna_container')
  //checkoutContainer.innerHTML = khtml;
    var scriptsTags = checkoutContainer.getElementsByTagName('script')
  // This is necessary otherwise the scripts tags are not going to be evaluated
  for (var i = 0; i < scriptsTags.length; i++) {
      var parentNode = scriptsTags[i].parentNode
      var newScriptTag = document.createElement('script')
      newScriptTag.type = 'text/javascript'
      newScriptTag.text = scriptsTags[i].text
      parentNode.removeChild(scriptsTags[i])
      parentNode.appendChild(newScriptTag)
  }

</script>

        
    </body>

    </html>
      @endsection
