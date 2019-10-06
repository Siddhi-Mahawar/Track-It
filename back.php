<?php
// extract the data sent to the document
extract($_GET);
extract($_POST);
include('functions.php');

// connect to the database
$con = mysqli_connect('localhost','root','','mytrack');
$a = explode(",",$name);

$b=array();

echo json_encode(is_array($a));

// send the mail to all the users who have an upcoming episode tommorrow for the shows they track
$qu2 = "SELECT DISTINCT user_id FROM shows WHERE show_id IN ('" . implode("','", $a) . "')";
$ans = mysqli_query($con,$qu2);

while($row = mysqli_fetch_array($ans))
{
    $id = $row['user_id'];
    $qu3 = "SELECT * FROM users WHERE user_id = '$id'";
    $ans1 = mysqli_query($con,$qu3);
    $q = mysqli_fetch_array($ans1);
    $email = $q['email'];
    sendToMail($email,"The Tv Shows You track on Tvtracker has some upcoming episode tommorrow!!Check it out","Upcoming episode Tommorrow");
}

?>