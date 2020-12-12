<?php
require "navbar.php";
      session_start();
      //include('class.phpmailer.php');

      $college = $_SESSION['college_seller'];
      $email = $_SESSION['email'];


if(isset($_POST['Submit']))
{
     $link = mysqli_connect('localhost','root','','Izifound'); 

            if(!$link)
            { 
               die('Failed to connect to server: ' . mysqli_error($link)); 
            } 

      $qry = "SELECT Email FROM operator where college = '$college'";
      $result = mysqli_query($link,$qry);
      $row = mysqli_fetch_assoc($result);
      $to = $row['Email'];
      
      $name = $_POST['Name'];
      $product = strtoupper($_POST['product_name']);
       
       $subject = "For addition of new product";
       $message = "Name: ".$name." want to insert new product naming ".$product."\n"." His email id is ".$email."\n"." Please add product so that he could add it into his inventory ".
      
       $headers = "From: ".$email;
       
     
      $qry = "SELECT * FROM pending_product where Product_Name = '$product'";
      $result = mysqli_query($link,$qry);
      if(mysqli_num_rows($result) == 1)
      {
        $_SESSION['error'] = "The request for inclusion of that product is already send.";
        header("Location:product_request.php");
        return;
      }


        if(mail($to,$subject,$message,$headers))
       {
         
         $qry = "INSERT INTO pending_product(Email,Product_Name,College) VALUES('$email','$product','$college')";
          $result = mysqli_query($link,$qry);
         $_SESSION['success'] = "Message sent successfully operator will shortly include new product Thank you"." ".$name." for for actively being part of our small family" ;
         header("Location:main.php");
         return;
       }
       else
       {
        $_SESSION['error'] = "Something went wrong ! try later";
         header("Location:main.php");
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
       <input name="College" type="text" value="<?=$college?>" autocomplete="off" readonly="readonly" required>
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
      <span>Product Name</span>
      <input type="text" name="product_name" autocomplete="off" required>
    </label>
  </div>
    <div class="fi" >
    <label>
      <span>Email</span>
      <input type="email" name="Email" readonly="readonly" value="<?=$email?>" autocomplete="off" required>
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