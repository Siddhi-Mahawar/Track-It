<?php 

// include the file
include('core/init.php');
$user_id = $_SESSION['user_id'];

// connect to the database
    $con = mysqli_connect('localhost','root','','mytrack');
    
    if($con)
    {
        echo "connected";
    }
    // get the details of the friend already added
    if($_GET['friendId'])
    {

        $id = $_GET['friendId'];
        $user_id=$_SESSION['user_id'];

        // get deatils of the friend
        $que="SELECT * FROM friends WHERE user_id = '$user_id' AND friend_id='$id' OR user_id='$id' AND friend_id='$user_id'";
        echo $que;
        
        $runq = mysqli_query($con,$que);
        
        $rowcount=mysqli_num_rows($runq);
        if($rowcount==0)
            echo 'Not present' ;
        else {

            // remove friendship from database
            $que="DELETE FROM friends WHERE user_id='$user_id' AND friend_id='$id' OR user_id='$id' AND friend_id='$user_id'";
            $runq = mysqli_query($con,$que);
            // if($runq)
            echo $que;          
        }   
    }
?>
