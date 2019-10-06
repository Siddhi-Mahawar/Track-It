<?php 
	include 'core/init.php';

	if(isset($_POST['recover'])){
		$email  = Validate::escape($_POST['email']);
		$_SESSION['email']  = $email;

		if(!empty($email)){
			if(!Validate::filterEmail($email)){
				$errors['reset'] = "Invalid email format!";
			}else {
				if($user = $userObj->emailExist($email)){
					$link = $verifyObj->generateLink();
					$message  = "{$user->firstName}, Someone requested for new password, if you didn't requested new password then leave this email, however if you did then here's your reset link <a href='http://localhost/Tvtracker/account/recover/{$link}'>Reset Password</a>";
					$subject = "Reset Password";
					$verifyObj->sendToMail($user->email, $message, $subject);
			    	$userObj->insert('recovery', array('user_id' => $user->user_id, 'code' => $link));
			    	$userObj->redirect('account/recover/?mail=sent');
				}else{
					$errors['reset'] = "Email doesn't exists";
				}
			}

		}else{
			$errors['reset'] = "Enter your email to reset your password";
		}
	}

	if(isset($_GET['verify'])){
    	$code = Validate::escape($_GET['verify']);
    	$verify = $verifyObj->verifyResetCode($code);
 
     	if($verify){
    		if(date('Y-m-d', strtotime($verify->createdAt)) < date('Y-m-d')){
    			$errors['verify'] = "Your verification link has been expired";
    		}else{
     			$userObj->redirect('password.php?password=true&verify='.$verify->code);
    		}
    	}else{
    		$errors['verify'] = "Invalid verification link";
    	}
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



<body>

  <div id="home" style="background: url('assets/img/background.jpg' ) no-repeat center center fixed"	>
        <div style="padding-top: 5pc">
          <form method="post">

                <div class="header">
                        <h2> Reset Password </h2>
                </div>
		
		<?php if(isset($errors['verify'])):?>
			<center><div class="success-message"><?php echo $errors['verify'];?></div></center>
		<?php else:?>	
		<?php 
			if(isset($_GET['mail']) || !empty($_GET['mail'])){
				echo '<div class="success-message">An email has been sent to your email adress with reset password link</div>';
			}else {
		?>
			<div class="input-group">
			
            <input type="email" name="email" placeholder="Email" size="100%" required="">
        </div>
        <div style="padding-top: 5px;">  
                <button type="submit" name="recover"  class="btn" style="font-family: sans-serif;width: 100%">Send Link</button>
            </div>
			<?php } if(isset($errors['reset'])):?>
			<div class="sign-in-error">
				<?php echo $errors['reset'];?>
			</div>
		    <?php endif;?>
		<?php endif;?>
		</div>
		</div><!--CONTENT WRAPPER ENDS-->
		
	</div><!--WRAPPER ENDS-->
</body>
</html>
