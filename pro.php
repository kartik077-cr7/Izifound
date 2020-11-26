<?php
  
  $link = mysqli_connect('localhost','root','','Izifound'); 

	if(!$link)
	{ 
	   die('Failed to connect to server: ' . mysqli_error($link)); 
	} 
    
	 $term = $_GET['term']."%";                   
     $qry = "SELECT * FROM product where Product_name LIKE
       '$term'"; 
     
     $result = mysqli_query($link,$qry);

     $result2 = array();

     while($row = mysqli_fetch_assoc($result))
     {
     	$result2[] = $row['Product_name'];
     }
/*     $result2 = JSON.parse($result2);*/
     echo(json_encode($result2,JSON_PRETTY_PRINT));

?>