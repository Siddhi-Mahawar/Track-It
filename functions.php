<?php   
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    include('core/init.php');
    include('folderfunctions.php');
        
    // this function getusers() helps to get all the users of the website.

    function getusers(){

        $user_id = $_SESSION['user_id'];
        $allusers=array();
        
        //This query is used to get all users.
        $query="SELECT * FROM users WHERE user_id!='".$user_id."' ORDER BY firstName";
        
        // connect to the database
        $con = mysqli_connect('localhost','root','','mytrack');
        
        $result = mysqli_query($con,$query);
        
        // get the result of the query

        while($rows=mysqli_fetch_array($result))
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
            
            $str='<li class="w3-bar" id="'.$u_id.'" style="background:white">
            <span   id="icon_'.$u_id.'" onclick="'.$fun.$u_id.')" class="w3-bar-item w3-button w3-white w3-xlarge w3-right"><i class="fa '.$icon.'" aria-hidden="true"></i></span>
            <a href="profile.php?p_id='.$u_id.'">
            <img src="img_avatar2.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
            <div class="w3-bar-item">
              <span class="w3-large">'.$name.'</span><br>
              <span>'.$desc.'</span>
            </div>
            </a>
           
            </li>';
         

            array_push($allusers,$str);
        }
        // return the array of the users
        return $allusers;

    }
    
    // this function getfriends() is used to get the list of friends of the current user.
    function getfriends()
    {
        $user_id = $_SESSION['user_id'];
        // connect to the database
        $con = mysqli_connect('localhost','root','','mytrack');

        //get all ids of sender as well as itself
        $query="SELECT * FROM friends WHERE status=2 AND (user_id='$user_id' OR friend_id='$user_id') ";
        $result=mysqli_query($con,$query);
        
        // check if there exists friends
        if(mysqli_num_rows($result)==0)
            return array("Sorry! No Friends");

        //fetching friend ids and creating array for sql to search in like string
        $f_ids="(";
        $p=false;

        while($rows=mysqli_fetch_assoc($result))
        {
            $f_id;
            if($rows['user_id']==$user_id)
                $f_id=$rows['friend_id'];
            else
                $f_id=$rows['user_id'];
            if($p==false)
            {
                $f_ids=$f_ids.$f_id;
                $p=true;
            }
            else
            $f_ids=$f_ids.",".$f_id;
                
        }
        $f_ids=$f_ids.")";
        

        // get the details of friend
        $query="SELECT * FROM users WHERE user_id IN $f_ids";
        $result=mysqli_query($con,$query);
        $dispFriend=array();
   
        // check the details of the user
        if(mysqli_num_rows($result)>0)
        while($rows=mysqli_fetch_assoc($result))
        {
            $img="img/avtar.jpg";
            $fname=$rows['firstName']." ".$rows['lastName'];
            $uname=$rows['username'];
            $desc=$rows['descr'];
            $f_id=$rows['user_id'];
            
            
            $str='<li class="w3-bar" id="'.$f_id.'" style="background:white;">
            <span onclick="  remove('.$f_id.') " class="w3-bar-item w3-button w3-white w3-xlarge w3-right"><i class="fa fa-users" aria-hidden="true"></i></span>
            <a href="profile.php?p_id='.$f_id.'">
            <img src="img_avatar2.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
            <div class="w3-bar-item">
              <span class="w3-large">'.$fname.'</span><br>
              <span>'.$desc.'</span>
            </div>
            </a>
           
          </li>';
         
            array_push($dispFriend,$str);
        }

        // return array of friends
        return $dispFriend;   
    }


    // this function is used to get the friend requests sent by the other users to the current user.
    function getfriendrequests()
    {
        $user_id=$_SESSION['user_id'];
        // connect to the database
        $con = mysqli_connect('localhost','root','','mytrack');

        //get all ids of sender as well as itself
        $query="SELECT * FROM friends WHERE status=0 AND friend_id='$user_id' ";
        // echo $query;
        $result=mysqli_query($con,$query);


        if(mysqli_num_rows($result)==0)
        return array("No Friend requests");
        
        //fetching friend ids and creating array for sql to search in like string
        $f_ids="(";

        $p=false;
        while($rows=mysqli_fetch_assoc($result))
        {
            $f_id;
            if($rows['user_id']==$user_id)
                $f_id=$rows['friend_id'];
            else
                $f_id=$rows['user_id'];
            if($p==false)
            {
                $f_ids=$f_ids.$f_id;
                $p=true;
            }
            else
            $f_ids=$f_ids.",".$f_id;
                
        }
        $f_ids=$f_ids.")";


        // get the details of users who send the friend requests
        $query="SELECT * FROM users WHERE user_id IN $f_ids";
        $result=mysqli_query($con,$query);
        
        $dispFriend=array();

        if($result)
        // get details of the other users

        if(mysqli_num_rows($result)>0)
        while($rows=mysqli_fetch_assoc($result))
        {
            $img="img/avtar.jpg";
            $fname=$rows['firstName']." ".$rows['lastName'];
            $uname=$rows['username'];
            $desc=$rows['descr'];
            $f_id=$rows['user_id'];
            
            $str='<li class="w3-bar" id="'.$f_id.'">
            <span onclick="  acceptrequest('.$f_id.') " class="w3-bar-item w3-button w3-white w3-xlarge w3-right" id="icon_'.$f_id.'"><i class="fa fa-plus" aria-hidden="true"></i>
            </span>
            <a href="profile.php?p_id='.$f_id.'">
            <img src="img_avatar2.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
            <div class="w3-bar-item">
              <span class="w3-large">'.$fname.'</span><br>
              <span>'.$desc.'</span>
            </div>
            </a>
           
          </li>';
         
            array_push($dispFriend,$str);
        }

        // return the array of users who send the friend requests.
        return $dispFriend;   
    }

    function getfriendlist()
    {
        $user_id = $_SESSION['user_id'];
        // connect to the database
        $con = mysqli_connect('localhost','root','','mytrack');

        //get all ids of sender as well as itself
        $query="SELECT * FROM friends WHERE status=2 AND (user_id='$user_id' OR friend_id='$user_id') ";
        $result=mysqli_query($con,$query);
        
        // check if there exists friends
        if(mysqli_num_rows($result)==0)
            return array("Sorry! No Friends");

        //fetching friend ids and creating array for sql to search in like string
        $f_ids="(";
        $p=false;

        while($rows=mysqli_fetch_assoc($result))
        {
            $f_id;
            if($rows['user_id']==$user_id)
                $f_id=$rows['friend_id'];
            else
                $f_id=$rows['user_id'];
            if($p==false)
            {
                $f_ids=$f_ids.$f_id;
                $p=true;
            }
            else
            $f_ids=$f_ids.",".$f_id;
                
        }
        $f_ids=$f_ids.")";
        

        // get the details of friend
        $query="SELECT * FROM users WHERE user_id IN $f_ids";
        $result=mysqli_query($con,$query);
        $dispFriend=array();
   
        // check the details of the user
        if(mysqli_num_rows($result)>0)
        while($rows=mysqli_fetch_assoc($result))
        {
            $img="img/avtar.jpg";
            $fname=$rows['firstName']." ".$rows['lastName'];
            $uname=$rows['username'];
            $desc=$rows['descr'];
            $f_id=$rows['user_id'];
            
            
            $str='<li class="w3-bar" id="'.$f_id.'">
            <span onclick="  suggesttofriend('.$f_id.') " class="w3-bar-item w3-button w3-white w3-xlarge w3-right" id="sendicon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
            
            <img src="img_avatar2.png" class="w3-bar-item w3-circle w3-hide-small" style="width:80px">
            <div class="w3-bar-item">
              <span class="w3-large">'.$fname.'</span><br>
            </div>
                           
          </li>';
         
            array_push($dispFriend,$str);
        }

        // return array of friends
        return $dispFriend;   
    }

    function getfriendsuggestions()
    {
        $user_id = $_SESSION['user_id'];
        // connect to the database
        $con = mysqli_connect('localhost','root','','mytrack');

        //get all ids of sender as well as itself
        $query="SELECT * FROM friendsuggest WHERE friend_id='$user_id' ORDER BY Date DESC";
        
        $result=mysqli_query($con,$query);
        
        // check if there exists friends
        if(mysqli_num_rows($result)==0)
            return array("Sorry! No Suggestions");

        $dispFriend =array();

        while($rows=mysqli_fetch_assoc($result))
        {
            $imdb_id = $rows['imdb_id'];
            $friend_id=$rows['user_id'];
            $date = $rows['Date'];
            $friendname="";
            $moviename="";
            $movieurl="";
            //get friend name

            $fnamequery= "SELECT * FROM users WHERE user_id=$friend_id";
            $fnameresult=mysqli_query($con,$fnamequery);
            while($namerows=mysqli_fetch_assoc($fnameresult))
            {
                $fname=$namerows['firstName'];
                $lname=$namerows['lastName'];
                $friendname = $fname." ".$lname;
            }


            $moviequery= "SELECT * FROM tv WHERE show_id='$imdb_id'";
            $movieresult=mysqli_query($con,$moviequery);
            while($movierows=mysqli_fetch_assoc($movieresult))
            {
                $moviename=$movierows['show_name'];
                $movieurl = $movierows['show_url'];
            } 
            
            $str= $friendname." suggested ".$moviename." on date ".$date." image url:<img src=".$movieurl.">";
            
            $str = '<div class="col-lg-4 col-md-12 mb-4">
            <div class="card card-cascade wider mb-4">
              <div class="view view-cascade">
                <img src="'.$movieurl.'" style="max-height:200px" class="card-img-top" alt="Example photo">
                <a href="tv_show.php?t='.$imdb_id.'">
                <div class="mask rgba-white-slight waves-effect waves-light"></div>
                </a>
                </div>
                <div class="card-body card-body-cascade text-center">
                <h4 class="card-title"><strong>'.$moviename.'
                  
                      </strong></h4>
                <h5 class="indigo-text"><strong></strong></h5>
                <p class="card-text">
                <div style="background-color: #3a3a52;width:0%;color: white">0%</div>
                <br>
                    Suggested by '.$friendname.' on Date: '.$date.';
                </p>
    
    
                </div>
    
                </div>
                </div>';

            
            array_push($dispFriend,$str);
        }

        // return array of friends
        return $dispFriend;   
    }

    function sendToMail($email, $message, $subject){
        $mail  = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPDebug  = 0;
        $mail->Host       = M_HOST;
        $mail->Username   = M_USERNAME;
        $mail->Password   = M_PASSWORD;
        $mail->SMTPSecure = M_SMTPSECURE;
        $mail->Port       = M_PORT;

        if(!empty($email)){
            $mail->From     = "teameuphony00@gmail.com";
            $mail->FromName = "teameuphony00";
            $mail->addReplyTo('teameuphony00@gmail.com');
            $mail->addAddress($email);

            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            if(!$mail->send()){
                return false;
            }else{
                return true;
            }
        }
    }

?>