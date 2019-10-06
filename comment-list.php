<?php

// include the files
include('core/init.php');
$user_id = $_SESSION['user_id'];
$unid = $_SESSION['un_id'];

// connect to the database
$conn = mysqli_connect("localhost","root","","mytrack");

// get the comments for the particular episode of particular tv series
$sql = "SELECT * FROM comment WHERE episode_id='$unid' ORDER BY comment_parentid desc, comment_id desc";

$result = mysqli_query($conn, $sql);

// get the result in an array
$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    $q = $row['user_id'];
    $sq1 = "SELECT username FROM users WHERE user_id='$q'";
    $t=mysqli_query($conn,$sq1);
    $r = mysqli_fetch_array($t);
    $un=$r['username'];
    $a = array("episode_id"=>$row['episode_id'],"comment"=>$row['comment'],"comment_date"=>$row['comment_date'],"comment_id"=>$row['comment_id'],"comment_parentid"=>$row['comment_parentid'],"comment_sender_name"=>$un);
    array_push($record_set,$a);
}
echo json_encode($record_set);
?>