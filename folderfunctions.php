<?php   
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    // include('core/init.php');

    // this if used to get all the folders of the user
    function getfolders(){
        
        $user_id=$_SESSION['user_id'];
        $con = mysqli_connect('localhost','root','','mytrack');
        
        // get the folders
        $query = "SELECT * FROM folders WHERE `user_id`=$user_id ORDER BY folder_name";
        
        $result = mysqli_query($con,$query);
        // echo $query;

        $folders=array();

        while($rows=mysqli_fetch_assoc($result))
        {
            $folder_name=$rows['folder_name'];
            $folder_id=$rows['folder_id'];
            $str='<div class="foldercolumn" id="fold_drama" ondblclick="openfolder('.$folder_id.')">
                                    <img src="img/folder.jpg" alt="Snow" style="width:100%">
                                    <center><h4>'.$folder_name.'</h4></center>
                                </div>';
            // echo $folder_name;
            array_push($folders,$str);
        }
        return $folders;

    }

    function showmyshows($folder_id){

        $shows=array();
        $user_id=$_SESSION['user_id'];
        $query = "SELECT * FROM shows WHERE user_id=$user_id AND show_id NOT IN (SELECT show_id FROM list WHERE folder_id=$folder_id)";
        $con = mysqli_connect('localhost','root','','mytrack');
        $result = mysqli_query($con,$query);
        while($rows=mysqli_fetch_assoc($result))
        {
            $show_id=$rows['show_id'];
            $que = "SELECT * FROM tv WHERE show_id='$show_id'";
            $reslt = mysqli_query($con,$que);
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
            
            array_push($shows,$str);
        
        }

        return $shows;
    }

?>