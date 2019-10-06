<!DOCTYPE html>
<!-- saved from url=(0030)http://liberals.epizy.com/?i=1 -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       <title>Track it!</title>
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="./User Registration_files/bootstrap.min.css">
       <link rel="stylesheet" href="./User Registration_files/font-awesome.min.css">
       <script src="./User Registration_files/jquery.min.js.download"></script>
       <script src="./User Registration_files/bootstrap.min.js.download"></script>
       <link rel="stylesheet" type="text/css" href="./User Registration_files/style.css">
       <link href="./User Registration_files/css" rel="stylesheet">
    <link href="./User Registration_files/css(1)" rel="stylesheet">
    <link href="./User Registration_files/css(2)" rel="stylesheet">
    <!-- CSS LIBRARY -->
    <link rel="stylesheet" type="text/css" href="./User Registration_files/font-awesome.min(1).css">
    <link rel="stylesheet" type="text/css" href="./User Registration_files/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="./User Registration_files/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="./User Registration_files/gallery.css">
    <link rel="stylesheet" type="text/css" href="./User Registration_files/vit-gallery.css">
    <link rel="shortcut icon" type="text/css" href="./User Registration_files/favicon.png">
    <link rel="stylesheet" type="text/css" href="./User Registration_files/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="./User Registration_files/bootstrap-datepicker.css">
    <!-- MAIN STYLE -->
    <!-- Font Awesome -->


    <link rel="stylesheet" href="./User Registration_files/styles.css">
<script type="text/javascript" charset="UTF-8" src="./User Registration_files/common.js.download"></script><script type="text/javascript" charset="UTF-8" src="./User Registration_files/util.js.download"></script></head>
<!-- This is the login and signup page with email verification-->
<!DOCTYPE html>
<script>
	function hashCode(str) {
    return str.split('').reduce((prevHash, currVal) =>
      (((prevHash << 5) - prevHash) + currVal.charCodeAt(0))|0, 0);
  	}
	function hey()
	{
		
		var x=document.getElementById('pass').value;
		var y = hashCode(x);
		document.getElementById("pass").value =y;  
	}
	</script>
<?php

	include 'core/init.php';
	$con = mysqli_connect('localhost','root','','mytrack');
	if(isset($_SESSION['logincust']))
	{
		$ema= $_SESSION['email'];
		$fname =$_SESSION['first_name'];
		$pass=md5($fname);
		$pass = md5(md5($email).md5($pass));
		$lname = $_SESSION['last_name'];
		$q1="SELECT * from users where email='$ema'";
		$res1=mysqli_query($con,$q1);
		if(mysqli_num_rows($res1)==0)
		{
				$q2="INSERT INTO users(username,email,firstName,lastName,password) VALUES('$fname','$ema','$fname','$lname','$pass')";
				$res2=mysqli_query($con,$q2);
		}	
		$q1="SELECT * from users where email='$ema'";
		$res1=mysqli_query($con,$q1);
		$r = mysqli_fetch_array($res1);
		$_SESSION['user_id']=$r['user_id'];
		$_SESSION['fb_login']=$r['user_id'];
	}
	// to check is user is already logged ino
	if($userObj->isLoggedIn()){
	 $userObj->redirect('home.php');
 	}

	 // to check whether password and email match to our data
	  
	if(isset($_POST['login'])){
 	$email    = Validate::escape($_POST['email']);
	 $password = Validate::escape($_POST['password']);
	 $password = md5(md5($email).md5($password));
 	if(empty($email) or empty($password)){
 		$error = "Enter your email and password to login!";
 	}else {
 		if(!Validate::filterEmail($email)){
 			$error = "Invaild email";
 		}else{
 			if($user = $userObj->emailExist($email)){
 				$hash = $user->password;
 				if(password_verify($password, $hash)){
					 //login
					$_SESSION['user_id'] = $user->user_id;
 					$userObj->redirect('home.php');
 				}else{
 					$error = "Email or Password is incorrect!";
 				}
			}
  			else{
 				$error = "No account with that email exists";
 			}
 		}
 	}
 }
?>

<!-- to display the login and signup form  -->
<html>
<head>
	<title>Tv Tracker</title>
	<link rel="stylesheet" href="assets/css/style.css"/>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<style>
	#space{
		padding-top:2%;
	}
	
	</style>
</head>
<body>
 
	   <div id="home" style="background: url('assets/img/background.jpg' ) no-repeat center center fixed">
        <div style="padding-top: 5pc">
	<form method="post">

                <div class="header">
                        <h2> Login to track your TV shows!</h2>
                </div>
		<div class="input-group">
			
                        <input type="email" name="email" id="email" size="100%" autocomplete="off" placeholder="Email">
		</div>
		<div class="input-group">
			
                        <input type="password" name="password" id="pass" size="100%" placeholder="Password">
        </div>
            <div style="padding-top: 5px;">
              
                    <button type="submit" name="login" class="btn " style="font-family: sans-serif;width: 49%" onclick=hey()>Login</button>
               
                <button2 type="submit" name="signup" class="btn center" style="font-family: sans-serif ; width: 49%"  onclick="location.href='register.php';" >SignUp</button2>
                
				
            </div>
            <div class="input-group" style="text-align: right">
                
				<?php if(isset($error)):?>
				   <div class="error shake-horizontal"><?php echo $error;?></div>
				<?php endif;?>
                <p><a href="recover.php">Forgot password?</a></p>               
            </div>
        
			
			<a class="btn" onclick="location.href='fb.php';" type="submit">FB LOGIN</a>
		
			 	
		<?php
			include_once 'loginG.php';
			if(isset($_GET['code'])){
				$gClient->authenticate($_GET['code']);
				$_SESSION['token'] = $gClient->getAccessToken();
				header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
			}
			if (isset($_SESSION['token'])) {
				$gClient->setAccessToken($_SESSION['token']);
			}
			if ($gClient->getAccessToken()) 
			{
				$gpUserProfile = $google_oauthV2->userinfo->get();
				$_SESSION['oauth_provider'] = 'Google'; 
				$_SESSION['oauth_uid'] = $gpUserProfile['id']; 
				$_SESSION['first_name'] = $gpUserProfile['given_name']; 
				$_SESSION['last_name'] = $gpUserProfile['family_name']; 
				$_SESSION['email'] = $gpUserProfile['email'];
				$_SESSION['logincust']='yes';
				$_SESSION['fb_login'] ='yes';
			} else {
				$authUrl = $gClient->createAuthUrl();
				$output= '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'">	<div class="btn-div1 btn" width="47%">G+ LOGIN</div></a>';
			}
			// if(empty($_SESSION['logincust']))
				echo $output;
			?>

        </form>
        
    </div>    
    
    
</body>
</html>