<!--
Main events page.

Shows list of events if no id parameter is passed in from the header.
If there is id in header, will show detailed event information based on id.
-->
<?php
include_once("../database/database_connection.php");
include_once('../login/check.php');

if (isset($_GET['id'])) {
	include_once("../singleEvents/singleEvent.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("../content/title.php"); ?>
	<script src="filter.js"></script>
</head>
<body>
<br/>
<div class="container">
	<?php include("../content/header.php"); ?>
	<?php
	if ($admin) {
		$query = oci_parse($connect, "
			SELECT * FROM events
			");
	} else {
		$query = oci_parse($connect, "
			SELECT * FROM events WHERE event_approved = 1
			");
	}
	$message = '';
	if (!oci_execute($query)) $message = 'sql error';
	echo $message;
	// echo '<ul>';
	// while ($event = oci_fetch_assoc($query)) {
	// 	echo '<a href="' . '?id=' . $event["EVENT_ID"] . '"' . '>' . $event["EVENT_NAME"] . '</a><br>';
	// }
	// echo '</ul>';
	?>
	<form action="#" method="get">
		<div class="input-group">
			<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
			<input class="form-control" id="system-search" name="q" placeholder="Search for" required>
			<span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    Search
                </button>
            </span>
		</div>
	</form>
	<table id="eventList" class="table table-list-search">
		<thead>
		<tr>
			<th>Event Name</th>
			<th>Event Location</th>
			<th>Event Time</th>
		</tr>
		</thead>
		<tbody>
		<?php while ($event = oci_fetch_assoc($query)) {
			echo '
		<tr';
			if ($event["EVENT_APPROVED"] == 0) {
				echo ' bgcolor="#FF9999"';
			}
			echo '>
			<td><a href="' . '?id=' . $event["EVENT_ID"] . '"' . '>' . $event["EVENT_NAME"] . '</a></td>
			<td>' . $event["EVENT_LOCATION"] . '</td>
			<td>' . $event["EVENT_TIME"] . '</td>
		</tr>';
		} ?>
		</tbody>
	</table>
</div>
</body>
</html>