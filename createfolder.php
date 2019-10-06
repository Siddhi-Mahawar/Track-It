<?php 

    include('core/init.php');

    //connect to the database
    
    $con = mysqli_connect('localhost','root','','mytrack');
    
    // get the details of the folder name and insert into the folder if needed
    if($_GET['foldername'])
    {
        
        $folder_name= $_GET['foldername'];
        $user_id=$_SESSION['user_id'];
        
        $que="SELECT * FROM folders WHERE user_id = '$user_id' AND folder_name='$folder_name'";
        echo $que;
        $runq = mysqli_query($con,$que);
        $rowcount=mysqli_num_rows($runq);


        if($rowcount)
        {

            echo 'Already present' ;

        }
        else {
            

            $que="INSERT INTO `folders` (`folder_id`, `folder_name`, `user_id`) VALUES (NULL, '$folder_name', '$user_id')";
            echo $que;
            $runq = mysqli_query($con,$que);        
        
        }   
    }
?>
