<!--
List of participants.

Allows admin to check off verified alumni.
-->
<?php

$query = oci_parse($connect, "
            SELECT COUNT(*) FROM event_participants
            WHERE event_id = :event_id AND verified = 1
        ");
oci_bind_by_name($query, ":event_id", $event["EVENT_ID"]);
if (!oci_execute($query)) exit;

echo "<br><br>Number of verified alumni participants: " . oci_fetch_assoc($query)["COUNT(*)"] . " (refresh to update) <br><br>";

$query = oci_parse($connect, "
            SELECT * FROM event_participants
            WHERE event_id = :event_id
        ");
oci_bind_by_name($query, ":event_id", $event["EVENT_ID"]);
if (!oci_execute($query)) exit;

$participant = oci_fetch_assoc($query);
?>

	<h4>Participants:</h4>
<?php
if (!$participant)
	echo '<p>None</p>';
else {

	echo '
	<script>
		function verification ( email ) {
			$.post(\'../singleEvents/verify.php\', { val: $("#"+email).is(\':checked\'), id: ' . $event["EVENT_ID"] . ', email }, (r) => {
				if(r !== email)
					console.log(r);
			} );
		}
	</script>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Grad Year</th>
				<th>Verified</th>
			</tr>
		</thead>';
	do {
		echo '<tr>
			<td>' . $participant["USER_FIRST_NAME"] . ' ' . $participant["USER_LAST_NAME"] . '</td>
			<td>' . $participant["USER_EMAIL"] . '</td>
			<td>' . $participant["USER_GRAD_YEAR"] . '</td>
			<td><input type="checkbox" id="' . $participant["USER_EMAIL"] . '" onclick="verification(\'' . $participant["USER_EMAIL"] . '\')" ' . ($participant["VERIFIED"] ? "checked" : "") . '/></td>
		</tr>';
	} while ($participant = oci_fetch_assoc($query));
	echo '</table>';
}
