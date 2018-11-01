<?php
include_once(__DIR__ . "/../database/database_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$participating = false;
	$query = oci_parse($connect, "
    SELECT * FROM event_participants
    WHERE event_id = :event_id AND user_email = :user_email
");
	oci_bind_by_name($query, ":event_id", $_POST["event_id"]);
	oci_bind_by_name($query, ":user_email", $_POST["user_email"]);
	if (!oci_execute($query)) exit;

	$res = oci_fetch_assoc($query);
	if ($res) $participating = true;

	$query = oci_parse($connect, $participating ? "
    DELETE FROM event_participants
    WHERE event_id = :event_id AND user_email = :user_email
" : "
    INSERT INTO event_participants
    VALUES (:event_id, :user_email)
");
	oci_bind_by_name($query, ":event_id", $_POST["event_id"]);
	oci_bind_by_name($query, ":user_email", $_POST["user_email"]);
	if (!oci_execute($query)) exit;

	echo false;
}
