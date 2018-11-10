<?php
include_once(__DIR__ . "/../variables.php");
include_once(__DIR__ . "/../login/check.php");
?>

<nav class="navbar navbar-expand-sm bg-light">
	<a class="navbar-brand" href="<?php echo $home ?>">Alumni Engagement Recording System</a>
	<ul class="navbar-nav">
		<li class="nav-item active">
			<a class="nav-link" href="<?php echo $home ?>/events/events.php">Events</a>
		</li>
		<li class="nav-item active">
			<?php
			if ($admin)
				echo '<a class="nav-link" href="' . $home . '/login/logout.php">Logout</a>';
			else
				echo '<a class="nav-link" href="' . $home . '/login/login.php">Login</a>';
			?>
		</li>
	</ul>
</nav>
<br/>
