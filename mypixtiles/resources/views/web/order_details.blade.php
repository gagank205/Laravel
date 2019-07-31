@extends('layouts.my-app')
@extends('web.header')
@section('content')
   <body>
    <section class="form-head"><div class="bck-btn"><a href="http://localhost/mypixtiles_laravel/public/web"><i class="fa fa-angle-left"></i></a></div></section>
        <div class="container">
            <table class="table">
                <tr>
                    <th>order id</th>
                    <th>User Name</th>
                    <th>Total Amount</th>
                    <th>status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                @foreach($order_details as $order)
                <tr>
                    <td>{{$order->order_id}}</td>
                    <td>{{$order->user_id}}</td>
                    <td>{{$order->total_amount}}</td>
                    <td><?php if($order->satatus == 1){ echo "Pending"; } elseif($order->status == 2){ echo "Approve"; } else { echo "Cancel"; } ?></td>
                    <td>{{$order->created_at}}</td>
                    <td><a href="{{url('order-details/'.$order->order_id)}}">View Order</a></td>
                </tr>
                @endforeach
            </table>
        {{$order_details->links()}}
        </div>    

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="{{url('new/slick/slick.js')}}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function() {
        $(".center").slick({
            dots: true,
            infinite: true,
            centerMode: true,
            slidesToShow: 3,
            slidesToScroll: 1
        });
        $(".variable").slick({
            dots: true,
            infinite: true,
            variableWidth: true
        });
        $(".lazy").slick({
            lazyLoad: 'ondemand', // ondemand progressive anticipated
            infinite: true
        });
    });
</script>
        
    </body>

    </html>
      @endsection
