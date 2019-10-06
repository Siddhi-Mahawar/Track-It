<!-- This file is used to mark the episode of particular tv show which the user has seen -->

<?php

include('core/init.php');

// extract the data
extract($_SESSION);
extract($_GET);
extract($_POST);

echo '<script>alert("hey");</script>';

// get all the data sent to the document
$show_id=$_GET['id'];

$sid="S".$_GET['sno'];
$epid=$sid."E".$_GET['epino'];

$userid = $_SESSION['user_id'];

$co = $_GET['i'];
// connect to the database
$con = mysqli_connect('localhost','root','','mytrack');


if($co == 0)
{
// get the data from the tv show table
    $q = "SELECT * FROM tv_shows WHERE user_id='$userid' AND show_id='$show_id' AND episodes='$epid'";
    $res = mysqli_query($con,$q);


    $data = "";

    // to get the episodes seen till now

    if(mysqli_num_rows($res)==0)
    {
        // update the epiosdes which user has watch of particular tv show 
        $q = "INSERT INTO tv_shows(user_id,show_id,episodes) VALUES('$userid','$show_id','$epid')";
        mysqli_query($con,$q);
        $q = "UPDATE shows SET last_update=NOW() WHERE show_id='$show_id' AND user_id='$userid'";
        mysqli_query($con,$q);  
    }
}
else
{
    $q = "SELECT * FROM tv_shows WHERE user_id='$userid' AND show_id='$show_id' AND episodes='$epid'";
    $res = mysqli_query($con,$q);

        // update the epiosdes which user has watch of particular tv show 
        $q = "DELETE FROM tv_shows WHERE user_id='$userid' AND show_id='$show_id' AND episodes='$epid'" ;
        mysqli_query($con,$q);

}

// $coun+=1;
// $ans = $data."S".$sid;
// $b = $ans."E".$epid;
// $c = $b.":";



// redirect back to the show page
echo "<script>window.location='show.php?t=$show_id'</script>";
 ?>