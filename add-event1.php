<?php
include('core/init.php');
$user_id = $_SESSION['user_id'];
$con = mysqli_connect('localhost','root','','mytrack');

// get the upcoming events from the table

extract($_GET);
extract($_POST);
$q = "SELECT * FROM tbl_events WHERE title='$title' AND start='$start' AND end='$end' AND user_id='$user_id'";
$res = mysqli_query($con,$q);

if(mysqli_num_rows($res)==0)
{
    $sqlInsert = "INSERT INTO tbl_events (user_id,title,start,end) VALUES ('$user_id','$title','$start','$end')";
    // echo json_encode($sqlInsert);
    $result = mysqli_query($con, $sqlInsert);

    if (! $result) {
        $result = mysqli_error($con);
    }
}
?>