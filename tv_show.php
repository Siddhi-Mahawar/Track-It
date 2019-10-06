<?php

  //include the check whether user is logged in or not 
    include('check.php');

    // connect to the database
    $con = mysqli_connect('localhost','root','','mytrack');
    extract($_SESSION);
    extract($_GET);
    extract($_POST);

    $userid = $_SESSION['user_id'];
    
    //Check for social login

    if(empty($_SESSION['fb_login']))
  {
    $user = $userObj->userData($user_id);
    $verifyObj->authOnly();
  }
    $t = $_GET['t'];

    // get the show details 
    $qu = "SELECT * FROM tv WHERE show_id = '$t'";
    $res = mysqli_query($con,$qu);
    $row = mysqli_fetch_array($res);
    $r1 = $row['show_name'];

    // check whether user has added show in the account or not
    $qu1 = "SELECT * FROM shows WHERE show_id = '$t' AND user_id='$userid'";
    $res2 = mysqli_query($con,$qu1);
    $check = 1;
    if(mysqli_num_rows($res2)==0)
      $check = 0;

      $a = array();
    if($check == 1)
    {
      // get the marked episodes for this show
      $q = "SELECT * FROM tv_shows WHERE show_id='$t' AND user_id='$userid'";
      $res = mysqli_query($con,$q);

      if(mysqli_num_rows($res)>0)
      {
        while($row1 = mysqli_fetch_array($res))
        {
            $e = $row1['episodes'];
            array_push($a,$e);  
        }
      }
    }
    
?>
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
@import url(https://fonts.googleapis.com/css?family=Lato:400,300,700);
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
*, *:before, *:after {
  box-sizing: border-box;
}
body {
  background: #43423E;
}
.movie-card{
  height: 100%;
  width: 100%;
}
a {
  text-decoration: none;
  color: #5C7FB8;
}
a:hover {
  text-decoration: underline;
}
.movie-card {
  font: 14px/22px "Lato", Arial, sans-serif;
  /* color: #A9A8A3; */
  padding: 20px 0;
}

.column1 {
  padding-left: 1%;
  padding-top: 10%;
  width: 25%;
  float: left;
  text-align: center;
}
.container {
  margin: 0 auto;
  width: 100%;
  height: 100%;
  /* background: #F0F0ED; */
  border-radius: 5px;
  position: relative;
  padding: 0;
}
.hero {
  height: 342px;
  margin: 0;
  position: relative;
  overflow: hidden;
  z-index: 1;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  background-repeat: no-repeat;
}
.hero:before {
  content: '';
  background-repeat: no-repeat;
  width: 200%;
  height: 100%;
  position: absolute;
  overflow: hidden;
  top: 0;
  left: 0;
  z-index: -1;
  background-size: 100%;
  transform: skewY(-2.2deg);
  transform-origin: 0 0;
  /* -webkit-backface-visibility: hidden; */
}
.cover {
  position: absolute;
  top: 160px;
  left: 40px;
  z-index: 2;
}
@media (min-width: 500px) {
  .details {
  padding: 190px 0 0 280px;
}
.details .title1 {
  color: black;
  font-size: 300%;
  margin-bottom: 13px;
  position: relative;
}
.details .title1 span {
  position: absolute;
  top: 3px;
  margin-left: 12px;
  background: #C4AF3D;
  border-radius: 5px;
  color: #544C21;
  font-size: 14px;
  padding: 0px 4px;
}
.details .title2 {
  color: #C7C1BA;
  font-size: 23px;
  font-weight: 300;
  margin-bottom: 15px;
}
.details .likes {
  color:black;
  margin-left: 24px;
}
.details .likes:before {
  content: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/icon_like.png");
  position: relative;
  top: 2px;
  padding-right: 7px;
}


}

@media (max-width: 500px)
{
  .details {
  padding: 10% 0 0 10%;
}
.details .title1 {
  color: black;
  font-size: 300%;
  margin-bottom: 13px;
  position: relative;
}
.details .title1 span {
  position: absolute;
  top: 3px;
  margin-left: 12px;
  background: #C4AF3D;
  border-radius: 5px;
  color: #544C21;
  font-size: 14px;
  padding: 0px 4px;
}
.details .title2 {
  color: #C7C1BA;
  font-size: 23px;
  font-weight: 300;
  margin-bottom: 15px;
}
.details .likes {
  margin-left: 24px;
}
.details .likes:before {
  content: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/icon_like.png");
  position: relative;
  top: 2px;
  padding-right: 7px;
}
.cover {
  position: absolute;
  top: 100px;
  left: 25%;
  z-index: 2;
}
.column1 {
  padding-left: 10%;
  padding-top: 16%;
  width: 100%;
  float: left;
  text-align: center;
}

}
.description {
  bottom: 0px;
  font-size: 16px;
  line-height: 26px;
  color: #ffffff;
}
.tag {
  /* background: white; */
  border-radius: 10px;
  padding: 3px 8px;
  font-size: 14px;
  margin-right: 4px;
  line-height: 35px;
  cursor: pointer;
  background: #ddd;
}

.column2 {
  padding-left: 10%;
  padding-top: 30px;
  margin-left: 20px;
  width: 70%;
  float: left;
}
@media (max-width: 500px)
{
  .column2{
    padding-left: 10%;
  padding-top: 30px;
  margin-left: 20px;
  width: 80%;
  /* float: left; */
  font-size: 8px;

  }  
}

.avatars {
  margin-top: 23px;
}
.avatars img {
  cursor: pointer;
}
.avatars img:hover {
  opacity: 0.6;
}
.avatars a:hover {
  text-decoration: none;
}
fieldset, label {
  margin: 0;
  padding: 0;
}
/****** Style Star Rating Widget *****/
.rating {
  border: none;
  float: left;
}
.rating > input {
  display: none;
}
.rating > label:before {
  margin: 5px;
  margin-top: 0;
  font-size: 1em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}
.rating > .half:before {
  content: "\f089";
  position: absolute;
}
.rating > label {
  color: #ddd;
  float: right;
}
a[data-tooltip] {
  position: relative;
}
a[data-tooltip]::before, a[data-tooltip]::after {
  position: absolute;
  display: none;
  opacity: 0.85;
}
</style>
<script>
    var id1 = <?php echo json_encode($t); ?>;
    var nam1 = <?php echo json_encode($r1);?>;
    var check = <?php echo json_encode($check);?>;

    var arr = <?php echo json_encode($a);?>;

    // this function is used to get the details of the TV show  
    show_details(nam1,id1,check,arr);
    
    </script>
<body style="background-color: black;">
<!--/.Navbar -->
<?php include('navbar.php'); ?>

<div class="movie-card">
  
  <div class="container">
    <center>
   <img  alt="cover" class="cover"  style="width:15%;" id="tv_cover"/>
  </center>
    <div class="hero" id = "tv_back">
            
      <div class="details">
      
        <div class="title1"><?php echo $row['show_name']; ?>
        <?php
    if($check == 0)
    {
      ?>
  <a><i class="fa fa-plus-circle" class="btn btn-primary waves-effect waves-light" onclick="addresult('<?php echo $t?>')" aria-hidden="true"></i></a>

      <?php
    }
    else
    {
      ?>
      <!-- <button type="button" class="btn btn-primary waves-effect waves-light" onclick="removeresult('<?php echo $t?>')">Remove</button> -->
      <a><i class="fa icon-remove-circle" class="btn btn-primary waves-effect waves-light" onclick="removeresult('<?php echo $t?>')" aria-hidden="true"></i></a>

      <?php
    }
    ?>
        </div>
                
        <span class="likes" id="likes">109 likes</span>
        
      </div> <!-- end details -->
      
    </div> <!-- end hero -->
    
    <div class="description">
      <center>
      <div class="column1" style="color:black">
          <?php
            $ge = $row['show_genre'];
            $ga = explode(",",$ge);
            for($i=0;$i<count($ga);$i++)
            {
            ?>
        <span class="tag"><?php echo $ga[$i]?></span>
        <?php
            }
            
        ?>
      </div> <!-- end column1 -->
      </center>
      <div class="column2">
        
        <p id="over"></p>
        
      </div> <!-- end column2 -->
    </div> <!-- end description -->

    
   
  </div> <!-- end container -->

<br>
  <center>
      <div class="container">
        <section>

            <!--Accordion wrapper-->
            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true" >
    
    
            </div>
            <!-- Accordion wrapper -->
    
          </section>
    </div>
    </center>
</div> <!-- end movie-card -->

</body>
<?php
  include('footer.php');
  ?>