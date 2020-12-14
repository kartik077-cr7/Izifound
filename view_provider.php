<?php
   session_start();
    
    if(!isset($_SESSION['email']))
    {
    	header("Location:index.php");
    	return;
    }
  $link = mysqli_connect('localhost','root','',"izifound");  

	/*Check link to the mysql server*/ 
	if(!$link)
	{ 
	  die('Failed to connect to server: ' . mysqli_error($link));
	}
	 $qry = 'SELECT * FROM provider'; 
	 $result = mysqli_query($link,$qry);
    echo '<h1 style="text-align:center;">The Provider Details are - </h1>';
          
    echo  '<table class="styled-table" style="margin-left:auto;margin-right:auto;">
	<th> Name </th> 
	 <th> College </th> 
	 <th> Rating</th>
	 <th>See all products of this provider</th>';
	 
	    while ($row = mysqli_fetch_assoc($result))
	{ 
	echo '<tr> 
	<td>'.$row['Name'].'</td>
	<td>'.$row['College'].'</td>
	<td>'.number_format((float) $row['RATING'], 1, '.', '').'</td> 
    <td><a href = "show_provider_product.php?Email='.$row['EMAIL'].'">'."Click Me".'</a></td> 
	</tr>'; 
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="CSS/table_style.css">
	<style type="text/css">
		a
		{
			text-decoration: none;
		}
	</style>
</head>
<body>

</body>
</html>
