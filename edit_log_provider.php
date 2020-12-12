<?php    

    session_start();
	 if(!isset($_SESSION['college_seller']))
	{
		$_SESSION['error'] = "ONLY SELLERS COULD ACCESS IT";
		header("Location:main.php");
		return;
	}
	if(isset($_POST['cancel']))
	{
		header("Location:sell_main.php");
		return;
	}
	if(isset($_POST['edit']))
	{ 

         $link = mysqli_connect('localhost','root','','Izifound'); 

            if(!$link)
            { 
               die('Failed to connect to server: ' . mysqli_error($link)); 
            } 
          

           $email = $_SESSION['email'];
           $qry = "DELETE from intermediate WHERE email = '$email'";
           $result = mysqli_query($link,$qry);
           $rank = 1;
           
           for($i = 1 ; $i<=9;$i++)
           {
 
                if(!isset($_POST['product_name'.$i]))
                    continue;
                if(!isset($_POST['quantity'.$i]))
                    continue;

                $name = $_POST['product_name'.$i];
                $rent = $_POST['rent'.$i];
                $buy = $_POST['buy'.$i];
                $quantity = $_POST['quantity'.$i];
                if($quantity<=0)
                  continue;
                $image = $_POST['image'.$i];
                $qry ="SELECT product_id from product where Product_name = '$name'";
                 $result = mysqli_query($link,$qry);
                 
                 if(mysqli_num_rows($result)==0)
                    continue;

                 $row = mysqli_fetch_assoc($result);

                 $id = $row['product_id'];

                if(isset($_FILES['image'.$i]))
                {
                   $allowed=array('jpg','jpeg','png');
                    $fl_name = $_FILES['image'.$i]['name'];
                    $tmp = explode('.',$fl_name);
                    $fl_extn = strtolower(end($tmp));
                    $fl_temp = $_FILES['image'.$i]['tmp_name'];

                    if(in_array($fl_extn,$allowed))
                    {
                        $image = 'Images/'.substr(md5(time()),0,10).'.'.$fl_extn;
                        move_uploaded_file($fl_temp,$image);
                    }
                    else
                    {
                      continue;
                    }
                }

                $qry = "INSERT INTO intermediate(email,product_id,RENT,Buy,Quantity,image) VALUES ('$email',$id,'$rent','$buy','$quantity','$image')";
                $row = mysqli_query($link,$qry);
                

           }

           $_SESSION['success'] = "Updated";
                header("Location:sell_main.php");
                return;
 
	}
    
     $link = mysqli_connect('localhost','root','','Izifound'); 

	if(!$link)
	{ 
	   die('Failed to connect to server: ' . mysqli_error($link)); 
	} 
                              
    $email = $_SESSION['email'];                             
    $qry = "SELECT * FROM intermediate where email = '$email'"; 
     $result = mysqli_query($link,$qry);
                            
                                                                
     echo '<h1 style="text-align:center;"> Details are - </h1>';
                           
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

 <link rel="stylesheet" type="text/css" href="CSS/edit_log_provider.css">
 <style type="text/css">
      
.ui-tooltip {
    background: white;
    color: #96f226;
    border: 2px solid #454545;
    border-radius: 0px;
    box-shadow: 0 0 
}
.ui-autocomplete {
    background: white;
    border-radius: 0px;
}


 </style>
</head>
<body>
<?php
          if(isset($_SESSION['message']))
          {
          	echo "<p style='color:red;'>" . $_SESSION['message'] . "</p>";
        	unset($_SESSION['message']);
          }
?> 
    <form method="post" enctype="multipart/form-data">
    	<?php
    	$pos = 0;
   echo('<p id = "Product">Products: <input type="submit" id = "addPos" value="+"><br>');
   echo('<div id="position_fields"><br>');


    	foreach($positions as $position)
    	{
            $id = $position['product_id'];
            $qry = "SELECT * FROM product where product_id = $id"; 
            $result = mysqli_query($link,$qry);
            $row = mysqli_fetch_assoc($result);

            $pos++;
            echo('<div id="position'.$pos.'">');
            echo('<p>Product:<input type="text" readonly="readonly" class="products_hover" name="product_name'.$pos.'"');

            echo('value = "'.$row['Product_name'].'"/>');
            echo('<input type = "button" value ="-" ');
             echo('onclick="$(\'#position'.$pos.'\').remove();return false;">');
            echo("</p>");
            echo('<p>Rent: <select name="rent'.$pos.'"');
            echo('value = "'.$position['RENT'].'"/>');
            echo('<option value="Yes">Yes</option>');
            echo('<option value="No">No</option></select></p>');
            echo('<p>Buy: <select name="buy'.$pos.'"');
            echo('value = "'.$position['Buy'].'"/>');
            echo('<option value="Yes">Yes</option>');
            echo('<option value="No">No</option></select></p>');
            echo('<p>Image: <input type = "text" readonly="readonly" name= "image'.$pos.'"');
            echo('value = "'.$position['image'].'"/>');
            echo('<p>Quantity: <input type = "number" required="required" name= "quantity'.$pos.'"');
            echo('value = "'.$position['Quantity'].'"/>');
            echo("</p></div>");
            echo("<hr>");
    	}
    	echo("</div>");
    	?>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    	<script type="text/javascript">
    		   countPos = <?=count($positions)?>;
			$(document).ready(function () {

			window.console && console.log('Document ready called'); 
			$('#addPos').click(function(event) {
			event.preventDefault(); 
			countPos++;
			                            
			window.console && console.log("Adding position "+countPos);

			$('#position_fields').append(

			'<div id="position'+countPos+'">\
			<p>Product: <input class="products_hover" required="required" type="text" name="product_name'+countPos+'" value="" /> \
			 <input type="button" value="-"\
			onclick="$(\'#position'+countPos+'\'). remove(); return false;"></p>\
			<p>Rent: <select name="rent'+countPos+'" value="" ><option value="Yes">Yes</option><option value="No">No</option></select> \
			<p>Buy: <select name="buy'+countPos+'" value="" ><option value="Yes">Yes</option><option value="No">No</option></select> \
            <p>Image: <input type="file" name="image'+countPos+'" value="" />\
			<p>Quantity: <input type="number" required="required" name="quantity'+countPos+'" value="" />  </div><hr>');
            $(".products_hover").autocomplete({
                source:"pro.php"
            });
			});
			});
    	</script>
    	 <input style="margin-left: 45%;" type="submit" name="edit" value="Save">
		    <input type="submit" name="cancel" value="Cancel">
    </form>
    <?php
    echo("<p align ='center' style = 'color:black;'> PRODUCT NOT REGISTERED DON'T WORRY </p>");
    echo("<p align='center' style='color:red;'>" ."<a href = 'product_request.php'>Click to register</a>". "</p>")
    ?>
</body>
</html>



