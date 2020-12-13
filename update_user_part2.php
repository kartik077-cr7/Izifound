<?php
session_start();
if(!isset($_SESSION['admin_college']))
{
	$_SESSION['error'] = "Not authorised to Update";
	header("Location:index.php");
	return;
}


if(isset($_POST['submit']))
{
        
        if($_POST['submit'] == "Cancel")
        {
              header("Location:admin_main.php");
              return;
        }
		if($_POST['submit'] == "Insert")
		{
			$email = $_POST['Email'];
			$name = $_POST['Name'];
			$username = $_POST['Username'];
		    $password = $_POST['Password'];
            $college = $_SESSION['admin_college'];

		    if(strlen($_POST['Name'])<1 || strlen($_POST['Username'])<1 || strlen($_POST['Password'])<1 || strlen($_POST['Email'])<1)
		    {
		    	$_SESSION['error'] = "ALL FEILDS ARE REQUIRED FOR INSERTION";
		    	header('Location:update_user.php');
		    	return;
		    }
            


		    $link = mysqli_connect('localhost','root','','izifound'); 
			
			if(!$link)
			{ 
				die('Failed to connect to server: ' . mysqli_error($link));
			} 

			$email = $_POST['Email'];
            $qry = "SELECT * FROM users where Email = '$email'";
            $results = mysqli_query($link,$qry);
           
		   if(!mysqli_num_rows($results)==0)
		   {
			 $_SESSION['error'] = "USER WITH GIVEN EMAIL ALREADY EXISTS";
			   	header('Location:update_user.php');
			   	return;
		   }

			$query = "INSERT INTO users (EMAIL, Name, College) VALUES ('$email','$name','$college')";

			$results = mysqli_query($link,$query); 
		   
		   if($results == FALSE) 
		   {
			    $_SESSION['error']  = mysqli_error($link). " First ";
			    header('Location:update_user.php');
		    	return;

		   }
		  
		  $query = "INSERT INTO uslogin (Email, Username,Password) VALUES ('$email','$username','$password')";

			$results = mysqli_query($link,$query); 
		   
		 if($results == FALSE) 
		   {
			    $_SESSION['error']  = mysqli_error($link)." second";
			    header('Location:update_user.php');
		    	return;

		   }
		   else
		   {
		   	 $_SESSION['success']  = "Data Inserted Sucessfully";
			    header('Location:update_user.php');
		    	return;
		   }
			

		}
        else
        {
            
		    $link = mysqli_connect('localhost','root','','izifound'); 
			
			if(!$link)
			{ 
				die('Failed to connect to server: ' . mysqli_error($link));
			} 
            
            $email = $_POST['Email'];


            $qry = "SELECT * FROM users where EMAIL = '$email'";
            $results = mysqli_query($link,$qry);
           
		   if(mysqli_num_rows($results)==0)
		   {
		   	$_SESSION['error'] = "NO SUCH USER EXIST";
		   	header('Location:update_user.php');
		   	return;
		   }
           
            $qry = "SELECT College FROM users WHERE Email= '$email'";
            $results = mysqli_query($link,$qry);
            $row = mysqli_fetch_assoc($results);

            if($row['College'] != $_SESSION['admin_college'])
            {
            	$_SESSION['error'] = "YOU ARE NOT AUTHORISED TO DELETE DATA OF ANOTHER COLLEGE";
            	header("Location:update_user.php");
            	return;
            }
        	
              header("Location: sure3.php?Email=".$email);
              return;
        } 
}
?>