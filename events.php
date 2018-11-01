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
	<?php

	$query = oci_parse($connect, "
			SELECT * FROM events
			");
	$message = '';
	if (!oci_execute($query)) $message = 'sql error';
	echo $message;
	echo '<ul>';
	while ($event = oci_fetch_assoc($query)) {
		echo '<a href="' . '?' . $event["EVENT_ID"] . '"' . '>' . $event["EVENT_NAME"] . '</a>';
	}
	echo '</ul>';
	?>
</div>
</body>
</html>