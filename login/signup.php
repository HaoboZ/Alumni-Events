<?php

include_once(__DIR__ . "/../database/database_connection.php");
include_once('check_cookie.php');
if ($valid) {
	header("location:../index.php");
	exit;
}

$message = '';

if (isset($_POST["signup"])) {
	if (empty($_POST["user_email"]) || empty($_POST["user_password"]) || empty($_POST["first_name"]) || empty($_POST["last_name"])) {
		$message = "<div class='alert alert-danger'>All Fields Are Required</div>";
	} else {
		$query = oci_parse($connect, "
			SELECT * FROM user_info
			WHERE user_email = :user_email
	    ");
		oci_bind_by_name($query, ":user_email", $_POST["user_email"]);
		if (!oci_execute($query)) exit;

		$res = oci_fetch_assoc($query);

		if ($res) {
			$message = "<div class='alert alert-danger'>Email Address Already Registered</div>";
		} else {
			$id = uniqid();
			$query = oci_parse($connect, "
				INSERT INTO user_info
				VALUES (:user_email, :password, :first_name, :last_name, 'User', 'Verified')
		    ");
			oci_bind_by_name($query, ":user_email", $_POST["user_email"]);
			oci_bind_by_name($query, ":password", password_hash($_POST["password"], PASSWORD_DEFAULT));
			oci_bind_by_name($query, ":first_name", $_POST["first_name"]);
			oci_bind_by_name($query, ":last_name", $_POST["last_name"]);
			if (!oci_execute($query)) exit;

			header("location:verify.php");
			exit;
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Alumni Engagement Recording System</title>
	<?php include(__DIR__ . "/../libraries.php"); ?>
</head>
<body>
<br/>
<div class="container">
	<h2 align="center">Alumni Engagement Recording System</h2>
	<br/>
	<div class="panel panel-default">

		<div class="panel-heading">Signup</div>
		<div class="panel-body">
			<span><?php echo $message; ?></span>
			<form method="post">
				<div class="form-group">
					<label>User Email</label>
					<input type="text" name="user_email" id="user_email" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="user_password" id="user_password" class="form-control"/>
				</div>
				<div class="form-group">
					<label>First Name</label>
					<input type="text" name="first_name" id="first_name" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Last Name</label>
					<input type="text" name="last_name" id="last_name" class="form-control"/>
				</div>
				<div class="form-group">
					<input type="submit" name="signup" id="signup" class="btn btn-info" value="Signup"/>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>