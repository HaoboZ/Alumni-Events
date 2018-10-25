<?php

include_once("database/database_connection.php");
include_once('login/check_cookie.php');


$message = '';
$event = null;
if (isset($_GET['id'])) {
    $query = oci_parse($connect, "
        SELECT * FROM events
        WHERE event_id = :id
    ");
    oci_bind_by_name($query, ":id", $_GET["id"]);
    if (!oci_execute($query)) exit;

    $res = oci_fetch_assoc($query);
    if ($res) {
        $event = $res;
    } else {
        $message = "<div class='alert alert-danger'>No event that matches id</div>";
    }

    if ($valid) {
        $participating = false;
        $query = oci_parse($connect, "
            SELECT * FROM event_participants
            WHERE event_id = :event_id AND user_email = :user_email
        ");
        oci_bind_by_name($query, ":event_id", $event["EVENT_ID"]);
        oci_bind_by_name($query, ":user_email", $data["USER_EMAIL"]);
        if (!oci_execute($query)) exit;

        $res = oci_fetch_assoc($query);
        if ($res) $participating = true;

        if (isset($_POST["event"])) {
            $query = oci_parse($connect, $participating ? "
                DELETE FROM event_participants
                WHERE event_id = :id AND user_email = :user_email
            " : "
                INSERT INTO event_participants
                VALUES (:event_id, :user_email)
            ");
            oci_bind_by_name($query, ":event_id", $event["EVENT_ID"]);
            oci_bind_by_name($query, ":user_email", $data["USER_EMAIL"]);
            if (!oci_execute($query)) exit;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <?php include("content/title.php"); ?>
</head>
<body>
<br/>
<div class="container">
    <?php
    include("content/header.php");
    if ($event != null) {
        echo '<div>'
            . 'creator: ' . $event['USER_EMAIL'] . '<br/>'
            . 'date created: ' . $event['EVENT_CREATION_DATE'] . '<br/>'
            . '<br/>'
            . 'name: ' . $event['EVENT_NAME'] . '<br/>'
            . 'time: ' . $event['EVENT_TIME'] . '<br/>'
            . 'location: ' . $event['EVENT_LOCATION'] . '<br/>'
            . 'info: ' . $event['EVENT_INFO'] . '<br/>'
            . '</div>';
        if ($valid) {
            echo '<form>
            <input type="hidden" name="id" value="' . $event['EVENT_ID'] . '"/>
            <button type="submit" name="event" id="event" class="btn" >
                ' . ($participating ? 'UnParticipate' : 'Participate')
                . '</button>
        </form>';
        }
    }
    ?>
</div>
</body>
</html>
