<?php
include_once 'DBConnector.php';
include_once 'user.php';
$con = new DBConnector;
if(isset($_POST['btn-save'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city = $_POST['city_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	//creating a user object
	//note the way we create our object using constructor that will be
	//used to initialize your variables
	$user = new User ($first_name, $last_name, $city,$username,$password);
	if(!$user->valiteForm()){
		$user->createFormErrorSessions();
		header ("Refresh:0");
		die();
	} 

	$res = $user -> save();

	if($res){
		echo "save operation was successful";
	}else{
		echo "An error occured!";
	}
	$con->closeDatabase();
} 
if(isset($_POST['btn-display'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city = $_POST['city_name'];

	$user = new User ($first_name,$last_name,$city);
	$res = $user -> readAll();
	$con->closeDatabase();

	}

?>
<html>
<head>
	<title>Registration</title>
	<script type ="text/javascript" src = "validate.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
	<form method="post" name= "user_details" id="user_detais" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
		<table align="centre">
			<tr>
				<td>
					<div id="form-errors">
						<?php
							session_start();
							if(!empty($SESSION['form_errors'])){
								echo " " . $_SESSION['form_errors'];
								unset ($_SESSION['form_errors']);
							}
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td><input type="text" name="first_name" required="" placeholder="First Name" /></td>
			</tr>
			<tr>
				<td><input type="text" name="last_name"  placeholder="Last Name" /></td>
			</tr>
			<tr>
				<td><input type="text" name="city_name"  placeholder="City" /></td>
			</tr>
			<tr>
				<td><input type="text" name="username"  placeholder="Username" /></td>
			</tr>
			<tr>
				<td><input type="password" name="password"  placeholder="Password" /></td>
			</tr>
			<tr>
				<td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
			</tr>
			<tr>
				<td><button type="submit" name="btn-display"><strong>SHOW RECORDS</strong></button></td>
			</tr>
		</table>
	</form>
</body>
</html>