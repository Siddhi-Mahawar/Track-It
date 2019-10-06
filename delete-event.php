<?php

// connect to the database

$con = mysqli_connect("localhost","root","","mytrack") ;

// get id of the calendar event
$id = $_POST['id'];

// delete the event
$sqlDelete = "DELETE from tbl_events WHERE id=".$id;

mysqli_query($con, $sqlDelete);

mysqli_close($con);
?>