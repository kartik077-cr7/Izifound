<?php
 session_start();
 if(isset($_GET['key']) )
 	$_SESSION['key'] = $_GET['key'];
 elseif (!isset($_SESSION['key'])) 
 {
 	header("Location:index.php");
 	return;
 }
    
    if(isset($_POST['Submit']))
    {
    	$email = $_POST['Email'];
    	$name = $_POST['Username'];

    	if(strlen($email)<1 || strlen($name)<1)
    	{
    		$_SESSION['error'] = "All feilds are required";
    		header("Location:pass.php");
    		return;
    	}

    	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
           $_SESSION['error'] = "Invalid Email";
           header("Location:pass.php");
           return;
        }
        else
            {
            	$link = mysqli_connect('localhost','root','',"izifound");
    			if(!$link)
    			{ 
    			die('Failed to connect to server: ' . mysqli_error($link));
    	        } 

    	        if($_SESSION['key'] == 'b')
    	        {
                    $qry = "SELECT * FROM uslogin where Email = '$email'";
    	        }
    	        elseif ($_SESSION['key'] == 's') 
    	        {
                    $qry = "SELECT * FROM prologin where Email = '$email'";
    	        }
    	        else
    	        {
                    $qry = "SELECT * FROM oplogin where Email = '$email'";
    	        }

    	        $result = mysqli_query($link,$qry);
    	        if(mysqli_num_rows($result)==0)
    	        {
    	     	 $_SESSION['error'] = "Your Email isn't registered";
    	    	 header("Location:pass.php");
    	    	 return;
    	        } 
    	        else
    	        {
      	        	$row = mysqli_fetch_assoc($result);

      	        	if($row['Username'] == $name)
      	        	{     
        	        		if($_SESSION['key']=='b')
        	        			$password = $row['PASSWORD'];
        	        		elseif ($_SESSION['key'] == 's') 
        	        		{
        	        		 $password = $row['Password'];	
        	        		}
        	        		else
        	        		{
        	        			$password = $row['PASSWORD'];
        	        		}
                        unset($_SESSION['key']);
        	                  
                              $subject = "You Password";
                              $message = "You Password is: ".$password;
                              $email2 = "2019077@iiitdmj.ac.in";
                              $headers = "From: ".$email2;
                              $to = $email;
                             
                              if(mail($to,$subject,$message,$headers))
                               {
                               	 $_SESSION['success'] = "You will shortly receive your password";
                              
                               	 header("Location:index.php");
                               	 return;
                               }
                               else
                               {
                               	$_SESSION['error'] ="Something went wrong!!!.Try again later".
                          
                               	header("Location:index.php");
                               	return;
                               }

      	        	}
      	        	else
      	        	{
      	        		$_SESSION['error'] = "Username isn't correct";
      	        		header("Location:pass.php");
      	        		return;
      	        	}
    	        
    	        }
         }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="CSS/form_style.css">
</head>
<body style="background-image: url(Images/form3.jpg); 
background-size: cover;">
    <?php
        if(isset($_SESSION['error']))
        {
        	echo "<p align='center' style='color:red;'>" . $_SESSION['error'] . "</p>";
        	unset($_SESSION['error']);
        }


    ?>
    <h2 align="center" style="font-size: 2.5em;">Revive Password</h2>
    <form method="POST" id="add_form" class="fiform" novalidate autocomplete >
       
    <div class="fi" >
    <label>
      <span>Email</span>
      <input type="email" name="Email" autocomplete="off" required>
    </label>
  </div>
    <div class="fi" >
    <label>
      <span>Username</span>
      <input name="Username" type="text" autocomplete="off" required>
    </label>
  </div>
    <div class="fi" >
    <label>
      <input type="submit" name="Submit" >
    </label>
  </div>
       </form>
</body>
</html>