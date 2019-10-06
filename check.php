<?php
// This is used to check whether user is logged in or not
include('core/init.php');
if(empty($_SESSION['user_id']))
{
    header('location:index.php');
}
?>