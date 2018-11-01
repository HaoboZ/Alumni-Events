<?php
$message2 = '';

if (isset($_POST["checkin"])) {
	if (empty($_POST["user_email"]) || empty($_POST["first_name"]) || empty($_POST["last_name"]) || empty($_POST["grad_year"]) || empty($_POST["event_code"])) {
		$message2 = "<div class='alert alert-danger'>All Fields Are Required</div>";
	} else {
		$query = oci_parse($connect, "
			SELECT * FROM events
			WHERE event_id = :event_id AND event_code = :event_code
	    ");
		oci_bind_by_name($query, ":event_id", $_GET["id"]);
		oci_bind_by_name($query, ":event_code", $_POST["event_code"]);
		if (!oci_execute($query)) exit;

		if (oci_fetch_assoc($query)) {
			$query = oci_parse($connect, "
			SELECT * FROM event_participants
			WHERE event_id = :event_id AND user_email = :user_email
	    ");
			oci_bind_by_name($query, ":event_id", $_GET["id"]);
			oci_bind_by_name($query, ":user_email", $_POST["user_email"]);
			if (!oci_execute($query)) exit;

			$res = oci_fetch_assoc($query);

			if ($res) {
				$message2 = "<div class='alert alert-danger'>Email Address Already Registered</div>";
			} else {
				$query = oci_parse($connect, "
				INSERT INTO event_participants
				VALUES (:event_id, :user_email, :first_name, :last_name, :grad_year)
		    ");
				oci_bind_by_name($query, ":event_id", $_GET["id"]);
				oci_bind_by_name($query, ":user_email", $_POST["user_email"]);
				oci_bind_by_name($query, ":first_name", $_POST["first_name"]);
				oci_bind_by_name($query, ":last_name", $_POST["last_name"]);
				$grad_year = intval($_POST["grad_year"]);

				oci_bind_by_name($query, ":grad_year",$grad_year );
				if (!oci_execute($query)) exit;

				$message2 = "<div class='alert alert-success'>You have been checked in</div>";
			}
		} else {
			$message2 = "<div class='alert alert-danger'>Wrong Event Code</div>";
		}
	}
}
?>

<span><?php echo $message2; ?></span>
<form method="post">
	<div class="form-group">
		<label for="user_email">User Email</label>
		<input type="text" name="user_email" id="user_email" class="form-control"/>
	</div>
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" name="first_name" id="first_name" class="form-control"/>
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" name="last_name" id="last_name" class="form-control"/>
	</div>
	<div class="form-group">
		<label for="grad_year">Graduation Year</label>
		<select name="grad_year" id="grad_year">
			<option value="">Select Year</option>
			<?php
			for ($i = 1950; $i < date('Y'); $i++) {
				echo '<option value=\"' . $i . '\">' . $i . '</option>';
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="event_code">Event Code</label>
		<input type="text" name="event_code" id="event_code" class="form-control"/>
	</div>
	<div class="form-group">
		<input type="submit" name="checkin" class="btn btn-info" value="Check In"/>
	</div>
</form>
