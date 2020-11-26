<?php
session_start();

  if(!isset($_SESSION['email']))
  {
  	header("Location:index.php");
  	return;
  }
  
  $link = mysqli_connect('localhost','root','','izifound');

	 if(!$link)
	 {
	    die('Failed to connect to server: ' . mysqli_error($link)); 
	 }
    
    $email = $_SESSION['email'];

    $qry = "SELECT * FROM history WHERE Email ='$email'";
    $result = mysqli_query($link,$qry);
    $positions = array();                    
    while($row = mysqli_fetch_assoc($result))
     {                      
           $positions[] = $row;
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
       if(count($positions)==0)
       {
       	 echo "<p align='center' style='color:green;'>Nothing To show</p>";
       }
       else
       {
	        $pos = 0;
	        echo('<div id="position_fields"><br>');
            echo("<h1 align='center'>YOUR HISTORY</h1>");
	        foreach($positions as $position)
	        {
	        	$pos++;
	        	echo('<div id="position'.$pos.'">');
	        	echo('<p>FROM:<input type="text" readonly="readonly" name="requestor'.$pos.'"');
	        	echo('value = "'.$position['From_Email'].'"/>');
                echo("</p>");
               echo('<p>Product:<input type="text" readonly="readonly" name="college'.$pos.'"');
	        	echo('value = "'.$position['product_name'].'"/>');
                echo('<p>College:<input type="text" readonly="readonly" name="product'.$pos.'"');
	        	echo('value = "'.$position['College'].'"/></p>');   
                echo('<hr></div>');
	        }
	        echo("</div>");
	     }
	    ?>
</body>
</html>