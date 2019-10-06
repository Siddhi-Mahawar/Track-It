<?php

// This page is used for the ajax call and main functionality is to add the comment into the database

include('core/init.php');
$user_id = $_SESSION['user_id'];
$unid = $_SESSION['un_id'];

// connect to the database
$conn = mysqli_connect('localhost','root','','mytrack');

// get the details of the comment
$commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$date = date('Y-m-d H:i:s');

// insert into the comments table
$sql = "INSERT INTO comment(comment_parentid,comment,user_id,comment_date,episode_id) VALUES ('$commentId','$comment','$user_id',NOW(),'$unid')";
$result = mysqli_query($conn, $sql);

if (! $result) {
    $result = mysqli_error($conn);
}
echo $result;
?>
