<?php
session_start();
if(!isset($_GET['Email']))
{
	header("Location:index.php");
	return;
}   
    $email = $_GET['Email'];
    $link = mysqli_connect('localhost','root','',"izifound");  

	if(!$link)
	{ 
	  die('Failed to connect to server: ' . mysqli_error($link));
	}
	
	$qry = "SELECT * FROM intermediate where email = '$email'"; 
	$result = mysqli_query($link,$qry);
    echo '<h1 style="text-align:center;">'.$email.'-Product Details are - </h1>';
    echo  '<table border="1" style="margin-left:auto;margin-right:auto;">

	<th> Email </th> 
	 <th> Product_Name</th>
	 <th> Rent</th>
	 <th> Buy</th>
	 <th>Grab It</th>
	 ';
	 
	    while ($row = mysqli_fetch_assoc($result))
	{ 

		$product_id = $row['product_id'];
		$qry2 = "SELECT Product_name from product where product_id ='$product_id' ";
		$result2 = mysqli_query($link,$qry2);
	$row2 = mysqli_fetch_assoc($result2);

	echo '<tr> 

	<td>'.$row['email'].'</td>
	<td>'.$row2['Product_name'].'</td>
	<td>'.$row['RENT'].'</td>
	<td>'.$row['Buy'].'</td>
	<td><a href = "grab.php?email='.$row['email'].'&product='.$row2['Product_name'].'">'."GRAB".'</a></td> 
	</tr>'; 
	}
 
?>