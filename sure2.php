<?php

session_start();
if(!isset($_GET['Id']))
{
	$_SESSION['Id'] = "Acess denied";
	header("Location:main.php");
	return;
}

if(isset($_POST['Cancel']))
{
	header("Location:update_product.php");
	return;
}

if(isset($_POST['Delete']))
{
	$id = $_GET['Id'];
	$link = mysqli_connect('localhost', 'root', '','izifound'); 
			
			if(!$link) 
			{                  
			  $_SESSION['error'] = 'Failed to connect to server: '. mysqli_error($link); 
                header('Location:update_product.php');
		    	return;

			} 

    $delete = "DELETE FROM intermediate WHERE product_id=$id";
    $results = mysqli_query($link,$delete); 
                
		if($results == FALSE) 
		   {
			    $_SESSION['error']  = mysqli_error($link);
			    header('Location:update_product.php');
		    	return;

		   }

     $delete = "DELETE FROM product WHERE product_id=$id";

      $results = mysqli_query($link,$delete); 
                
		if($results == FALSE) 
		   {
			    $_SESSION['error']  = mysqli_error($link);
			    header('Location:update_product.php');
		    	return;

		   }
		   else
		   {
		   	 $_SESSION['success']  = "PRODUCT DELETED Sucessfully";
			    header('Location:update_product.php');
		    	return;
		   }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
  <?php
    echo("<h1 align = 'center'> ARE YOU SURE YOU WATNT TO DELETE ALL INSTANCES OF PRODUCT WITH ID ".$_GET['Id']);
  ?>
  <form method="post">
  	<input type="submit" value="Delete" name="Delete">
  	<input type="submit" name="Cancel" value="Cancel">
  </form>
</body>
</html>