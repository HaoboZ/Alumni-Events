<!--
Full reporting for events.
-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script>
	$(document).ready(function (){
		let date = moment("<?php echo $event["EVENT_TIME"] ?>", "DD-MMM-YY hh.mm.ss.SSS A");
		$('#time').text(date.format("MM-DD-YYYY hh:mm A"));
	});
</script>

<h3><?php echo $event['EVENT_NAME']; ?></h3>

<p>
	Date and Time: <span id="time"><?php //echo $event['EVENT_TIME']; ?></span><br/>
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
