<?php
   
   session_start();

  $link = mysqli_connect('localhost','root','',"izifound");  

	/*Check link to the mysql server*/ 
	if(!$link)
	{ 
	die('Failed to connect to server: ' . mysqli_error($link));
	 }
	 $qry = 'SELECT * FROM product'; 
	 $result = mysqli_query($link,$qry);
    echo '<h1 style="text-align:center;">The Products Details are - </h1>';
    echo  '<table class = "styled-table" border="1" style="margin-left:auto;margin-right:auto;">

	<th> Product_ID </th> 
	 <th> Product_Name</th>
	 <th> View ALL providers that give this product</th>
	 ';
	 
	    while ($row = mysqli_fetch_assoc($result))
	{ 
	echo '<tr> 

	<td>'.$row['product_id'].'</td>
	<td>'.$row['Product_name'].'</td>
	<td><a href = "show_product_provider.php?product_id='.$row['product_id'].'">'."Click Me".'</a></td> 
	</tr>'; 
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="CSS/table_style.css">
</head>
<body>

</body>
</html>
