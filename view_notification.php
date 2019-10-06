<?php
include('core/init.php');

//connect to the database
$conn = new mysqli("localhost","root","","mytrack");
$user_id = $_SESSION['user_id'];

// get the comments of the users
$sql="select * from comment WHERE user_id='$user_id'";
$result=mysqli_query($conn, $sql);


$ar = array();

while($row=mysqli_fetch_array($result))
{
	array_push($ar,$row['comment_id']);
}

// get the replies for the comments user has added
$sql1 = "SELECT * FROM comment WHERE comment_parentid IN ('" . implode("','", $ar) . "') ORDER by comment_id DESC" ;
$result=mysqli_query($conn, $sql1);

$response='';
while($row=mysqli_fetch_array($result))
{
	$name = $row['user_id'];
	if($name == $user_id)
		continue;
	$t = $row['comment_id'];
	
	$sql2 = "SELECT * FROM users WHERE user_id='$name'";
	$res = mysqli_query($conn,$sql2);
	

	$row1 = mysqli_fetch_array($res);

	// add the data in the response
	$response = $response . "<div class='notification-item'>" .
	"<div class='notification-subject'>". $row1["username"] . " <i>Replied</i></div>" . 
	"<div class='notification-comment'>" . $row["comment"]  . "</div>" .
	"</div>";
}

if(!empty($response)) {
	print $response;
}


?>