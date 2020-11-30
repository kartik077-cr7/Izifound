<?php 
 
  session_start();
  if(!isset($_SESSION['college_seller']))
  {
  	header("Location:main.php");
  	return;
  }

  $link = mysqli_connect('localhost','root','',"izifound");  

	/*Check link to the mysql server*/ 
	if(!$link)
	{ 
	   die('Failed to connect to server: ' . mysqli_error($link));
	}
    
    $email = $_SESSION['email'];
    $qry = "SELECT * FROM history where From_Email='$email'";
    $result = mysqli_query($link,$qry);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet" type="text/css" href="CSS/table_style.css">
</style>
</head>
<body>
    <?php
       
       if(mysqli_num_rows($result) == 0)
       {
        	 echo "<p align='center' style='color:green;'>Nothing To show</p>";
       }
       else
       {

        echo '<h1 style="text-align:center;">You Sold Following - </h1>';

         echo  '<table cellspacing="0" cellpading="0" class="styled-table" border="1" style="margin-left:auto;margin-right:auto;">

        <th> Sold_To </th> 
         <th> Product_Name</th>
         <th> His/Her College</th>
         ';
	           while ($row = mysqli_fetch_assoc($result)) 
            {
                $email = $row['Email'];
                $qry = "SELECT * FROM users where Email = '$email'";
                 $result2 = mysqli_query($link,$qry);
                 
                 $row2 = mysqli_fetch_assoc($result2);

                echo '<tr> 
                <td>'.$row2['Name'].'</td>
                <td>'.$row['product_name'].'</td>
                <td>'.$row['College'].'</td>
                </tr>'; 
            }
	     }
	    ?>
</body>
</html>