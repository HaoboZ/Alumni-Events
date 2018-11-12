<?php
if ($_SERVER["REQUEST_METHOD"] != "POST")
	exit;

include_once("../database/database_connection.php");

$query = oci_parse($connect, "
	UPDATE event_participants
	SET verified = :val
	WHERE event_id = :event_id AND user_email = :user_email
");
$val = $_POST["val"] == 'true' ? 1 : 0;
oci_bind_by_name($query, ":val", $val);
oci_bind_by_name($query, ":event_id", $_POST["id"]);
oci_bind_by_name($query, ":user_email", $_POST["email"]);
if (!oci_execute($query)) exit;

echo $_POST['email'];
