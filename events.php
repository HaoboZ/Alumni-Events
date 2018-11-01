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
	<?php include("content/header.php");

	$query = oci_parse($connect, "
			SELECT * FROM events
			");

	if (!oci_execute($query)) exit;?>

	<ul>

	<?php while($event = oci_fetch_assoc($query)){
		echo '<a href="' . '?' . $event["EVENT_ID"] . '"' . '>' . $event["EVENT_NAME"] . '</a>';
	}
	?>

	</ul>




</body>


</html>