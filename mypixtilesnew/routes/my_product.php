<?php
$conn= mysqli_connect("localhost","root","","product_db");
if($conn==true){
	$my_data = array();
	$query="SELECT * FROM product_table" ;
	$result=mysqli_query($conn,$query);
	$num_row= mysqli_num_rows($result);

	while($data=mysqli_fetch_assoc($result)){
		$product_id   =   	$data['product_id'];
		$product_name =		$data['name'];
		$price        =     $data['price'];
		$product_qty  = 	$data['quantity'];
		$First_table_data = $_SESSION['data']=$data;
	}
	$query1 = "SELECT * FROM cart_table" ;
	$result1=mysqli_query($conn,$query1);
	$num_row1= mysqli_num_rows($result1);
	while($data1=mysqli_fetch_assoc($result1)){
		$product_id1   =   	$data1['productid'];
		$product_name1 =    $data1['name'];
		$product_qty1  =    $data1['quantity'];
		$price1        =    $data1['price'];
		$second_table_data = $_SESSION['data1']=$data1;
	}
	$my_data =array_merge($First_table_data,$second_table_data);	
	echo json_encode($my_data);
}else{
	die('error');
}
?>
