<!-- This page is used to display the friend requests sent to the suer by the other users -->

<html>
<?php
error_reporting( E_WARNING | E_PARSE);

include('functions.php');
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
//connect to the database
$con = mysqli_connect('localhost','root','','mytrack');

?>

<head>
<title>Track it!</title>

  <!--Responsive Meta Tag-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <!--Import materialize.css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  
  <!--Import jQuery Library-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  
  <!--Import materialize.js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

  <!--Include man.js-->
  <script type="text/javascript" src="man.js"></script>

  <style type="text/css">.Pad_top{ padding-top:25px;}</style>

</head>

<body style="background-color:black;">

<!-- include navbar-->
<?php include 'navbar.php' ?>

  <div class="container">
       
       <!-- to display the friend requests -->
      <ul class="collection" id="friends">
      <?php 

      // getfriendrequests() function is used to the result fo the friend requests
        $friends=getfriendrequests($user_id);
        
        // to display the data got from the getfriendrequests() function.
        foreach ($friends as $friend) {
          echo $friend;
        }

      ?>
      </ul>
    </div>
    

</body>
</html>
<?php
  include('footer.php');
  ?>