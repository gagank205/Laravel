@extends('layouts_backend.masters',['title'=>'User Management'])
@section('content')
   <body>
            <div class="container">
                <div class="row">
                    <div class="panel panel-default" style="width: 100%;">
                    <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-info-circle"></i> Order(#{{$details_order->order_id}})</h3>
           
        </div>

            <div class="panel-body">



<table class="table table-bordered">
<thead>
<tr>
<td style="width: 30%;" class="text-left">Payment Address</td>
<td style="width: 30%;" class="text-left">Shipping Address</td>
<td style="width: 30%;" class="text-left">Order Details</td>
</tr>
        <?php $sipping = unserialize($details_order->shipping_details); ?>
        <?php $billing = unserialize($details_order->billing_details); ?>

</thead>
<tbody>
<tr>
<td class="text-left"><?php echo $sipping->address ."<br>";
                            echo $sipping->city_name."<br>";
                            echo $sipping->state_name."<br>";
                            echo $sipping->country_name."<br>"; 
                        ?><br></td>
<td class="text-left"><?php 
                            echo $billing->address."<br>";
                            echo $billing->city_name."<br>";
                            echo $billing->state_name."<br>";
                            echo $billing->country_name."<br>"; ?></td>
<td class="text-left"><?php 
                        echo $details_order->first_name."<br>";
                        echo $details_order->total_amount."<br>";
                        if($details_order->satatus == 1){ echo "Pending"; } elseif($details_order->satatus == 2){ echo "Approve"; } else { echo "Cancel"; } 
                        echo "<br>".$details_order->created_at;
                         ?>
</td>
                       
    
</td>
</tr>
</tbody>
</table>
<table class="table table-bordered">

<thead>
<tr>
<td class="text-left">Product</td>
<td class="text-left">Model</td>

<td class="text-right">Total</td>
</tr>
</thead>
<tbody>
@foreach($order_details_array as $order_details)
<tr>
<td class="text-left">{{$order_details->title}}<br>
&nbsp;<small> - Order Date: {{$order_details->created_at}}</small> </td>
<td class="text-left ">
    <?php if(!empty($order_details->image_type) && $order_details->image_type == "google_photo" || $order_details->image_type == "fb") {?>

    <div class="image-wrap">
        <div class="image-frame" style="height: 80px; width:80px; background-image:none; background-image: url({{url('media/frame/'.$order_details->frame_image)}})">
    <img src="{{$order_details->customize_frame}}" alt="frame" style="height: 70px; width:70px;"></div>
    </div>
<?php } else { ?>
    <div class="image-wrap">
        <div class="image-frame" style="height: 80px; width:80px; background-image:none; background-image: url({{url('media/frame/'.$order_details->frame_image)}})">
    <img src="{{url('media/cart/'.$order_details->customize_frame)}}" alt="frame" style="height: 70px; width:70px;"></div>
    </div>
<?php } ?>

</td><td class="text-right">{{$order_details->amount}}</td>
</tr>
@endforeach
<tr>
<td colspan="2" class="text-right">Sub-Total</td>
<td class="text-right">{{$details_order->orignal_price}}</td>
</tr>
<tr>
<?php if(!empty($details_order->promocode_discount_type)) {?>
<td colspan="2" class="text-right">discount<?php if($details_order->promocode_discount_type == "PERCENTAGE"){ ?> (%) <?php } if($details_order->promocode_discount_type == "FLAT") { ?> (FLAT) <?php } else { } ?></td>
<td class="text-right">{{$details_order->promocode_discount}}</td>
<?php }?>

</tr>
<tr>
<td colspan="2" class="text-right">Total</td>
<td class="text-right">{{$order_details->total_amount}}</td>
</tr>
</tbody> 
</table>

</div>
</div>
            </div>
        
        </div>   

        
    </body>

    </html>
      @endsection
