<?php 

// include the files
include('core/init.php');
$user_id = $_SESSION['user_id'];

// This function is used to show the folder which is already present in users and to add new folder
    if($_GET['keyword'])
    {

        // connect to the database
        $con = mysqli_connect('localhost','root','','mytrack');
        $keyword = $_GET['keyword'];
        $folder_id = $_GET['fold_id'];
        
        // $shows=array();
        $user_id=$_SESSION['user_id'];
        
        // get the shows present in the folder

        $query = "SELECT * FROM shows WHERE user_id=$user_id AND show_id NOT IN (SELECT show_id FROM list WHERE folder_id=$folder_id)";
        $result = mysqli_query($con,$query);
        
        // get the details of the tv show which the user has added
        while($rows=mysqli_fetch_assoc($result))
        {
            $show_id=$rows['show_id'];
            $que = "SELECT * FROM tv WHERE show_id='$show_id' AND show_name LIKE '%$keyword%'";
            $reslt = mysqli_query($con,$que);
            $rowcount=mysqli_num_rows($reslt);
            if($rowcount==0)
            {
                continue;
            }
            $show_name="";            
            $imgurl="";
            while($row=mysqli_fetch_assoc($reslt))
            {
                $show_name=$row['show_name'];
                $imgurl = $row['show_url'];
            }
                $str='<li class="w3-bar" id="'.$show_id.'">
            <span onclick="  addshowtofolder(\''.$show_id.'\','.$folder_id.') " class="w3-bar-item w3-button w3-white w3-xlarge w3-right"><i class="fa fa-plus" aria-hidden="true"></i></span>
            
            <img src="'.$imgurl.'" class="w3-bar-item w3-circle w3-hide-small" style="width:40px">
            <div class="w3-bar-item">
              <span class="w3-large">'.$show_name.'</span><br>
            </div>
                           
            </li>';
            echo $str;
        
        

            // $que="SELECT * FROM users WHERE user_id!='$user_id' AND firstName LIKE '%$str%' OR username LIKE '%$str%' ORDER BY firstName ";
            // echo $que;
            // echo '<image src="'.$img.'" id="'.$f_id.'" style="width:30px ;height:30px;" onclick="'.$fun.'">';
        }
    }
    
?>