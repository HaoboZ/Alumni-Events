<?php
$message = "";
if (isset($_POST)) {
	if (isset($_POST['eventName'])) {
		$eventName = $_POST['eventName'];
	}
	if (isset($_POST['description'])) {
		$description = $_POST['description'];
	}
	if (isset($_POST['date'])) {
		$date = $_POST['date'];
	}
	if (isset($_POST['time'])) {
		$time = $_POST['time'];
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


include_once("database/database_connection.php");
include_once('login/check.php');

$sql = oci_parse($connect, "SELECT COUNT('event_id') as num FROM events");
oci_execute($sql);

$row = oci_fetch_assoc($sql);
$eventId = $row['NUM'] + 1;

$curDate = date('Y-m-d');

$query = oci_parse($connect, "INSERT INTO events(event_id, event_name, event_time, event_location, event_info, creator_date, event_approved)
											VALUES(:id, :eventName, TO_DATE(:eventDate, 'yyyy-mm-dd'), :eventLocation, :eventDescription, TO_DATE(:curDate, 'yyyy-mm-dd'), 1)");
oci_bind_by_name($query, ":id", $eventId);
/*oci_bind_by_name($query, ":email", $email);*/
oci_bind_by_name($query, ":eventName", $eventName);
oci_bind_by_name($query, ":eventDate", $date);

oci_bind_by_name($query, ":eventLocation", $location);
oci_bind_by_name($query, ":eventDescription", $description);
oci_bind_by_name($query, ":curDate", $curDate);
/*oci_bind_by_name($query, ":firstName", $firstName);
oci_bind_by_name($query, ":lastName", $lastName);
oci_bind_by_name($query, ":gradYear", $gradYear);*/
// echo $date;
// echo '<br>';
// echo $curDate;

if (!oci_execute($query)) exit;

$message = '<div class="alert alert-success">Event successfuly created!</div>';
}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("content/title.php"); ?>
</head>
<body>
<div class="container">
	<?php include("content/header.php"); ?>

	<? echo $message ?>

	<form role="form" enctype="multipart/form-data" id="NewEventFormSubmit" action="newEvent.php" method="post">

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
					<label for="date">Event date</label>
					<input type="date" name="date" id="date" class="form-control"
							min="2018-01-01" max="2020-12-31" required/>
				</div>
				<div class="form-group input-group time" id='time'>
					<label for="time">Event time</label>
					<input type="time" name="time" id="time" class="form-control" required>
				</div>
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
				echo '<div class="panel-heading">
				<h3 class="panel-title" style="font-weight: bold">Contact Info</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="firstName">First Name</label>
					<input type="text" name="firstName" id="firstName" class="form-control" placeholder="Your first name" required>
				</div>
				<div class="form-group">
					<label for="lastName">Last Name</label>
					<input type="text" name="lastName" id="lastName" class="form-control" placeholder="Your last name" required>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control" placeholder="Your email" required>
				</div>
				<div class="form-group">
					<label for="gradYear">Graduation Year</label>
					<input type="number" name="gradYear" id="gradYear" class="form-control" placeholder="Year of your graduation" required>
				</div>
			</div>';
			?>
		</div>
		<button type="submit" id="addEvent" class="btn btn-success">Add Event</button>
		<div style="height: 100px;"></div>
	</form>



</div>

</body>
</html>