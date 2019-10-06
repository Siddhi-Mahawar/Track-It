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

	$email = $_SESSION['email'];
	if(isset($_GET['password']) || isset($_GET['verify'])){
		if(!empty($_GET['password']) || !empty($_GET['verify'])){
			$code = Validate::escape($_GET['verify']);
	    	$verify = $verifyObj->verifyResetCode($code);

	    	if($verify){
	    		if(date('Y-m-d', strtotime($verify->createdAt)) < date('Y-m-d')){
	    			$errors['verify'] = "Your password reset link has been expired";
	    		}else{
	    			$userObj->update('recovery',array('status' => '1'), array('user_id' => $verify->user_id,'code' => $code));
 	    		}
	    	}else{
	    		$errors['verify'] = "Invalid password reset link";
	    	}
		}else{
			$userObj->redirect('index.php');
		}
	}

	if(isset($_POST['reset'])){
		$password        = $_POST['rPassword'];
		$passwordAgain   = $_POST['rPasswordAgain'];
		$password = md5(md5($email).md5($password));
		$passwordAgain = md5(md5($email).md5($passwordAgain));
		if(!empty($password)){
			if($password !== $passwordAgain){
				$errors['reset'] = "Password does not match";
			
			}else{
				
				$hash = $userObj->hash($password);
				$userObj->update('users', array('password' => $hash), array('user_id' => $verify->user_id));
				$userObj->redirect('password.php?success=true');
			}
		}else{
			$errors['reset'] = "Enter your new password!";
		}
	}
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script src="./User Registration_files/jquery-1.11.2.min.js.download"></script>
     <script src="./User Registration_files/bootstrap.min.js.download"></script>
       <title>Reset Password</title>
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
                <h1>Reset your password</h1>
			<h3>Enter your new password to change!</h3>			
                </div>
                <?php if(isset($_GET['success'])):?>
				<div class="success-message"><font color="white">Your password has been changed, now you can <a href="http://localhost/Tvtracker">Login</a></font></div>
			<?php else:?>
        
            <?php if(isset($errors['verify'])):?>
					<center><div class="success-message"><?php echo $errors['verify'];?></div></center>
				<?php else:?>
		
                <div class="input-group">
			
            <input type="Password" name="rPassword"    placeholder="Password" id="pass" size="100%" >
        </div>
                <div class="input-group">
			
            <input type="password" name="rPasswordAgain" placeholder="Cofirm Password" id="cpass" size="100%" >
        </div>
			
        <div style="padding-top: 5px;">  
                <button type="submit" name="reset" onclick=hey()  class="btn " style="font-family: sans-serif;width: 100%">Reset</button>
            </div>
            </form>
            
				<?php if(isset($errors['reset'])):?>
				<div class="error shake-horizontal"><?php echo $errors['reset'];?></div>
				<?php endif;?>
			<?php endif;?>
		<?php endif;?>
      
        </div>
    </div>    
    
    
	
	

 

</body></html>