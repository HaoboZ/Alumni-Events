<?php
include_once('login/check.php');
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("content/title.php"); ?>
	<script src="calendar/calendar.js"></script>
	<link href="calendar/calendar.css" rel="stylesheet"/>
</head>
<body>
<br/>
<div class="container">
	<?php include("content/header.php"); ?>
	<button onclick="window.location.replace('<?php echo $home; ?>/forms/newEvent.php')">Add Event</button>
	<?php
	include('calendar/calendar.php');
	?>
</div>
</body>
</html>
