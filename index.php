<?php
session_start();

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

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <?php
   //include CSS Style Sheet
   echo "<link rel='stylesheet' type='text/css' href='CSS/styles1.css' />";
   ?>
</head>
<body style="background-image: url('Images/back.jpg');
image-rendering: pixelated;
 image-rendering: -webkit-optimize-contrast;
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
 color: black;">
      <img src="Images/logo3.png" style="margin-left: 45%;" alt="IZIFOUND">
     <div class="quoteone">
        <h2 align="center" style="color: grey;">DESCRIPTION</h2>
        <p>
          <q>
            <cite>
          IZIFOUND IS A MARKETPLACE TO SELL OR RENT USED PRODUCTS FOR COLLEGE STUDENTS.TO TAKE BENIFIT OF THIS WEBSITE YOUR SCHOOL MUST BE SIGNED WITH US AND MUST HAVE AN OPERATOR TO MANAGE YOUR PLANS .EVEN HERE YOU MUST CHOOSE GREEDILY AS WE HAVE
          DIFFENT BUYERS WITH THEIR DIFFERENT OFFERS.IF YOU ARE FROM 
          SELLER COMMUNITY THAN HAVE FUN WITH YOUR PROFIT
        </cite>
        </q>
        </p>
      </div>

    <div class="first"> 
         <ul class="photo-grid">
      <li>
        <a href="buy_login.php">
          <figure>
            <img src="Images/sales2.jpg" height="180" width="320" alt="Sales">
            <figcaption><p>BUY</p></figcaption>
          </figure>
        </a>
      </li>
      <li>
        <a href="sell_login.php">
          <figure>
            <img src="Images/sell.jpg" height="180" width="320" alt="SELL">
            <figcaption><p>SELL</p></figcaption>
          </figure>
        </a>
      </li>
      <li><a href="login.php">
          <figure>
            <img src="Images/admin.jpg" height="180" width="320" alt="Admin">
            <figcaption><p>ADMIN</p></figcaption>
          </figure>
        </a>
      </li>
        </ul>
    </div>
    
    <div class="Comment">
      <h2 align="center">User's Voice</h2>
          <figure class="quote">
      <q>
      <i>
         I have been using it since my first day of college and it helps me lot saving a ton.It is worth using.   
      </i>
      </q>
      <figcaption>
        &mdash; Jasmine, <cite>IIIT JABALPUR</cite>  </figcaption>
    </figure>

     <figure class="quote2">
      <q>
      <i>
         I am currently in my fourth semester and have gain a good profit .It's truly said one's waste is other's best.
      </i>
      </q>
      <figcaption>
        &mdash; James, <cite>Jabalpur Engineering College</cite>  </figcaption>
    </figure>
          
    </div>
 <hr>
  <div class="second">
    <h2 align="center" style="display: block;">CREATORS</h2>
         <ul class="photo-grid">
      <li>

          <figure>
            <img src="Images/Kartik.jpg" height="180" width="320" alt="Kartik">
            <figcaption><p>KARTIK</p></figcaption>
          </figure>

      </li>
      <li>
    
          <figure>
            <img src="Images/harshit2.jpg" height="180" width="320" alt="Harshit">
            <figcaption><p>HARSHIT</p></figcaption>
          </figure>
        
      </li>
      <li>
          <figure>
            <img src="Images/Adarsh-2.jpeg" height="180" width="320" alt="Adarsh">
            <figcaption><p>ADARSH</p></figcaption>
          </figure>
      </li>
        </ul>
  </div>
</body>
</html>