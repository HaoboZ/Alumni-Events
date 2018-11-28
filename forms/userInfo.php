<!--
Add into to a form that will add alumni information.

Graduation dates go from 1950 to current year.
-->
<div class="panel-heading">
	<h3 class="panel-title" style="font-weight: bold">Your info</h3>
</div>
<div class="panel-body">
	<div class="form-group">
		<label for="user_email">User Email</label>
		<input type="text" name="user_email" id="user_email" class="form-control" required/>
	</div>
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" name="first_name" id="first_name" class="form-control" required/>
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" name="last_name" id="last_name" class="form-control" required/>
	</div>
	<div class="form-group">
		<label for="grad_year">Graduation Year</label>
		<select name="grad_year" id="grad_year" required>
			<option value="">Select Year</option>
			<?php
			for ($i = 1950; $i <= date('Y'); $i++) {
				echo '<option value=' . $i . '>' . $i . '</option>';
			}
			?>
		</select>
	</div>
</div>