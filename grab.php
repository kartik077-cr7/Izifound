<?php
      session_start();
      
      if(!isset($_GET['email']) || !isset($_SESSION['email']))
      {
        header("Location:index.php");
      }

      if(isset($_SESSION['college_user']))
        $college = $_SESSION['college_user'];

      if(isset($_SESSION['admin_college']))
        $college = $_SESSION['admin_college'];

      if(isset($_SESSION['college_seller']))
        $college = $_SESSION['college_seller'];

      if(isset($_POST['Submit']))
      {
        $college = $_POST['College'];
        $phone = $_POST['Phone'];
        $email = $_POST['Email'];
        $name = $_POST['Name'];
        $to = $_POST['To'];
        $product = $_POST['Product'];


            $subject = "WANT TO BUY";
            $message = "Name: ".$name."\n"."Email :".$email.
            "\n"."From Institute: ".$college."\n"."Require :".$product."\n"."Please contact him and update him further";
      
       
           $headers = "From: ".$email;
           

          if(mail($to,$subject,$message,$headers))
           {
            
              $link = mysqli_connect('localhost','root','',"izifound");

              /*Check link to the mysql server*/ 
              if(!$link)
              { 
              die('Failed to connect to server: ' . mysqli_error($link));
               } 

              $qry = "INSERT INTO pendin_buyes(From_Email,To_Email,College,Product_Name) VALUES('$to','$email','$college','$product')" ;
                 $result = mysqli_query($link,$qry);

            $_SESSION['success'] = "Message sent successfully provider will update you Thank you ".$_POST['Name'];
            header("Location:main.php");
            return;
            }
           else
           {
            $_SESSION['error'] = "Something went wrong ! try later".$message."To ".$_POST['To'];
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
     <h2 align="center">REQUEST FORM</h2>
    <form method="post" id="add_form" class="fiform">
  <div class="fi" >
    <label>
      <span>Institute Name</span>
      <input type="text" name="College" value="<?=$college?>" readonly="readonly" >
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
      <span>Email</span>
      <input type="email" name="Email" value="<?=$_SESSION['email']?>" autocomplete="off" readonly="readonly" required>
    </label>
  </div>
    <div class="fi" >
    <label>
      <span>TO</span>
      <input type="email" name="To" readonly="readonly" value="<?=$_GET['email']?>" autocomplete="off" required>
    </label>
  </div>
    <div class="fi" >
    <label>
      <span>Product</span>
      <input type="text" name="Product" readonly="readonly" value="<?=$_GET['product']?>" autocomplete="off" required>
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