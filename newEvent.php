<?php

if(isset($_POST)){
	if(isset($_POST['eventName'])){
		$eventName = $_POST['eventName'];
	}
	if(isset($_POST['description'])){
		$description = $_POST['description'];
	}
	if(isset($_POST['date'])){
		$date = $_POST['date'];
	}
	if(isset($_POST['time'])){
		$time = $_POST['time'];
	}
	if(isset($_POST['location'])){
		$location = $_POST['location'];
	}
	if(isset($_POST['firstName'])){
		$firstName = $_POST['firstName'];
	}
	if(isset($_POST['lastName'])){
		$lastName = $_POST['lastName'];
	}
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}
	if(isset($_POST['gradYear'])){
		$gradYear = $_POST['gradYear'];
	}
}

include_once("database/database_connection.php");
include_once('login/check_cookie.php');

$sql = oci_parse($connect, "SELECT COUNT('event_id') as num FROM events");

$row = oci_execute($sql);
$eventId = $row['id'] + 1;

$curDate = date('mm/dd/yyyy');

$query = oci_parse($connect, "INSERT INTO events VALUES(:id, :email, :curDate, :eventName, :eventDate, :eventLocation, :eventDescription, 1)");
    oci_bind_by_name($query, ":id", $eventId);
    oci_bind_by_name($query, ":email", $email);
    oci_bind_by_name($query, ":curDate", $curDate);
    oci_bind_by_name($query, ":eventName", $eventName);
    oci_bind_by_name($query, ":eventDate", $date);
    oci_bind_by_name($query, ":EventLocation", $location);
    oci_bind_by_name($query, ":eventDescription", $description);
	if (!oci_execute($query)) exit;
	
	$res = oci_execute($query);
	if ($res)
		echo '<br><br> <p style="font-size:20px">Event successfuly created!</p>';
	else{
		$e = oci_error($query); 
        	echo $e['message']; 
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("content/title.php"); ?>
	</head>
	<body>
		<br/>
		<div class="container">
			
		</div>

	</body>
</html>