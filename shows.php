<?php

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
extract($_GET);
extract($_POST);
$con = mysqli_connect('localhost','root','','mytrack');
$user_id = $_SESSION['user_id'];
$query="SELECT * FROM shows where user_id='$user_id' ";
$result = mysqli_query($con,$query);

$show_id = array();
$show_name = array();
$show_url = array();
$show_epi = array();
$show_genre = array();

$show_id1 = array();
$show_status=array();

while($row = mysqli_fetch_array($result))
{
  
  $v = $row['show_id'];
  $qu1 = "SELECT count(*) FROM tv_shows WHERE show_id='$v' AND user_id='$user_id'";
  $a = mysqli_query($con,$qu1);
  if(mysqli_num_rows($a)==0)
  {
    array_push($show_id1,$v);
  }
  else
  {
    $r = mysqli_fetch_array($a);
    $t = $r['count(*)'];
    if($t == 0)
    {
      array_push($show_id1,$v);
    }
    else
    {
      $qu2 = "SELECT * FROM tv WHERE show_id='$v'";
      $res3 = mysqli_query($con,$qu2);
      $r4 = mysqli_fetch_array($res3);
    array_push($show_id,$v);
    array_push($show_name,$r4['show_name']);
    array_push($show_url,$r4['show_url']);
    array_push($show_epi,$t);
    array_push($show_genre,$r4['show_genre']); 
    
    array_push($show_status,$row['status']); 
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
  .class-img-top{
    max-height: 300px;
  }
</style>

<script>
  var show_id = <?php echo json_encode($show_id); ?>;
        var show_name1 = <?php echo json_encode($show_name); ?>;
        var show_url = <?php echo json_encode($show_url); ?>;
        
        var show_epi = <?php echo json_encode($show_epi); ?>;
        var show_genre = <?php echo json_encode($show_genre); ?>;
        var show_st = <?php echo json_encode($show_status); ?>;
        if(show_name1.length>0)
            getnum1(show_id,show_name1,show_epi,0,show_name1.length,show_genre,show_url,show_st);

</script>
<body style="background-color: #000">
  <?php include('navbar.php'); ?>
        <div class="container">
            <section class="p-1">

    <div class="row" style="padding-top: 3% " id="show_data">
    <?php
    $r1 = count($show_id1);
    for($i = 0;$i<$r1;$i++)
    {
        $qu2 = "SELECT * FROM shows WHERE show_id='$show_id1[$i]'";
        $c = mysqli_query($con,$qu2);
        $res2 = mysqli_fetch_array($c);
        $u = $res2['show_id'];
        $qu3 = "SELECT * FROM tv WHERE show_id='$u'";
        $res3 = mysqli_query($con,$qu3);
        $r3 = mysqli_fetch_array($res3);
    ?>
    <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card card-cascade wider mb-4">
                      <div class="view view-cascade">
                        <img src=<?php echo $r3['show_url'] ?> style="max-height:200px" class="card-img-top" alt="Example photo">
                        <a href="tv_show.php?t=<?php echo $u?>">
                        <div class="mask rgba-white-slight waves-effect waves-light"></div>
                        </a>
                        </div>
                        <div class="card-body card-body-cascade text-center">
                        <h4 class="card-title"><strong><?php echo $r3['show_name'];?>
                          <?php
                              if($res2['status'] == 1)
                              {
                                echo "<a class='icons-sm fb-ic' style='padding:2%' onclick=public('$u') id='$u'><i class='fa fa-lock' aria-hidden='true'></i></a>";

                              }
                              else
                              {
                                echo "<a class='icons-sm fb-ic' style='padding:2%' onclick=private('$u') id='$u'><i class='fa fa-lock-open' aria-hidden='true'></i></a>";
                              }
                              ?>
                              </strong></h4>
                              
                        <h5 class="indigo-text"><strong><?php echo $r3['show_genre'];?></strong></h5>
                        <p class="card-text">
                        <div style="background-color: #3a3a52;color: white"></div>
                        <br>
                        Not started
                        </p>
                      
                        <a href="http://www.facebook.com/sharer.php?u=https://www.imdb.com/title/<?php echo $u;?>" class="icons-sm li-ic"><i class="fab fa-facebook-f"> </i></a>
                        <a href="http://twitter.com/intent/tweet/?url=https://www.imdb.com/title/<?php echo $u;?>" class="icons-sm tw-ic"><i class="fab fa-twitter"> </i></a>
                        <a href="https://in.pinterest.com/search/pins/?q=<?php echo $r3['show_name'];?>" class="icons-sm fb-ic"><i class="fab fa-pinterest"> </i></a>
                        <?php
                        echo "<a class='icons-sm fb-ic'><i class='fa fa-user' aria-hidden='true'  onclick=setmodalclass('$u') data-toggle='modal' data-target='#fluidModalBottomDangerDemo'></i></a>";
                        ?>
                        <!-- <a class="icons-sm fb-ic"><i class="fa fa-user" aria-hidden="true"  onclick=setmodalclass($u) data-toggle="modal" data-target="#fluidModalBottomDangerDemo" ></i></a> -->
                        </div>
            
                        </div>
                        </div>
                        <?php
                    }
                    ?>
    </div>


  </section>
  
  <style>
    #inp{
        border: 0;
        border-bottom: solid black 2px;
        width: 50%;
        padding: 2%;
        line-height: 2%;
        font-size: 20px;
        right: 0px;
        position: relative;
    }
    #inpfriends{
        border: 0;
        border-bottom: solid black 2px;
        width: 50%;
        padding: 2%;
        line-height: 2%;
        font-size: 20px;
        right: 0px;
        position: relative;
    }
    .modal-dialog.modal-notify.modal-danger .badge, .modal-dialog.modal-notify.modal-danger .modal-header {
    background-color: #a6c;
}
</style>   

  <!-- Full Height Modal Bottom Danger Demo-->
  <div class="modal fade bottom" id="fluidModalBottomDangerDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="true" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-full-height modal-bottom modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Friends</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">×</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <div class="text-center">
          <div class="inpt">
                        <input type="text" name="keyword" id="inpfriends"  placeholder="Enter Name" onkeyup="searchingfriends()">
                        </div>
          </div>
          <ul class="w3-ul w3-card-4" id="srchfrnd">
                        
         
          </ul>
          <ul class="w3-ul w3-card-4" id="prevfrnd">
                        
          <?php 
                            $friends=getfriendlist();
                            
                            foreach ($friends as $friend) {
                            echo $friend;
                            }

                            ?>
                 
         
          </ul>
        </div>

        <!--Footer-->
        <div class="modal-footer">
          
          <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!-- Full Height Modal Bottom Danger Demo-->

  
        </div>
</body>        
<?php
  include('footer.php');
  ?>