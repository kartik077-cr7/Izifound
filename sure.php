
<?php
  
 session_start();

 if(!isset($_GET['Email']))
  {
  	$_SESSION['error'] = "Get parameter not set";
  	header("Location:index.php");
  	return;
  }

  if(isset($_POST['Cancel']))
  {
  	header('Location:update_provider.php');
  	return;
  }
  if(isset($_POST['Delete']))
  {
      	$email = $_GET['Email'];
	  	$link = mysqli_connect('localhost', 'root', '','izifound'); 
			
			if(!$link) 
			{                  
			  $_SESSION['error'] = 'Failed to connect to server: '. mysqli_error($link); 
                header('Location:update_provider.php');
		    	return;

			} 
  	   
  	   $delete = "DELETE FROM intermediate WHERE  email= '$email'";
       
       $results = mysqli_query($link,$delete); 
                
		if($results == FALSE) 
		   {
			    $_SESSION['error']  = mysqli_error($link);
			    header('Location:update_provider.php');
		    	return;

		   }

  	   $delete = "DELETE FROM prologin WHERE  email= '$email'";
       
       $results = mysqli_query($link,$delete); 
                
		if($results == FALSE) 
		   {
			    $_SESSION['error']  = mysqli_error($link);
			    header('Location:update_provider.php');
		    	return;

		   }

  	   $delete = "DELETE FROM provider WHERE  email= '$email'";
       
       $results = mysqli_query($link,$delete); 
                
		if($results == FALSE) 
		   {
			    $_SESSION['error']  = mysqli_error($link);
			    header('Location:update_provider.php');
		    	return;

		   }
		   else
		   {
		   	 $_SESSION['success']  = "Data DELETED Sucessfully";
			    header('Location:update_provider.php');
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
    echo("<h1 align = 'center'> ARE YOU SURE YOU WATNT TO DELETE ALL DATA OF ".$_GET['Email']);
  ?>
  <form method="post">
  	<input type="submit" value="Delete" name="Delete">
  	<input type="submit" name="Cancel" value="Cancel">
  </form>
</body>
</html>