<?php

// get the details of the session
include('core/init.php');
if(empty($_SESSION['user_id']))
{
    header('location:index.php');
}

$con = mysqli_connect('localhost','root','','mytrack');
$user_id = $_SESSION['user_id'];


//check for the social login
if(empty($_SESSION['fb_login']))
{
  $user = $userObj->userData($user_id);
  $verifyObj->authOnly();
}

?>
<head>
<title>Track it!</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    
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

</head>
<script>
   

  // This function is used to the list of the trending shows

    show_trend();





</script>


<style>

.imgcolumn {
position: relative;
  float: left;
  width: 33.33%;
  padding: 0px;
}

/* Clearfix (clear floats) */
.imgrow::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<style>

.bottom-left {
color:#fff;
font-family: 'Ubuntu' sans-serif;
  position: absolute;
  bottom: 0px;
  left: 0px;
  background-color: rgba(0, 0, 0, 0.753);
  width: 100%;
  padding: 1%;
  font-size: 120%;
  text-align: center;
}
 
.top-right{
      position: absolute;
      top:8px;
      right:8px;
      color:white;
      text-decoration: white;
}

.top-left{
      position: absolute;
      top:8px;
      left: 8px;
      color:white;
      text-decoration: white;
}
.imgcolumn{
        padding: 1px;
    }
@media(max-width: 500px) {
    .imgcolumn{
        width: 100%;
        padding: 1%;
    }
 

}

</style>
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #a6c;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
#space{
  padding-bottom:5%;
}
</style>

<!-- This page is used to get the trending shows  -->
<body style="background-color: black"  onload="myFunction()" style="margin:0;">
<?php
include('navbar.php');
?>
<div  id="loader"></div>
            <div class="container" id="myDiv" style="display:none;"  class="animate-bottom">
            <div class="imgrow">
                <?php 
                    for($i = 0;$i<18;$i++)
                    {
                        ?>
                        <div class="imgcolumn">
                        <a href="#" id="trend_link<?php echo $i?>">
                            <img  alt="Snow" id="trend<?php echo $i?>" style="width:100%">
                            <div class="bottom-left" id="trend_name<?php echo $i ?>" >Trending 1</div>
                            <!-- <div class="top-right"><a href="https://www.google.co.in"><i class="fa fa-plus" aria-hidden=""></i></a></div> -->
                            <div class="top-left" id="trend_pop<?php echo $i ?>">imdb 8/10</div>
                            </a>
                            
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>

        <script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 2500);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
  document.getElementById("foot").style.display = "block";

}
</script>

</body>
<div id="space"></div>
<div id="foot" style="display:none">
<?php
include('footer.php');
?>
</div>