<?php

include('core/init.php');

// extract the data sent to the document
extract($_GET);
extract($_POST);

// connect to the database
$con = mysqli_connect('localhost','root','','mytrack');
$user_id = $_SESSION['user_id'];

// Check whether the user has already added show to his account 
$sql = "SELECT * FROM tv WHERE show_name='$name' AND show_id='$id'";
$res = mysqli_query($con,$sql);


if(mysqli_num_rows($res)==0)
{

    if($name)
    {
    // insert the tv show in the account of user to add it in his list.
    $sql="INSERT INTO tv(show_name,show_id,show_genre,show_url) VALUES('$name','$id','$genre','$s')";
    // echo json_encode($sql);
    mysqli_query($con,$sql);
    }

}
?>