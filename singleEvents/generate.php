<!--
Generates a code for events that are active.

Will redirect to event page.
-->
<?php
include_once(__DIR__ . "/../database/database_connection.php");
include_once(__DIR__ . "/../login/check.php");

if ($admin) {
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

header("location:../events/events.php?id=" . $_GET["id"]);
