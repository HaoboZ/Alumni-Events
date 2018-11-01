<?php
include_once(__DIR__ . "/../database/database_connection.php");
include_once(__DIR__ . "/../login/check.php");

if ($admin) {
	$query = oci_parse($connect, "
        SELECT * FROM events
        WHERE event_id = :event_id
    ");
	oci_bind_by_name($query, ":event_id", $_GET["id"]);
	if (!oci_execute($query)) exit;

	$event = oci_fetch_assoc($query);
	if ($event && !$event['EVENT_CODE']) {
		$code = rand(10000, 99999);

		$query = oci_parse($connect, "
	        UPDATE events
	        SET event_code = :code
	        WHERE event_id = :event_id
	    ");
		oci_bind_by_name($query, ":code", $code);
		oci_bind_by_name($query, ":event_id", $_GET["id"]);
		if (!oci_execute($query)) exit;
	}
}

header("location:../events.php?id=" . $_GET["id"]);
