<?php
$message = '';
$event = null;

$query = oci_parse($connect, "
        SELECT * FROM events
        WHERE event_id = :event_id
    ");
oci_bind_by_name($query, ":event_id", $_GET["id"]);
if (!oci_execute($query)) exit;

$event = oci_fetch_assoc($query);
if (!$event)
	$message = "<div class='alert alert-danger'>No event that matches id</div>";
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("../content/title.php"); ?>
</head>
<body>
<br/>
<div class="container">
	<?php include("../content/header.php"); ?>
	<?php
	if ($message) {
		echo $message;
		exit;
	}
	include('eventInfo.php');

	if ($admin) {
		echo '<button class="btn" onclick="window.location.replace(\'' . $home . '/forms/editEvent.php?id=' . $event["EVENT_ID"] . '\')">
				Edit Event
			</button>';
		if (!$event["EVENT_APPROVED"]) {
			echo '<button class="btn" onclick="window.location.replace(\'' . $home . '/singleEvents/approved.php?id=' . $event["EVENT_ID"] . '\')">
				Approve Event
			</button>';
		} else {
			include('participants.php');

			if (!$event["EVENT_CODE"])
				echo '<button class="btn" onclick="window.location.replace(\'' . $home . '/singleEvents/generate.php?id=' . $event["EVENT_ID"] . '\')">
				Generate Code
			</button>';
			else
				echo '<p>Event Code: ' . $event["EVENT_CODE"] . '</p>';
		}
	} else {
		if ($event["EVENT_APPROVED"] && $event["EVENT_CODE"])
			include("signup.php");
	}
	?>
</div>
</body>
</html>
