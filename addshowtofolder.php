<!-- This file is used to display folder you added and the shows added in it -->
<?php 

    include('core/init.php');

    //connect to the database
    
    $con = mysqli_connect('localhost','root','','mytrack');
    if($_GET['fold_id'])
    {
        
        $folder_id= $_GET['fold_id'];
        $user_id=$_SESSION['user_id'];
        $show_id=$_GET['show_id'];

        $que="SELECT * FROM list WHERE folder_id = '$folder_id' AND show_id='$show_id'";
        echo $que;
        $runq = mysqli_query($con,$que);
        $rowcount=mysqli_num_rows($runq);


        if($rowcount)
        {

            echo 'Already present' ;

        }
        else {
            

            // $que="INSERT INTO folders (folder_id,folder_name,user_id ) VALUES (,$folder_name,$user_id)";
            $que="INSERT INTO `list` (`folder_id`, `show_id`) VALUES ( '$folder_id', '$show_id')";
            // echo $que;
            $runq = mysqli_query($con,$que);        
        
        }   
    }
?>
