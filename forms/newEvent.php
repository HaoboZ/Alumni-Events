<!--
Creates a new event.

Admins do not need to add user info.
-->
<?php
$message = "";
if (isset($_POST['addEvent'])) {
	if (isset($_POST['eventName'])) {
		$eventName = htmlspecialchars($_POST['eventName']);
	}
	if (isset($_POST['description'])) {
		$description = htmlspecialchars($_POST['description']);
	}
	if (isset($_POST['date'])) {
		$date = str_replace("T", " ", $_POST['date']);
	}
	if (isset($_POST['location'])) {
		$location = htmlspecialchars($_POST['location']);
	}
	if (isset($_POST['first_name'])) {
		$firstName = htmlspecialchars($_POST['first_name']);
	}
	if (isset($_POST['last_name'])) {
		$lastName = htmlspecialchars($_POST['last_name']);
	}
	if (isset($_POST['user_email'])) {
		$email = htmlspecialchars($_POST['user_email']);
	}
	if (isset($_POST['grad_year'])) {
		$gradYear = intval($_POST['grad_year']);
	}


	include_once("../database/database_connection.php");
	include_once('../login/check.php');

	// $sql = oci_parse($connect, "SELECT MAX('event_id') as num FROM events");
	// oci_execute($sql);

	// $row = oci_fetch_assoc($sql);
	// $eventId = $row['NUM'] + 1;
	$eventId = uniqid();

	if ($admin) {
		$query = oci_parse($connect, "INSERT INTO events(event_id, event_name, event_time, event_location, event_info, creator_date, event_approved)
		VALUES(:id, :eventName, TO_TIMESTAMP(:eventDate, 'yyyy-mm-dd HH24:mi'), :eventLocation, :eventDescription, current_timestamp, 1)
	");
	} else {
		$query = oci_parse($connect, "INSERT INTO events(event_id, event_name, event_time, event_location, event_info, creator_date, event_approved, creator_first_name, creator_last_name, creator_grad_year, creator_email)
			VALUES(:id, :eventName, TO_TIMESTAMP(:eventDate, 'yyyy-MM-dd HH24:mi'), :eventLocation, :eventDescription, current_timestamp, 0, :firstName, :lastName, :gradYear, :email)
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
// echo $date;
// echo '<br>';
// echo $curDate;

	if (!oci_execute($query)) exit;
	//$message = $_POST["grad_year"];
	$message = '<div class="alert alert-success">Event successfuly created!</div>';
}
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
					       placeholder="Name of the event" required>
				</div>
				<div class="form-group">
					<label for="objective">Event Description</label>
					<textarea name="description" id="description" class="form-control"
					          placeholder="Description" required></textarea>
				</div>
			</div>

			<div class="panel-heading">
				<h3 class="panel-title" style="font-weight: bold">Event Time & Location</h3>
			</div>
			<div class="panel-body">
				<div class="form-group input-group date" id='date'>
					<label for="date">Event date & time</label><br>
					<input type="datetime-local" name="date" id="date" class="form-control" required/>
				</div>
				<!--<div class="form-group input-group time" id='time'>
					<label for="time">Event time</label>
					<input type="time" name="time" id="time" class="form-control" required>
				</div>-->
				<!--
				<div class="form-group input-group date" id='datetimepicker1'>
					<label for="date">Event Date and Time</label>
					<input type="text" name="date" id="date" class="form-control" required>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
				<script type="text/javascript">
					$(function () {
					$('#datetimepicker1').datetimepicker();
					});
				</script>-->
				<div class="form-group">
					<label for="location">Location of event</label>
					<input type="text" name="location" id="location" class="form-control"
					       placeholder="Location of the event" required>
				</div>
			</div>
			<?php
			if (!$admin)
				include('./userInfo.php');
			?>
		</div>
		<button type="submit" name="addEvent" class="btn btn-success">Add Event</button>
		<div style="height: 100px;"></div>
	</form>


</div>

</body>
</html>
