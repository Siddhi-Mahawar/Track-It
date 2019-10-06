<?php

// include the files
include "core/init.php";

$userid = $_SESSION['user_id'];
$postid = $_POST['postid'];
$rating = $_POST['rating'];

// connect to the database
$con = mysqli_connect('localhost','root','','mytrack');

// get the rating of the episodes of the tv show
$query = "SELECT COUNT(*) AS cntpost FROM rating WHERE episode_id='$postid' AND user_id='$userid'";

$result = mysqli_query($con,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];

// update the rating of the episode
if($count == 0){

    $insertquery = "INSERT INTO rating(episode_id,user_id,rating) values('$postid','$userid','$rating')";
    mysqli_query($con,$insertquery);
}else {
    $updatequery = "UPDATE rating SET rating='$rating'  where user_id='$userid' AND episode_id='$postid'";
    mysqli_query($con,$updatequery);
}


// get average
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM rating WHERE episode_id='$postid'";
$result = mysqli_query($con,$query);
$fetchAverage = mysqli_fetch_array($result);
$averageRating = $fetchAverage['averageRating'];
$return_arr = array("averageRating"=>$averageRating);

echo json_encode($return_arr);

?>