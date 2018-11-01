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
	if ($message) {
		echo $message;
		exit;
	}
	echo '<h5>' . $event['EVENT_NAME'] . '</h5>';
	echo '<div>'
		. 'Time: ' . $event['EVENT_TIME'] . '<br/>'
		. 'Location: ' . $event['EVENT_LOCATION'] . '<br/>'
		. 'Info: ' . $event['EVENT_INFO'] . '<br/>'
		. '<br/>';
	if ($event['CREATOR_EMAIL'])
		echo 'Creator: ' . $event['CREATOR_FIRST_NAME'] . ' ' . $event['CREATOR_LAST_NAME'] . '<br/>';
	echo 'Date Created: ' . $event['CREATOR_DATE'] . '<br/>'
		. '</div>';

	if ($admin) {
		$query = oci_parse($connect, "
            SELECT * FROM event_participants
            WHERE event_id = :event_id
        ");
		oci_bind_by_name($query, ":event_id", $event["EVENT_ID"]);
		if (!oci_execute($query)) exit;

		$res = oci_fetch_assoc($query);

		echo '<br/>Participants:</br>';
		if (!$res)
			echo 'None<br/><br>';
		else {
			echo '<ul>';
			do {
				echo '<li>Name: ' . $res["USER_FIRST_NAME"] . ' ' . $res["USER_LAST_NAME"] . '<br/>Grad Year: ' . $res["USER_GRAD_YEAR"] . '</li>';
			} while ($res = oci_fetch_assoc($query));
			echo '</ul>';
		}

		if ($event["EVENT_CODE"] == "")
			echo '<button class="btn" onclick="window.location.replace(\'' . $home . '/content/generate.php?id=' . $event["EVENT_ID"] . '\')">
				Generate Code
			</button>';
		else
			echo 'Event Code: ' . $event["EVENT_CODE"];

	} else {

		$query = oci_parse($connect, "
			SELECT * FROM events
			WHERE event_id = :event_id
	    ");
		oci_bind_by_name($query, ":event_id", $_GET["id"]);
		if (!oci_execute($query)) exit;

		$res = oci_fetch_assoc($query);
		if ($res && $res["EVENT_CODE"])
			include("signup.php");
	}
	?>
</div>
</body>
</html>
