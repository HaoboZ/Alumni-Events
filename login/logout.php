<?php

include('check.php');

if ($admin) {
	$query = oci_parse($connect, "
		DELETE FROM login_session
		WHERE session_key = :session_key
    ");
	oci_bind_by_name($query, ":session_key", $_COOKIE["login_session"]);
	if (!oci_execute($query)) exit;

	setcookie("login_session", null, time() - 3600, '/');
}

header("location:login.php");
