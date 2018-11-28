<!--
Checks cookies for whether admin has logged in.
Saves variable admin as true if they logged in.
-->
<?php
include_once(__DIR__ . "/../database/database_connection.php");

$admin = false;

// checks that the cookie has a valid session id to log in
if (isset($_COOKIE["login_session"])) {
	$query = oci_parse($connect, "
			SELECT * FROM login_session
			WHERE session_key = :session_key AND timeout > CURRENT_DATE
	    ");
	oci_bind_by_name($query, ":session_key", $_COOKIE["login_session"]);
	if (!oci_execute($query)) exit;

	if (oci_fetch_assoc($query))
		$admin = true;
}
