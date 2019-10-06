<?php

// include the file
	include('core/init.php');

	// connect to the database
	$con = mysqli_connect('localhost','root','','mytrack');

	// get the argurments send from fb
	$email = $_POST['arguments'][0];
	$name = $_POST['arguments'][1];
	$fname = $_POST['arguments'][2];
	$lname = $_POST['arguments'][3];
	$pass = md5($fname);
	
	$pass = md5(md5($email).md5($pass));

	//checking if email already exists
	$query="SELECT * FROM users WHERE email='$email'";
	$res=mysqli_query($con,$query);

	if(mysqli_num_rows($res) == 0)
	{
		//user doesnt exists
		$query="INSERT into users(username,email,firstName,lastName,joined,password) values ('$name','$email','$fname','$lname',NOW(),'$pass')";
		mysqli_query($con,$query);
	}
	
	// get the details from the users
	$query="SELECT * FROM users WHERE email='$email'";
	$res=mysqli_query($con,$query);
	$arr=mysqli_fetch_array($res);
	$uid=$arr['user_id'];
	$_SESSION['user_id']=$uid;

	// set social login
	$_SESSION['fb_login']=$uid;

?>