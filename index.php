<?php

include_once('login/check_cookie.php');
if (!$valid) {
    header("location:login/login.php");
    exit;
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
    <?php include("content/header.php"); ?>
    <button>Add Event</button>
    <?php
    if ($data["USER_TYPE"] == 'Admin') {
        echo '<button>Edit Event</button>';
    }
    ?>
</div>
</body>
</html>