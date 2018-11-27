<?php
if ($_SERVER["REQUEST_METHOD"] != "POST")
	exit;

include_once("../database/database_connection.php");

$query = oci_parse($connect, "
	DELETE FROM events
	WHERE event_id = :event_id
");
oci_bind_by_name($query, ":event_id", $_POST["id"]);
if (!oci_execute($query)) exit;

echo false;
