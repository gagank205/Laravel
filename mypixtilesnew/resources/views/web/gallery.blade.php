<div class="tz-gallery">
        <div class="row">
          @foreach($images as $key => $image)
            <div class="col-sm-12 col-md-4">
                <a class="lightbox" href="{{ $image }}">
                    <img src="{{ $image }}" alt="Instagram Feed" class="img-responsive">
                </a>
            </div>
            @endforeach
        </div>
    </div>