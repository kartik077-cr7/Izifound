<?php
session_start();
if(!isset($_SESSION['admin_college']))
{
	$_SESSION['error'] = "Not authorised to Update";
	header("Location:index.php");
	return;
}

if(isset($_POST['submit']))
{
         if($_POST['submit'] == "Cancel")
        {
              header("Location:admin_main.php");
              return;
        }
	     if($_POST['submit'] == 'Insert')
	     {
             $id = $_POST['Product_id'];
             $name = $_POST['Product_name'];

             if(strlen($name)<1 || strlen($id)<1)
             {
		    	$_SESSION['error'] = "ALL Feilds are required for Insertion";
		    	header('Location:update_product.php');
		    	return;
		    }
            
            if(!is_numeric($id))
            {
                $_SESSION['error'] = "ID MUST BE AN INTEGER";
		    	header('Location:update_product.php');
		    	return;
            }
              
             $link = mysqli_connect('localhost','root','','izifound'); 
            
			if(!$link)
			{ 
				die('Failed to connect to server: ' . mysqli_error($link));
			} 

			$query = "SELECT * FROM product where  product_id = $id";
			
			$results = mysqli_query($link,$query);

             if(!mysqli_num_rows($results)==0)
		   {
		   	$_SESSION['error'] = "PRODUCT ID ALREADY EXIST";
		   	header('Location:update_product.php');
		   	return;
		   }

		   $query = "INSERT INTO product (product_id,Product_name) VALUES
		   ($id,'$name')";

			$results = mysqli_query($link,$query); 
		   
		   if($results == FALSE) 
		   {
			 $_SESSION['error']  = mysqli_error($link). " First ";
			    header('Location:update_product.php');
		    	return;

		   }
		   else
		   {
		   	$_SESSION['success'] = "PRODUCT INSERTED";
		   	 header('Location:update_product.php');
		    	return;
		   }

	   }
	   else
	   {
	   	    $link = mysqli_connect('localhost','root','','izifound'); 
			
			$id = $_POST['Product_id'];
			
			if(!$link)
			{ 
				die('Failed to connect to server: ' . mysqli_error($link));
			} 

			$query = "SELECT * FROM product where  product_id = $id";
			
			$results = mysqli_query($link,$query);

             if(mysqli_num_rows($results)==0)
		   {
		   	$_SESSION['error'] = "PRODUCT ID DID NOT EXIST";
		   	header('Location:update_product.php');
		   	return;
		   }

		   $qry = "SELECT * FROM intermediate where product_id=$id";
		   $results = mysqli_query($link,$qry);
		   if(mysqli_num_rows($results)==0)
		   {
		   	  header("Location: sure2.php?Id=".$id);
              return;
		   }
		   else
		   {
		   	$_SESSION['error'] = "YOU CAN'T DELETE THIS PRODUCT";
		   	header("Location:update_product.php");
		   	return;
		   }


	   }

}


?>