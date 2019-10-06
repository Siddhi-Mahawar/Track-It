<!-- This file is used to update the private or public status of the tv shows of the curernt user. -->

<?php

include('core/init.php');

// connect to the database.

$con = mysqli_connect('localhost','root','','mytrack');

// get the deatils and information to be updated.

$user_id = $_SESSION['user_id'];
$showid=$_REQUEST['id'];
$status = $_REQUEST['p'];

// this query is used to update the status of the tv show of the current user.

$query="UPDATE shows SET status='$status' WHERE user_id='$user_id' AND show_id='$showid'";
mysqli_query($con,$query);

// to redirect back to the previous page

echo "<script>window.location='shows.php'</script>";

?>