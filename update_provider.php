<?php
session_start();
if(!isset($_SESSION['admin_college']))
{
	$_SESSION['error'] = "Not authorised to Update";
	header("Location:main.php");
	return;
}
?>
<html>  
<body>  
<center>                              
<?php
     if (isset($_SESSION['success'])) 
      {
	    echo "<p align='center' style='color:green;'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
       }
     
     if (isset($_SESSION['error'])) 
       {
	    echo "<p align='center' style='color:red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
       }
?>        
<h1>Provider Registration/Updation Form</h1>    
<form action="update_provider_part2.php" method="post"> 
<table cellpadding = "10">  
<tr>                    
<td>Provider Email*</td>                                          
<td><input type="email" name="Email" maxlength="25" required="required"></td> 
</tr> 
<tr>  
<td>Name</td> 
<td><input type="text" name="Name" maxlength="15"></td> 
</tr>
<tr>
<td>Rating</td> 
<td><input type="text" name="Rating" maxlength="1"></td> 
</tr> 
<td>Username</td> 
<td><input type="text" name="Username" maxlength="10"></td> 
</tr> 
<td>Password</td> 
<td><input type="password" name="Password" maxlength="10"></td> 
</tr> 
<td><input type="submit" name="submit" value="Insert"></td> 
<td></td>
<td><input type="submit" name="submit" value="Delete"></td> 
</tr> 
</table> 
</form> 
</center> 
</body> 
</html>