<!-- This is to get the comments made to the particular episode of a Tv show-->
<?php

include("core/init.php");

extract($_GET);
extract($_POST);

$user_id = $_SESSION['user_id'];

// connect to the database.
$con = mysqli_connect('localhost','root','','mytrack');

// this query is used to get all the comments of particular episode of tv show
$result = mysqli_query($con,"SELECT * FROM comment WHERE episode_id='$id1' ORDER BY comment_date DESC LIMIT 5");

// check whether comment has been made or not.

if(mysqli_num_rows($result)>0)
{

	// access all the comments.

	while($row=mysqli_fetch_object($result))
	{

		// access user id
		$id = $row->user_id;

		// to get the details of user who posted the specific comment.
		$q = "SELECT * FROM users WHERE user_id='$id'";
		$res = mysqli_query($con,$q);
		$resu = mysqli_fetch_array($res);

		?>

		<!-- To display the comment along with details of the user who posted it. -->
		<div class="col-md-3"><?php echo $resu['username'];?></div>
		<div class="col-md-3"><?php echo $resu['email'];?></div>
		
		<div class="col-md-7"><i><?php echo $row->comment;?></i></div>
		<div class="clearfix"></div>
		<p>&nbsp;</p>
		<?php
	}
}
?>