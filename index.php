<?php

include_once('login/check_cookie.php');
if (!$valid) {
	header("location:login/login.php");
	exit;
}

?>

<!DOCTYPE html>
<html>
<head>
	<?php include("content/title.php"); ?>
</head>
<body>
<br/>
<div class="container">
	<?php include("content/header.php"); ?>
	<div align="right">
		<a href="login/logout.php">Logout</a>
	</div>
	<br/>
	<?php
	echo '<h2 align="center">Welcome ' . $data['USER_EMAIL'] . '</h2>';
	?>
</div>
</body>
</html>