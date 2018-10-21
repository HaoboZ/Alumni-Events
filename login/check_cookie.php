<?php

include_once(__DIR__ . "/../database/database_connection.php");

$valid = false;
$user_email = 'wrong 0';

// checks that the cookie has a valid session id to log in
if (isset($_COOKIE["login_session"])) {
	$query = oci_parse($connect, "
			SELECT * FROM login_session 
			WHERE session_key = :session_key AND timeout > CURRENT_DATE
	    ");
	oci_bind_by_name($query, ":session_key", $_COOKIE["login_session"]);
	$user_email = 'wrong 1';
	if (!oci_execute($query)) exit;

	$user_email = 'wrong 2';

	$res = oci_fetch_assoc($query);
	if ($res) {
		$valid = true;
		$user_email = $res['USER_EMAIL'];
	}
}
