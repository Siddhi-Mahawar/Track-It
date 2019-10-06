<?php

// include the file
include("core/init.php");
extract($_GET);
extract($_POST);
$user_id = $_SESSION['user_id'];

// connect to the database
$con = mysqli_connect('localhost','root','','mytrack');

// insert the comment in the database
$q = "INSERT INTO comment (episode_id,user_id,comment,comment_date) VALUES('$id1','$user_id','$comment',NOW())";
mysqli_query($con,$q);
?>