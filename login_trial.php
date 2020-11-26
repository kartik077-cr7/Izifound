<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="CSS/form_style.css">
</head>
<body>
<form id="add_form" class="fiform" novalidate autocomplete="off" >
	<h1>New User</h1>
	<div class="fi" >
		<label>
			<span>Institute Name</span>
			<select id="user_type" data-lname="User Type" required data-sname="user_type" >
				<option value="1" >IIITDM JABALPUR</option>
				<option value="1" >JABALPUR ENGINEERING COLLEGE</option>
			</select>
		</label>
	</div>
	<div class="fi" >
		<label>
			<span>Username</span>
			<input id="uname" required = "required" min="2" max="50" data-sname="Username" data-lname="Username" autocomplete="off" />
		</label>
	</div>
	<div class="fi" >
		<label>
			<span>Password</span>
			<input id="pword" type="password" required = 'required'min="6" max="50" data-sname="Password" data-lname="Password" autocomplete="off" />
		</label>
	</div>
		<div class="fi" >
		<label>
			<span>Email</span>
			<input id="email" type="email" required='required' data-sname="Email" data-lname="Email" autocomplete="off" />
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
			<input type="submit" name="Submit" id="Submit" />
		</label>
	</div>
</form>
</body>
</html>