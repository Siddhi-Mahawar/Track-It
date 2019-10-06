<?php 

// include the file
include('core/init.php');
$user_id = $_SESSION['user_id'];

// This  file is used to search the friends and to view their profile
    if($_GET['keyword'])
    {
        $con = mysqli_connect('localhost','root','','mytrack');
        $str = $_GET['keyword'];

        // to get the users 
        $que="SELECT * FROM users WHERE user_id!='$user_id' AND firstName LIKE '%$str%' OR username LIKE '%$str%' ORDER BY firstName ";
        $runq = mysqli_query($con,$que);

        // display the result
        while($row = mysqli_fetch_array($runq))
        {
            if($row["user_id"]==$user_id)
                continue;
            $fname=$row["firstName"]." ".$row['lastName'];
            $f_id=$row["user_id"];
            $desc="blah blah";
            $img="img/avtar.jpg";
            $qu="SELECT * FROM friends WHERE status=2 AND (user_id='$user_id' AND friend_id='$f_id') OR (user_id='$f_id' AND friend_id='$user_id' )";
            $run = mysqli_query($con,$qu);
            if(mysqli_num_rows($run)==0)
            {
                continue;
            }
            
            $str='<li class="w3-bar" id="'.$f_id.'">
            <span onclick="  suggesttofriend('.$f_id.') " class="w3-bar-item w3-button w3-white w3-xlarge w3-right" id="sendicon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
            
            <img src="img_avatar2.png" class="w3-bar-item w3-circle w3-hide-small" style="width:80px">
            <div class="w3-bar-item">
              <span class="w3-large">'.$fname.'</span><br>
            </div>
                           
          </li>';
  
         
            echo $str;
            // echo '<image src="'.$img.'" id="'.$f_id.'" style="width:30px ;height:30px;" onclick="'.$fun.'">';
        }
    }
    
?>