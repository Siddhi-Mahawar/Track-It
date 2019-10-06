<?php 

include('core/init.php');
$user_id = $_SESSION['user_id'];

    if($_GET['keyword'])
    {
        $con = mysqli_connect('localhost','root','','mytrack');
        $str = $_GET['keyword'];

        $que="SELECT * FROM users WHERE user_id!='$user_id' AND firstName LIKE '%$str%' OR username LIKE '%$str%' ORDER BY firstName ";
        // echo $que;
        $runq = mysqli_query($con,$que);
        while($row = mysqli_fetch_array($runq))
        {
            if($row["user_id"]==$user_id)
                continue;
            $fname=$row["firstName"];
            $f_id=$row["user_id"];
            $desc="blah blah";
            // echo $user_id;
            $img="img/avtar.jpg";
            $qu="SELECT * FROM friends WHERE user_id='$user_id' AND friend_id='$f_id' OR user_id='$f_id' AND friend_id='$user_id' ";
            $run = mysqli_query($con,$qu);
            if(mysqli_num_rows($run)==0)
            {
                continue;
            }
            else
            {
                $icon="cancel";
                $fun="removefriend(".$f_id.")";
                
            }
            
            $str='<li class="w3-bar" id="'.$f_id.'">
            <span onclick="  remove('.$f_id.') " class="w3-bar-item w3-button w3-white w3-xlarge w3-right"><i class="fa fa-users" aria-hidden="true"></i></span>
            <a href="profile.php?p_id='.$f_id.'">
            <img src="img_avatar2.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
            <div class="w3-bar-item">
              <span class="w3-large">'.$fname.'</span><br>
              <span>'.$desc.'</span>
            </div>
            </a>
           
          </li>';
         
            echo $str;
            // echo '<image src="'.$img.'" id="'.$f_id.'" style="width:30px ;height:30px;" onclick="'.$fun.'">';
        }
    }
    
?>