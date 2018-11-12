<h3><?php echo $event['EVENT_NAME']; ?></h3>

<p>
	Time: <?php echo $event['EVENT_TIME']; ?><br/>
	Location: <?php echo $event['EVENT_LOCATION']; ?><br/>
	Info: <?php echo $event['EVENT_INFO']; ?><br/>
	<br/>
</p>
<?php if ($event['CREATOR_EMAIL']) { ?>
	<p>
		Creator: <?php echo $event['CREATOR_FIRST_NAME'] . ' ' . $event['CREATOR_LAST_NAME']; ?><br/>
		Date Created: <?php echo $event['CREATOR_DATE']; ?><br/>
	</p>
<?php } ?>
