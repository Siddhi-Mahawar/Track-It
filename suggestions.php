<!-- This page is used to show the suggestions of the tv shows suggested by the friends -->
<?php include('functions.php');

if(empty($_SESSION['user_id']))
{
    header('location:index.php');
}
$user_id = $_SESSION['user_id'];
if(empty($_SESSION['fb_login']))
{
  $user = $userObj->userData($user_id);
  $verifyObj->authOnly();
}

// echo '<script>alert("'.$user_i.'")</script>';
?>
<!DOCTYPE html>
<html>
<title>Track it!</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
<script type="text/javascript" src="man.js"></script>

<style>
  .class-img-top{
    max-height: 300px;
  }
</style>

<body style="background-color: #000">
  <?php include('navbar.php'); ?>
        <div class="container">
            <section class="p-1">

    <div class="row" style="padding-top: 3% " id="show_data">
    <?php 
                            $shows=getfriendsuggestions();
                            
                            foreach ($shows as $show) {
                            echo $show;
                            }

                            ?>
                    
    </div>
  </section>

        </div>
</body>
<?php
  include('footer.php');
  ?>        