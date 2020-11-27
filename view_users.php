<?php
   
   session_start();

  $link = mysqli_connect('localhost','root','',"izifound");  

	/*Check link to the mysql server*/ 
	if(!$link)
	{ 
	die('Failed to connect to server: ' . mysqli_error($link));
	 }
	 $qry = 'SELECT * FROM users'; 
	 $result = mysqli_query($link,$qry);
    echo '<h1 style="text-align:center;">The Users Details are - </h1>';

    

    echo  '<table class="styled-table" border="1" style="margin-left:auto;margin-right:auto;">

	<th> Name </th> 
	<th> Email </th>
	 <th> College </th>';
	 
	while ($row = mysqli_fetch_assoc($result))
	{ 
	echo '<tr> 
	<td>'.$row['Name'].'</td>
	<td>'.$row['Email'].'</td>
	<td>'.$row['College'].'</td>
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

