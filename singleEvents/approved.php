<!--
Approves event given id in header.

Redirects to event page.
-->
<?php
include_once(__DIR__ . "/../database/database_connection.php");
include_once(__DIR__ . "/../login/check.php");

if ($admin) {
	$query = oci_parse($connect, "
        UPDATE events
        SET event_approved = 1
        WHERE event_id = :event_id
    ");
	oci_bind_by_name($query, ":event_id", $_GET["id"]);
	if (!oci_execute($query)) exit;
}

header("location:../events/events.php?id=" . $_GET["id"]);
