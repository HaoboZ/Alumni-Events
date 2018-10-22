<?php

include_once(__DIR__ . "/../database/database_connection.php");
include_once('check_cookie.php');
if ($valid) {
	header("location:../index.php");
	exit;
}

$message = '';

if (isset($_POST["signup"])) {
	if (empty($_POST["user_email"]) || empty($_POST["user_password"]) || empty($_POST["first_name"]) || empty($_POST["last_name"]) || empty($_POST["grad_year"])) {
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
			$hash = password_hash($_POST["user_password"], PASSWORD_DEFAULT);
			$query = oci_parse($connect, "
				INSERT INTO user_info
				VALUES (:user_email, :user_password, :first_name, :last_name,:grad_year, 'User', 'Verified')
		    ");
			oci_bind_by_name($query, ":user_email", $_POST["user_email"]);
			oci_bind_by_name($query, ":user_password", $hash);
			oci_bind_by_name($query, ":first_name", $_POST["first_name"]);
			oci_bind_by_name($query, ":last_name", $_POST["last_name"]);
			oci_bind_by_name($query, ":grad_year", $_POST["grad_year"]);
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
	<?php include(__DIR__ . "/../content/title.php"); ?>
</head>
<body>
<br/>
<div class="container">
	<h2 align="center">Alumni Engagement Recording System</h2>
	<br/>
	<h4>Signup</h4>
	<span><?php echo $message; ?></span>
	<form method="post">
		<div class="form-group">
			<label for="user_email">User Email</label>
			<input type="text" name="user_email" id="user_email" class="form-control"/>
		</div>
		<div class="form-group">
			<label for="user_password">Password</label>
			<input type="password" name="user_password" id="user_password" class="form-control"/>
		</div>
		<div class="form-group">
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" id="first_name" class="form-control"/>
		</div>
		<div class="form-group">
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" id="last_name" class="form-control"/>
		</div>
		<div class="form-group">
			<label for="grad_year">Graduation Year</label>
			<select name="grad_year" id="grad_year">
				<option value="">Select Year</option>
				<?php
				for ($i = 1950; $i < date('Y'); $i++) {
					echo '<option value=\"' . $i . '\">' . $i . '</option>';
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<input type="submit" name="signup" id="signup" class="btn btn-info" value="Signup"/>
			<input type="button" class="btn btn-info" onClick="window.location = './login.php'"
			       value="Back"/>
		</div>
	</form>
</div>
</body>
</html>
