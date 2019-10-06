<?Php
session_start();
if($_POST['t1'] == $_SESSION['my_captcha']){
echo "OK";
}else {
echo "NOTOK";
}
unset($_SESSION['my_captcha']);
?>
