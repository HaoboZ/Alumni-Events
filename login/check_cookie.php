<?php

include_once(__DIR__ . "/../database/database_connection.php");

$valid = false;
$data = array();

// checks that the cookie has a valid session id to log in
if (isset($_COOKIE["login_session"])) {
    $query = oci_parse($connect, "
			SELECT * FROM login_session
			WHERE session_key = :session_key AND timeout > CURRENT_DATE
	    ");
    oci_bind_by_name($query, ":session_key", $_COOKIE["login_session"]);
    if (!oci_execute($query)) exit;

    $res = oci_fetch_assoc($query);
    if ($res) {
        $valid = true;
        $query = oci_parse($connect, "
			SELECT * FROM user_info
			WHERE user_email = :user_email
	    ");
        oci_bind_by_name($query, ":user_email", $res["USER_EMAIL"]);
        if (!oci_execute($query)) exit;

        $data = oci_fetch_assoc($query);
        if (!$data) exit;
    }
}
