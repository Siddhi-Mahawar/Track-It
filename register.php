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
		var x=document.getElementById('cpass').value;
		var y = hashCode(x);
		document.getElementById("cpass").value =y;  
	}
	</script>
<?php 
	include 'core/init.php';

	 if($userObj->isLoggedIn()){
	 	$userObj->redirect('home.php');
	 }
	 
	if(isset($_POST['signup'])){
		 

		$required = array('firstName', 'lastName','username','email','password','passwordAgain');
		foreach($_POST as $key => $value){
			if(empty($value) && in_array($key, $required) === true){
				$errors['allFields'] = "<font color='white'>All fields are required</font>";
				break;
			}
		}

		if(empty($errors['allFields'])){
			$firstName     = Validate::escape($_POST['firstName']);
	 		$lastName      = Validate::escape($_POST['lastName']);
	 		$username      = Validate::escape($_POST['username']);
	 		$email         = Validate::escape($_POST['email']);
			$password      = $_POST['password'];
			$password = md5(md5($email).md5($password));
			$rePassword    = $_POST['passwordAgain'];
			$rePassword = md5(md5($email).md5($rePassword));
			$descr         =$_POST['descr'];
	   		if(Validate::length($firstName, 2, 20)){
	   			$errors['names'] = "<font color='white'>Names can only be between in 2 - 20 characters</font>";
	   		
	   		}else if (Validate::length($lastName, 2, 20)){
				$errors['names'] = "<font color='white'>Names can only be between in 2 - 20 characters</font>";
	   		
	   		}else if(Validate::length($username, 2, 10)){
				$errors['username'] = "<font color='white'>Username can only be between in 2 - 10 characters</font>";
	   		
	   		}else if ($userObj->usernameExist($username)){
	   			$errors['username'] = "<font color='white'>Username is already teken!</font>";
	   		
	   		}else if(!Validate::filterEmail($email)){
	   			$errors['email'] = "<font color='white'>Invalid email format</font>";
	   		
	   		}else if($userObj->emailExist($email)){
	   			$errors['email'] = "<font color='white'>Email already exists</font>";
	   		
	   		}else if($password != $rePassword){
	   			$errors['password'] = "<font color='white'>Password does not match!</font>";
	   		
	   		}else{
	   			$hash = $userObj->hash($password);
   				$user_id = $userObj->insert('users', array('firstName' => $firstName,'descr'=>$descr, 'lastName' => $lastName, 'username' => $username, 'email' => $email, 'password' => $hash));
   				$_SESSION['user_id'] = $user_id;
				$userObj->redirect('verification');
	 	   	}
		}


	    // Captcha verification start
	   if(isset($_POST['g-recaptcha-response']))
		  $captcha=$_POST['g-recaptcha-response'];
        if(!$captcha){
        //   echo '<h2>Please check the the captcha form.</h2>';
        }
        $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LczHbkUAAAAAJ01vh28757eSmz_JmWekWw_4qvr&response=".$captcha), true);
		// print_r($response);
		if($response['success'] == false)
		{
          	echo "<script>alert('Captcha verification invalid.');window.open('../Tvtracker/register.php','_self');</script>";
          	// die();
        }
		//Captcha verification end*/
		
		

		
	}
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script src="./User Registration_files/jquery-1.11.2.min.js.download"></script>
     <script src="./User Registration_files/bootstrap.min.js.download"></script>
       <title>Track it!</title>
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="./User Registration_files/bootstrap.min.css">
       <link rel="stylesheet" href="./User Registration_files/font-awesome.min.css">
       <script src="./User Registration_files/jquery.min.js.download"></script>
       <script src="./User Registration_files/bootstrap.min.js(1).download"></script>
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
    <link rel="stylesheet" href="./User Registration_files/styles.css">
<script type="text/javascript" charset="UTF-8" src="./User Registration_files/common.js.download"></script><script type="text/javascript" charset="UTF-8" src="./User Registration_files/util.js.download"></script></head>

<script src='https://www.google.com/recaptcha/api.js'></script>

<body>

       <div id="home" style="background: url('assets/img/background.jpg' ) no-repeat center center fixed">
        <div style="padding-top: 0pc">
          <form method="post">

                <div class="header">
                        <h2> Sign Up </h2>
                </div>
                <div class="input-group">
			
            <input type="text" name="firstName" placeholder="First Name" value="<?php echo ((isset($firstName)) ? Validate::escape($firstName) : '');?>" style="width:50%">
       	
            <input type="text" name="lastName" placeholder="Last Name" value="<?php echo ((isset($lastName)) ? Validate::escape($lastName) : '');?>"style="width:50%">
        </div>
        				 <!-- Name Error -->
				 <?php if(isset($errors['names'])):?>
  		  		  <span class="error-in"><?php echo $errors['names'] ?></span>
  		  		 <?php endif;?>				

        <div class="input-group">
			
            <input  type="text" name="username" size="100%" placeholder="Username" value="<?php echo ((isset($username)) ? Validate::escape($username) : '');?>">
                <!-- Username Error -->
		  		 <?php if(isset($errors['username'])):?>
  		  		  <span class="error-in"><?php echo $errors['username'] ?></span>
  		  		 <?php endif;?>
				
        </div>


        <div class="input-group">
			
                    <input type="email" name="email" size="100%" placeholder="Email" value="<?php echo ((isset($email)) ? Validate::escape($email) : '');?>">
        <!-- Email Error -->
	  		 	<?php if(isset($errors['email'])):?>
  		  		  <span class="error-in"><?php echo $errors['email'] ?></span>
  		  		 <?php endif;?>
                </div>
                <div class="input-group">
                    <input type="password" name="password" size="100%" placeholder="Password" id="pass">
        </div>
        <div class="input-group">
                    <input  type="password" name="passwordAgain" size="100%" placeholder="Confirm Password" id="cpass">
        </div>
        <!-- Password Error -->
		  		 <?php if(isset($errors['password'])):?>
  		  		  <span class="error-in"><?php echo $errors['password'] ?></span>
  		  		 <?php endif;?>
        <div class="input-group">
                    <input type="textarea" name="descr"size="100%" placeholder="Tell us something about yourself">
        </div>
       <center>
									<div class="input-group" >
									<div class="g-recaptcha" data-sitekey="6LczHbkUAAAAAASqIlHNCQpxBP7elBAVPHwHwFmQ"></div>
									</div>
                        </center>
                        <!-- All Fields error -->
  		  		 <?php if(isset($errors['allFields'])):?>
  		  		  <span class="error-in"><?php echo $errors['allFields'] ?></span>
  		  		 <?php endif;?>
        <div style="padding-top: 5px;">  
                <button value="sign-up" name="signup" onclick=hey()  class="btn " style="font-family: sans-serif;width: 100%">Sign up</button>
            </div>
            </form>
      
        </div>
    </div>    
    
    
	
	

 

</body></html>