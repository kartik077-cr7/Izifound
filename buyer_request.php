<?php
      session_start();
      //include('class.phpmailer.php');
if(isset($_POST['Submit']))
{

   if(strlen($_POST['Username']) < 1 || strlen($_POST['Password']) < 1 || 
     strlen($_POST['Email']) < 1 || strlen($_POST['Name']) < 1 || strlen($_POST['Roll_no']) < 1)
     {
      $_SESSION['error'] =  "All Feilds are Required";
      header("Location:buyer_request.php");
      return;
     }

    $link = mysqli_connect('localhost','root','',"izifound");

    /*Check link to the mysql server*/ 
    if(!$link)
    { 
    die('Failed to connect to server: ' . mysqli_error($link));
     } 
    
    $user = $_POST['Username'];
    
    $qry = "SELECT * FROM uslogin where Username ='$user'";
    $result = mysqli_query($link,$qry);
      
    $name = $_POST["Name"];
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $_SESSION['error'] = "Only letters and white space allowed in name";
      header("Location:buyer_request.php");
        return;

    }
    
    $email = $_POST["Email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        header("Location:buyer_request.php");
        return;
    }

    if(strpos($_POST['Email'],'@') == -1)
    {
         $_SESSION['error'] = "Enter Valid Email";
        header("Location:buyer_request.php");
        return;

    }
     if(mysqli_num_rows($result)==1)
    {
        $_SESSION['error'] = 'Username already taken';
        header("Location:buyer_request.php");
        return;
    }
        
    $qry = "SELECT * FROM pending_request where Email='$email' and Type='Buyer'";
    $result = mysqli_query($link,$qry);
    if(mysqli_num_rows($result) == 1)
    {
      $_SESSION['error'] = 'We have already send your request .Sorry! for delay';
        header("Location:buyer_request.php");
        return;
    }

        
        $College = $_POST['College'];
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $user = $_POST['Username'];
        $roll_no = $_POST['Roll_no'];
      
       if(!$link)
        { 
          die('Failed to connect to server: ' . mysqli_error($link));
        } 
        $qry = "SELECT * FROM operator where College ='$College'";
        $result = mysqli_query($link,$qry);
       
        while ($row = mysqli_fetch_assoc($result)) 
       {
           $to = $row['Email'];
       }
       
       $subject = "For authentication of User";
       
       $message = "Name: ".$name." is eager to get into our small family(buyers side) please check if he/she is a valid user"."\n"." His email id is ".$email."\n"."Institute Roll No is ".$roll_no."\n"."Requested Username ".$user."\n"." Requested Password ".$password;
       
       $headers = "From: ".$email;

       
      if(mail($to,$subject,$message,$headers))
       {

        $qry = "INSERT INTO pending_request(Email,Type,College,Roll_No) VALUES('$email','Buyer','$College',$roll_no)";
         $result = mysqli_query($link,$qry);

         $_SESSION['success'] = "Message sent successfully we will notify you when operator will authenticate you Thank you"." ".$name." for joining to our small family" ;
         header("Location:index.php");
         return;
        }
       else
       {
        $_SESSION['error'] = "Something went wrong ! try later";
         header("Location:index.php");
         return;
       }
}   
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="CSS/form_style.css">
</head>
<body>
     <?php
        if(isset($_SESSION['error']))
        {
            echo "<p align='center' style='color:red;'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }

     ?>
   <form method="POST" id="add_form" class="fiform" novalidate autocomplete >
  <h1>REQUEST FORM</h1>
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
      <span>Name</span>
      <input name="Name" type="text" autocomplete="off" required>
    </label>
  </div>
  <div class="fi" >
    <label>
      <span>Institute Roll No</span>
      <input type="text" name="Roll_no" autocomplete="off" required>
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

</body>
</html>