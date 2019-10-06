<?php

// add events to the calendar basically events to the calendar

include('core/init.php');
$user_id = $_SESSION['user_id'];
$con = mysqli_connect('localhost','root','','mytrack');

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";

$sqlInsert = "INSERT INTO tbl_events (user_id,title,start,end) VALUES ('".$user_id."','".$title."','".$start."','".$end ."')";

$result = mysqli_query($con, $sqlInsert);

if (! $result) {
    $result = mysqli_error($con);
}
?>