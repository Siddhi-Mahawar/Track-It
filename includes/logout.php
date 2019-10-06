<?php 
	include '../core/init.php';

	//check if user loggedIn 
	if(!$userObj->isLoggedIn()){
		session_destroy();
		$userObj->redirect('index.php');
	}else{
		$userObj->logout();
	}
?>