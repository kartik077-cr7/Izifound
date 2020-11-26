<?php
   
   session_start();

  $link = mysqli_connect('localhost','root','',"izifound");  

	/*Check link to the mysql server*/ 
	if(!$link)
	{ 
	die('Failed to connect to server: ' . mysqli_error($link));
	 }
	 $qry = 'SELECT * FROM intermediate'; 
	 $result = mysqli_query($link,$qry);
    echo '<h1 style="text-align:center;">The Provider-Product Details are - </h1>';
    echo  '<table border="1" style="margin-left:auto;margin-right:auto;">

	<th> Email </th> 
	 <th> Product_Name</th>
	 <th> Rent</th>
	 <th> Buy</th>
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
	</tr>'; 
	}

?>