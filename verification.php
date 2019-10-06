<!-- This page is used to verify the email provided by the user to us and to verify the link -->
<?php 
	include 'core/init.php';
 	$user_id = $_SESSION['user_id'];
	$user    = $userObj->userData($user_id);
	$verifyObj->authOnly();

	if(isset($_POST['email'])){
		$link = Verify::generateLink();
    	$message = "{$user->firstName}, Your account has been created, Vist this link to verify your account : <a href='http://localhost/Tvtracker/verification/{$link}'>Verify Link</a>";
    	$subject = "Account Verification";
    	$verifyObj->sendToMail($user->email, $message, $subject);
    	$userObj->insert('verification', array('user_id' => $user_id, 'code' => $link));
    	$userObj->redirect('verification?mail=sent');
    }

    if(isset($_GET['verify'])){
    	$code = Validate::escape($_GET['verify']);
    	$verify = $verifyObj->verifyCode($code);

    	if($verify){
    		if(date('Y-m-d', strtotime($verify->createdAt)) < date('Y-m-d')){
    			$errors['verify'] = "Your verification link has been expired";
    		}else{
    			$userObj->update('verification',array('status' => '1'), array('user_id' => $user_id,'code' => $code));
    			$userObj->redirect('home.php');
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

       <div id="home" style="background: url('assets/img/background.jpg' ) no-repeat center center fixed">
        <div style="padding-top: 5pc">
          <form method="post">

                <div class="header">
				<?php 
					if(isset($_GET['verify']) || !empty($_GET['verify'])){
						if(isset($errors['verify'])){
							echo '<h4>'.$errors['verify'].'</h4>';
						}
					}else{
				?>
				<h4>Your account has been created, you need to activate your account by the following method:</h4>
				<fieldset>
				
				<?php if(isset($_GET['mail'])):?>
					<h4>An verification email has been sent to your email, check your email to verify your account</h4>
				<?php else:?>
					<h3>Email verificaiton</h3></div>
					 <div class="input-group">
			
            <input size="100%"type="email"  placeholder="<?php echo $user->email;?>" value="<?php echo $user->email;?>"/>
				</div>
				
	 				<button type="submit" name="email" class="suc btn" width="100%">Send email</button>
					</form>
			   <?php endif;?>
				</fieldset>
				</div>
 				<!-- Email error field -->
 				<?php if(isset($errors['email'])):?>
				 <span class="error-in"><b><?php echo $errors['email'];?></b></span>
			    <?php endif;?>
				
			<?php }?>
        </form>
        </div>
        
    </div>    
    
</body></html>