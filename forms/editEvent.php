<!--
Loads event data from header parameter of id.

Preloads certain fields that allow editing events. Some fields are removed compared to newEvent.
-->
<?php

include_once("../database/database_connection.php");
include_once('../login/check.php');
include_once('../variables.php');

$message = "";
if (isset($_POST['editEvent'])) {
	if (isset($_POST['eventName'])) {
		$eventName = htmlspecialchars($_POST['eventName']);
	}
	if (isset($_POST['description'])) {
		$description = htmlspecialchars($_POST['description']);
	}
	if (isset($_POST['date'])) {
		$date = str_replace("T"," " ,$_POST['date']);
	}
	if (isset($_POST['location'])) {
		$location = htmlspecialchars($_POST['location']);
	}
	// if (isset($_POST['first_name'])) {
	// 	$firstName = $_POST['first_name'];
	// }
	// if (isset($_POST['last_name'])) {
	// 	$lastName = $_POST['last_name'];
	// }
	// if (isset($_POST['user_email'])) {
	// 	$email = $_POST['user_email'];
	// }
	// if (isset($_POST['grad_year'])) {
	// 	$gradYear = intval($_POST['grad_year']);
	// }

	$query = oci_parse($connect, "UPDATE events SET event_name = :eventName, event_location = :eventLocation, event_info = :eventDescription, event_time = :eventDate WHERE event_id = :id");
	oci_bind_by_name($query, ":id", $_GET["id"]);
	oci_bind_by_name($query, ":eventName", $eventName);
	oci_bind_by_name($query, ":eventDate", $date);

	oci_bind_by_name($query, ":eventLocation", $location);
	oci_bind_by_name($query, ":eventDescription", $description);

	if (!oci_execute($query)) exit;

	$message = '<div class="alert alert-success">Event successfuly edited!</div>';
}

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script>
		$(document).ready(function (){
			let date = moment("<?php echo $event["EVENT_TIME"] ?>", "DD-MMM-YY hh.mm.ss.SSS A");
			$('#date').val(date.format("YYYY-MM-DDTHH:mm"));
			//console.log(date.format("YYYY-MM-DDTHH:mm"));
		});
		function deleteEvent() {
			if (confirm('Are you sure you want to delete?'))
				$.post('../singleEvents/deleteEvent.php', {id:<?php echo $_GET["id"]; ?>}, (e) => {
					if (e) {
						console.log(e);
					} else {
						window.location.replace('<?php echo $home; ?>/events/events.php');
					}
				});
		}
	</script>
</head>
<body>
<div class="container">
	<?php include("../content/header.php"); ?>

	<?php echo $message; ?>

	<form method="post">

		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title" style="font-weight: bold">Event Info</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="eventName">Name of event</label>
					<input type="text" name="eventName" id="eventName" class="form-control"
					       placeholder="Name of the event" value="<?php echo $event['EVENT_NAME']; ?>" required>
				</div>
				<div class="form-group">
					<label for="objective">Event Description</label>
					<textarea name="description" id="description" class="form-control"
					          placeholder="Description" required><?php echo $event['EVENT_INFO']; ?></textarea>
				</div>
			</div>

			<div class="panel-heading">
				<h3 class="panel-title" style="font-weight: bold">Event Time & Location</h3>
			</div>
			<div class="panel-body">
				<div class="form-group input-group date">
					<label for="date">Event date</label><br>
					<input type="datetime-local" name="date" id="date" class="form-control" required/>
				</div>
				<div class="form-group">
					<label for="location">Location of event</label>
					<input type="text" name="location" id="location" class="form-control"
					       placeholder="Location of the event" value="<?php echo $event['EVENT_LOCATION']; ?>" required>
				</div>
			</div>
		</div>
		<button type="submit" name="editEvent" class="btn btn-success">Edit Event</button>
		<button type="button" class="btn"
		        onclick="deleteEvent()">
			Delete
		</button>
		<button type="button" class="btn"
		        onclick="window.location.replace('<?php echo $home; ?>/events/events.php?id=<?php echo $_GET['id']; ?>')">
			Back
		</button>
		<div style="height: 100px;"></div>
	</form>


</div>

</body>
</html>
