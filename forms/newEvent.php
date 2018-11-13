<?php
$message = "";
if (isset($_POST['addEvent'])) {
	if (isset($_POST['eventName'])) {
		$eventName = $_POST['eventName'];
	}
	if (isset($_POST['description'])) {
		$description = $_POST['description'];
	}
	if (isset($_POST['date'])) {
		$date = str_replace("T", " ", $_POST['date']);
	}
	if (isset($_POST['location'])) {
		$location = $_POST['location'];
	}
	if (isset($_POST['firstName'])) {
		$firstName = $_POST['firstName'];
	}
	if (isset($_POST['lastName'])) {
		$lastName = $_POST['lastName'];
	}
	if (isset($_POST['email'])) {
		$email = $_POST['email'];
	}
	if (isset($_POST['gradYear'])) {
		$gradYear = $_POST['gradYear'];
	}


	include_once("../database/database_connection.php");
	include_once('../login/check.php');

	$sql = oci_parse($connect, "SELECT COUNT('event_id') as num FROM events");
	oci_execute($sql);

	$row = oci_fetch_assoc($sql);
	$eventId = $row['NUM'] + 1;

	if ($admin) {
		$query = oci_parse($connect, "INSERT INTO events(event_id, event_name, event_time, event_location, event_info, creator_date, event_approved)
		VALUES(:id, :eventName, TO_DATE(:eventDate, 'yyyy-mm-dd'), :eventLocation, :eventDescription, current_date, 1)
	");
	} else {
		$query = oci_parse($connect, "INSERT INTO events(event_id, event_name, event_time, event_location, event_info, creator_date, event_approved, creator_first_name, creator_last_name, creator_grad_year, creator_email)
			VALUES(:id, :eventName, TO_DATE(:eventDate, 'yyyy-MM-dd HH24:mi'), :eventLocation, :eventDescription, current_date, 0, :firstName, :lastName, :gradYear, :email)
		");
		oci_bind_by_name($query, ":firstName", $firstName);
		oci_bind_by_name($query, ":lastName", $lastName);
		oci_bind_by_name($query, ":gradYear", $gradYear);
		oci_bind_by_name($query, ":email", $email);
	}
	oci_bind_by_name($query, ":id", $eventId);
	oci_bind_by_name($query, ":eventName", $eventName);
	oci_bind_by_name($query, ":eventDate", $date);

	oci_bind_by_name($query, ":eventLocation", $location);
	oci_bind_by_name($query, ":eventDescription", $description);

	if (!oci_execute($query)) exit;

	$message = '<div class="alert alert-success">Event successfuly created!</div>';
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
				<div class="form-group input-group date" id='date'>
					<label for="date">Event date</label>
					<input type="datetime-local" name="date" id="date" class="form-control"
					       min="2018-01-01" max="2020-12-31" value="<?php echo DateTime::createFromFormat('d-M-y', $event['EVENT_TIME'])->format('Y-m-d'); ?>" required/>
				</div>
				<div class="form-group">
					<label for="location">Location of event</label>
					<input type="text" name="location" id="location" class="form-control"
					       placeholder="Location of the event" value="<?php echo $event['EVENT_LOCATION']; ?>" required>
				</div>
			</div>
			<?php
			if (!$admin)
				include('./userInfo.php');
			?>
		</div>
		<button type="submit" name="addEvent" class="btn btn-success">Add Event</button>
		<button type="button" class="btn"
		        onclick="window.location.replace('<?php echo $home; ?>/events/events.php?id=<?php echo $_GET["id"]; ?>')">
			Back
		</button>
		<div style="height: 100px;"></div>
	</form>


</div>

</body>
</html>