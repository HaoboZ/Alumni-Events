<?php
include_once('login/check.php');
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
	<button onclick="window.location.replace('<?php echo $home; ?>/newEvent.php')">Add Event</button>
	<?php
	?>
</div>
</body>
</html>
