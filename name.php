<?php

include('core/init.php');

// extract the data sent to the document
extract($_GET);
extract($_POST);

// connect to the database
$con = mysqli_connect('localhost','root','','mytrack');
$user_id = $_SESSION['user_id'];

// Check whether the user has already added show to his account 

$sql = "SELECT * FROM shows WHERE user_id='$user_id' AND show_id='$id'";
$res = mysqli_query($con,$sql);

if(mysqli_num_rows($res)==0)
{

    // insert the tv show in the account of user to add it in his list.
    $sql="INSERT INTO shows(user_id,show_id,status,last_update) VALUES('$user_id','$id','0',NOW())";
    mysqli_query($con,$sql);

}
?>