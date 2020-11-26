<?php

session_start();
if(isset($_POST['Submit']))
{

   if(strlen($_POST['Username']) < 1 || strlen($_POST['Password']) < 1 || 
     strlen($_POST['Email']) < 1)
     {
      $_SESSION['error'] =  "All Feilds are Required";
      header("Location:login.php");
      return;
     }

	$link = mysqli_connect('localhost','root','',"izifound");

	/*Check link to the mysql server*/ 
	if(!$link)
	{ 
	die('Failed to connect to server: ' . mysqli_error($link));
	 } 
    
    $college = $_POST['College'];
    
	$qry = "SELECT * FROM operator where college ='$college'";
	$result = mysqli_query($link,$qry);

	 if(mysqli_num_rows($result)==0)
	{
	 	$_SESSION['error'] = 'No such college exist in our database';
	 	header("Location:login.php");
	 	return;
	}
	else
	{
     while ($row = mysqli_fetch_assoc($result)) 
     {
        $email = $row['Email'];
     }
      
      echo($email);
      if($email != $_POST['Email'])
      {
        $_SESSION['error']  = "Invalid Email";
        header("Location:login.php");
        return;
      }
     
     $qry = "SELECT * FROM oplogin where Email = '$email'";
     $result = mysqli_query($link,$qry);

      $Username = $_POST['Username'];
      $password = $_POST['Password']; 

        while($row = mysqli_fetch_assoc($result) )
        {
        	if($row['Username'] == $Username && $row['PASSWORD'] == $password)
        	{
        		$_SESSION['success'] = "Logged In";
        		$_SESSION['admin_college'] = $college;
            $_SESSION['email'] = $email;
        		header("Location:main.php");
        		return;
        	}
        	else
        	{
               $_SESSION['error'] = "Enter correct Username and Password";
               header("Location:login.php");
               return;
        	}
        }
	}
}
	 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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
	<br>

		<form method="POST" id="add_form" class="fiform" novalidate autocomplete >
  <h1>ADMIN LOG IN</h1>
  <div class="fi" >
    <label>
      <span>Institute Name</span>
      <select  name="College" required/>
        <option value="IIITDM JABALPUR" >IIITDM JABALPUR</option>
        <option value="JABALPUR ENGINEERING COLLEGE" >JABALPUR ENGINEERING COLLEGE</option>
      </select>
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
      <span>Password</span>
      <input name="Password" type="password" autocomplete="off" minlength="6" required>
    </label>
  </div>
    <div class="fi" >
    <label>
      <span>Email</span>
      <input type="email" name="Email" autocomplete="off" required>
    </label>
  </div>
  <!--<div class="fi" >
    <label>
      <span>Address</span>
      <textarea id="add" required min="6" max="50" data-sname="addr" data-lname="Address" ></textarea>
    </label>
  </div>!-->
  <div class="fi" >
    <label>
      <input type="submit" name="Submit" >
    </label>
  </div>
</form>

   	
   </form>
</body>
</html>