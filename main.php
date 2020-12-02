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
if(!isset($_SESSION['email']))
{
	header("Location:index.php");
}
else
{
	?>
	<a href="logout.php">LOG OUT</a>
	<?php
}
?>

<!DOCTYPE html>
<html>
<body background="back.jpg">
</body>
<center><img src="Images/logo.png" width="120" height="100" title="Logo of a company" alt="Logo of a company" />

<center>
<table border="1" width="750" height = "250" cellpadding="5" cellspacing="1" bordercolor="black" style="border-right-width:1;">
<tr><td colspan="2" align = "center">-Provider-</td>
     <td colspan = "2" align = "center">-Products-</td></tr>

<tr><td align = "center"><button onclick="document.location='view_provider.php'">View ALL Provider</button></td>
<td align = "center"><button onclick="document.location='update_provider.php'">Update Provider</button></td>
<td align = "center"><button onclick="document.location='view_products.php'">View All Products</button></td>
<td align = "center"><button onclick="document.location='update_product.php'">Update Products</button></td></tr>
<tr><td colspan="2" align="center">-ALL Products and Provider-</td>
<td colspan="2" align="center">-Users-</td></tr>
<tr><td  align="center"><button onclick="document.location='view_all.php'">View Provider and Their Products</button></td>
<td  align="center"><button onclick="document.location='edit_log_provider.php'">-Provider Edit Log-</button>
<td align="center"><button onclick="document.location='view_users.php'">View Users </button></td>
<td align="center"><button onclick="document.location='update_user.php'">
Update Users
</button></td>
</tr>
<tr><td align="center" colspan="4">JUST ADDING</td></tr>
<td align="center"><button onclick="document.location='provider_log.php'">
Provider_Log
</button></td>
<td align="center"><button onclick="document.location='product_addition_log.php'">
Product_Addition_Request
</button></td>
<td align="center"><button onclick="document.location='pending_request.php'">
Pending_Requests
</button></td>
<td align="center"><button onclick="document.location='history.php'">
History
</button></td>
</tr>
<tr>
 <td align="center"><button onclick="document.location='sell_history.php'">Sell history</td>
 	 <td align="center"><button onclick="document.location='feedback.php'">Feedback Form</td>
</tr>

</table></center>
</html>