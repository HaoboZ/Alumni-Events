<?php
include_once("../database/database_connection.php");
include_once('../login/check.php');

if (isset($_GET['id'])) {
	include_once("../singleEvents/singleEvent.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("../content/title.php"); ?>
	<script src="filter.js"></script>
</head>
<body>
<br/>
<div class="container">
	<?php include("../content/header.php"); ?>
	<?php

	$query = oci_parse($connect, "
			SELECT * FROM events
			");
	$message = '';
	if (!oci_execute($query)) $message = 'sql error';
	echo $message;
	echo '<ul>';
	while ($event = oci_fetch_assoc($query)) {
		echo '<a href="' . '?id=' . $event["EVENT_ID"] . '"' . '>' . $event["EVENT_NAME"] . '</a><br>';
	}
	echo '</ul>';
	?>
	<form action="#" method="get">
		<div class="input-group">
			<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
			<input class="form-control" id="system-search" name="q" placeholder="Search for" required>
			<span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
		</div>
	</form>
	<table class="table table-list-search">
		<thead>
		<tr>
			<th>Entry</th>
			<th>Entry</th>
			<th>Entry</th>
			<th>Entry</th>
			<th>Entry</th>
			<th>Entry</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Sample</td>
			<td>Filter</td>
			<td>12-11-2011 11:11</td>
			<td>OK</td>
			<td>123</td>
			<td>Do some other</td>
		</tr>
		<tr>
			<td>Try</td>
			<td>It</td>
			<td>11-20-2013 08:56</td>
			<td>It</td>
			<td>Works</td>
			<td>Do some FILTERME</td>
		</tr>
		<tr>
			<td>§</td>
			<td>$</td>
			<td>%</td>
			<td>&</td>
			<td>/</td>
			<td>!</td>
		</tr>
		</tbody>
	</table>
</div>
</body>
</html>