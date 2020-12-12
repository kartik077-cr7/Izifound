<?php
 session_start();

   if(isset($_SESSION['college_user']))
   {
    $index = 0;
   }
   else if(isset($_SESSION['college_seller']))
   {
    $index = 1;
   }
   else
    $index = 2;
	 if(!isset($_SESSION['email']))
	 {
	 	header("Location:index.php");
	 	return;
	 }
	 $link = mysqli_connect('localhost','root','','Izifound');

	 if(!$link)
	 {
	    die('Failed to connect to server: ' . mysqli_error($link)); 
	 }
     
     $email = $_SESSION['email'];

     $qry = "SELECT * FROM feedback where To_Email='$email'";
     $result = mysqli_query($link,$qry);

      $positions = array();                    
    
    while($row = mysqli_fetch_assoc($result))
     {                      
           $positions[] = $row;
     } 

	     if(isset($_POST['cancel']))
	  {
      if($index == 0){
	    header("Location:buy_main.php");
	    return;
       }
       if($index == 1){
      header("Location:sell_main.php");
      return;
       }
       if($index == 2){
      header("Location:admin_main.php");
      return;
       }
	  }
	  if(isset($_POST['edit']))
	  {
          $link = mysqli_connect('localhost','root','','izifound');
     
		     if(!$link)
		     {
		      die('Failed to connect to server: ' . mysqli_error($link));
		     }
		     $email = $_SESSION['email'];
             
             $rank = 1;

             for($i = 0;$i<9;$i++)
             {

             	if(!isset($_POST['rating'.$i]))
             		continue;
                $rating = $_POST['rating'.$i];
                $sure = $_POST['sure'.$i];
                $provider = $_POST['provider'.$i];
                $product = $_POST['product'.$i];
                

                if($sure == "Yes")
                {
                	if($rating>=0 && $rating<=5)
                	{
                       

                       $qry = "SELECT COUNT(*) FROM history where From_Email = '$provider' AND rated = 1";
                       $result = mysqli_query($link,$qry);
                        
                        $row = mysqli_fetch_assoc($result);
                       $count = $row['COUNT(*)'];
                       $new = $count+1;

                       $qry = "UPDATE history SET rated = 1 where From_Email = '$provider' AND Email='$email' AND product_name='$product'";

                       $result = mysqli_query($link,$qry);
                        
                       

                       $qry = "UPDATE provider SET RATING = ($count*RATING+$rating)/$new where EMAIL='$provider'";
                       $result = mysqli_query($link,$qry);

                       $qry = "DELETE FROM feedback where From_Email=
                       '$provider' AND To_Email='$email' AND Product='$product'";
                       $result = mysqli_query($link,$qry);

                       $_SESSION['success'] = "Successfully rated";
                      if($index == 0){
                              header("Location:buy_main.php");
                              return;
                               }
                               if($index == 1){
                              header("Location:sell_main.php");
                              return;
                               }
                               if($index == 2){
                              header("Location:admin_main.php");
                              return;
                               }

                	}
                	else
                	{
                		$_SESSION['error'] = "Correct the rating value";
                        header("Location:feedback.php");
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
	 <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
	<style type="text/css">
	#position_fields
{
	background-color: pink;
    margin-left: 35%;
    margin-right: 30%;
}

body
{
	font-size: 2em;
}
</style>
</head>
<body>
	 <?php
       
        if(isset($_SESSION['error']))
        {
          echo "<p align='center' style='color:red;'>" . $_SESSION['error'] . "</p>";
          unset($_SESSION['error']);
        }

     
      	  if(count($positions) == 0)
      	  {
      	  	echo "<p align='center' style='color:green;'>No! one to rate</p>";

      	  }
      	  else
      {
    ?>
   <form method="post">
		<?php
	        $pos = 0;
	        echo('<div id="position_fields"><br>');
            echo("<h1 align='center'>Rating Form</h1>");
	        foreach($positions as $position)
	        {
	        	$pos++;
	        	echo('<div id="position'.$pos.'">');
	        	echo('<p>Rate provider:<input type="text" readonly="readonly" name="provider'.$pos.'"');
	        	echo('value = "'.$position['From_Email'].'"/>');
                echo("</p>");
                echo('<p>Product:<input type="text" readonly="readonly" name="product'.$pos.'"');
	        	echo('value = "'.$position['Product'].'"/></p>');
	            echo('<p>Rating(1-5):<input type="number" required="required" name="rating'.$pos.'"');
	            echo('value = " "/>');   
	             echo('<p>Sure: <select name="sure'.$pos.'"');
	            echo('value = ""/>');
	            echo('<option value="Yes">Definitely</option>');
	            echo('<option value="No">Unsure</option></select></p>');
                echo('<hr></div>');
	        }
	        echo("</div>");
	    ?>
	       <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <input style="margin-left: 46%;" type="submit" name="edit" value="Save">
		    <input type="submit" name="cancel" value="Cancel">
	  </form>
	  <?php
	}
	  ?>
</body>
</html>