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
        while($rows = mysqli_fetch_array($runq))
        {
            // check if its current user
            if($rows['user_id'] == $user_id)
                continue;
                
            // get details of the user
            $u_id=$rows['user_id'];
            $isfriend=false;        
            $userrequested=false;
            $incomingrequest=false;

            // check for freindship with the current user
            $qry="SELECT * FROM friends WHERE  (user_id='$user_id' AND friend_id='$u_id' )OR (user_id='$u_id' AND friend_id='$user_id') ";
            $rslt=mysqli_query($con,$qry);

            // different display for friends and for others
            if(mysqli_num_rows($rslt)!=0)
               
            while($rws=mysqli_fetch_assoc($rslt))
            {
                if($rws['status']==2)
                    $isfriend=true;
                else
                    if($rws['user_id']==$user_id)
                        $userrequested=true;
                    else
                        $incomingrequest=true;

            }

            // get details to diplay
            $img="img/avtar.jpg";
            $name=$rows['firstName']." ".$rows['lastName'];
            $uname=$rows['username'];
            $desc=$rows['descr'];
            $u_id=$rows['user_id'];
            
            // check friends
            if($isfriend==true ){
                $fun="removefriend(";
                $icon="fa-users";    
            }
            else{
                if($userrequested){
                
                    $fun="removefriend(";
                    $icon="fa-times";    
            }
                else
                if($incomingrequest)
                {
                    $fun="acceptrequest(";
                    $icon="fa-plus";
                }
                else
                {
                    $icon="fa-user-plus";
                    $fun="addfriend(";
                }
            }

            // to display the data 
            // $st='<li class="collection-item avatar" >
            // <a href="profile.php?p_id='.$u_id.'">
            // <img src="'.$img.'" alt="" class="circle">
            // <span class="title">'.$name.'</span>
            // <p>'.$uname.' <br>
            // '.$desc.'
            // </p>
            // </a>
            // <a href="#!" class="secondary-content" onclick="'.$fun.$u_id.')" id="'.$u_id.'"><i class="material-icons">'.$icon.'</i></a>
            // </li>';
            
            $str='<li class="w3-bar" id="'.$u_id.'"style="background:white">
            <span   id="icon_'.$u_id.'" onclick="'.$fun.$u_id.')" class="w3-bar-item w3-button w3-white w3-xlarge w3-right"><i class="fa '.$icon.'" aria-hidden="true"></i></span>
            <a href="profile.php?p_id='.$u_id.'">
            <img src="img_avatar2.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
            <div class="w3-bar-item">
              <span class="w3-large">'.$name.'</span><br>
              <span>'.$desc.'</span>
            </div>
            </a>
           
            </li>';
            echo $str;
            // echo '<image src="'.$img.'" id="'.$f_id.'" style="width:30px ;height:30px;" onclick="'.$fun.'">';
        }
    }
    
?>