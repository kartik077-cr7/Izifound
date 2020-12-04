<?php
session_start();
	if(!isset($_SESSION['admin_college']))
	{
		$_SESSION['error'] = "Unauthorised to access";
		header("Location:main.php");
		return;
	}

	$link = mysqli_connect('localhost','root','','izifound');

	 if(!$link)
	 {
	    die('Failed to connect to server: ' . mysqli_error($link)); 
	 }
    
    $college = $_SESSION['admin_college'];
    $college = strtoupper($college);
    $qry = "SELECT * FROM pending_product WHERE College='$college'";
     $result = mysqli_query($link,$qry);
    $positions = array();

    while($row = mysqli_fetch_assoc($result))
    {
    	$positions[] = $row;
    }

    if(isset($_POST['cancel']))
    {
    	header("Location:admin_main.php");
    	return;
    }
    if(isset($_POST['edit']))
    {
        $college = strtoupper($_SESSION['admin_college']);
        $qry = "DELETE FROM pending_product WHERE College='$college'";
        $result = mysqli_query($link,$qry);

        for($i = 0;$i<9;$i++)
        {
        	if(!isset($_POST['requestor'.$i]))
               continue;
            if($_POST['status'.$i] == "Yes")
            	continue;

            $requestor = $_POST['requestor'.$i];
            $product = $_POST['product'.$i];
    
            $qry = "INSERT INTO pending_product(Email,Product_Name,College) VALUES('$requestor','$product','$college')";
             $result = mysqli_query($link,$qry);

        }
           $_SESSION['success'] = "Changes saved";
        header("Location:main.php");
        return;

        
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
     
      	  if(count($positions) == 0)
      	  {
      	  	echo "<p align='center' style='color:green;'>Congrats! your log is clean</p>";

      	  }
      	  else
      {
    ?>
    <form method="post">
         <?php
	        $pos = 0;
	        echo('<div id="position_fields"><br>');
            echo("<h1 align='center'>YOUR LOG</h1>");
	        foreach($positions as $position)
	        {
	        	$pos++;
	        	echo('<div id="position'.$pos.'">');
	        	echo('<p>Requestor:<input type="text" readonly="readonly" name="requestor'.$pos.'"');
	        	echo('value = "'.$position['Email'].'"/>');
	        	echo('<input type = "button" value ="-" ');
                echo('onclick="$(\'#position'.$pos.'\').remove();return false;">');
                echo("</p>");
                echo('<p>Product_Name:<input type="text" readonly="readonly" name="product'.$pos.'"');
	        	echo('value = "'.$position['Product_Name'].'"/></p>');
            echo('<p>Status: <select name="status'.$pos.'"');
            echo('value = ""/>');
            echo('<option value="Yes">Successfull</option>');
            echo('<option value="No">Pending</option></select></p>');   
                echo('<hr></div>');
	        }
	        echo("</div>");
	    ?>



     <input style="margin-left: 46%;" type="submit" name="edit" value="Save">
		    <input type="submit" name="cancel" value="Cancel">
	  </form>
    </form>
    <?php
    }
      ?>
</body>
</html>