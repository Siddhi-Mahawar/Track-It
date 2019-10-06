<?php

// connect to the database
$con = mysqli_connect("localhost","root","","mytrack") ;

// get the teails of the calendar event
$id = $_POST['id'];

$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

// update in the database
$sqlUpdate = "UPDATE tbl_events SET title='" . $title . "',start='" . $start . "',end='" . $end . "' WHERE id=" . $id;
mysqli_query($con, $sqlUpdate)
mysqli_close($con);

?>