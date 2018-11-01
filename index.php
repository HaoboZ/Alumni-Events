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
        echo '<button id="newEvent">Add Event</button>';
    }
    ?>
</div>

<div class="modal fade center" id="modalNewEvent" tabindex="-1" role="dialog" aria-labelledby="modalNewEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalNewEventLabel">New Event</h4>
			</div>

			<div class="modal-body">
                <div class="row">
					<div class="col-md-1"></div>
                    <div class="col-md-10">
                        <form role="form" enctype="multipart/form-data" id="NewEventFormSubmit">

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title" style="font-weight: bold">Event Info</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="name">Name of event</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name of the event" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="objective">Event Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Description" required></textarea>
                                    </div>
                                </div>

                                <div class="panel-heading">
                                    <h3 class="panel-title" style="font-weight: bold">Event Time & Location</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group input-group date" id='datetimepicker1'>
                                        <label for="date">Event Date and Time</label>
                                        <input type="text" name="date" id="date" class="form-control" required>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <script type="text/javascript">
                                        $(function () {
                                        $('#datetimepicker1').datetimepicker();
                                        });
                                    </script>
                                    <div class="form-group">
                                        <label for="location">Location of event</label>
                                        <input type="text" name="loaction" id="location" class="form-control" placeholder="Location of the event" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class='col-md-1'></div>
                </div> <!--.row-->
            </div> <!--.modal-body-->

            <div class="modal-footer">
				<button type="submit" id="addEvent" class="btn btn-success">Add Event</button>
				<button type="button" class="btn btn-default" onClick="" data-dismiss="modal">Cancel</button>
			</div>
        </div> <!--.modal-content-->
    </div> <!--.modal-dialog-->
</div> <!--#modalNuevoConvenio-->


</body>
</html>

<script>
$('#newEvent').on('click',function(){
    $('#modalNewEvent').modal();
});
</script>