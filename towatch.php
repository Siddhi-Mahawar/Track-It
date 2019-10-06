<?php

	include('core/init.php');
    // initialize errors variable
	$errors = "";

	$user_id=$_SESSION['user_id'];

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "mytrack");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task,user_id) VALUES ('$task','$user_id')";
			mysqli_query($db, $sql);
			header('location: towatch.php');
		}
	}	
	if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
	header('location: towatch.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Track it!</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- <script src="dist/progressbar.js"></script> -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet">
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/js/mdb.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="todostyle.css"> -->
	<link rel="stylesheet" type="text/css" href="todostyle.css">
</head>

<style>
</style>

<body style="color: #000 !important;
background-color: black ">
	<?php
	include('navbar.php');
	?>
	<div class="container">
		<h2 style="font-style: 'Hervetica'; text-align:center;color:white;padding:1%" >ToWatch List</h2>
	<form method="post" action="towatch.php">
	<?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
	<?php } ?>
	<div class="inpt">
                        <input  id="inp" type="text" name="task"  placeholder="Enter Show" >
						<br>
                   	<button type="submit" name="submit" id="add_btn" class="add_btn">Add Show</button>
                        </div>
	</form>
	<table style="background-color:white;width:100%">
	<thead>
		<tr>
			<th style="color:#a6c; font-size:20px;text-align:left;padding-left:1%">Shows</th>
			<th style="color:#a6c; font-size:20px;text-align:right;padding-right:1%">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM tasks WHERE user_id='$user_id'");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr  >
				<td class="task" style="padding-top:1%;padding-bottom:1%;font-size:120%"> <b><?php echo $row['task']; ?></b> </td>
				<td class="delete" style="color:#a6c; ;text-align:right;padding-right:3%"> 
					<a href="towatch.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
</div>
</body>
</html>
<?php
include('footer.php');
?>