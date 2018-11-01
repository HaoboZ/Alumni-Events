<?php
include_once("database/database_connection.php");
include_once('login/check.php');

if (isset($_GET['id'])) {
	include_once("singleEvent.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<?php
	include("content/title.php");
	?>
</head>
<body>
<br/>
<div class="container">
	<?php
	include("content/header.php");
	?>
</div>
</body>
</html>