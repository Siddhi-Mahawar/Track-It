<!-- This file is used to send the friend request of the other users sent by the current user. -->
<?php 

    include('core/init.php');

    //connect to the database
    $con = mysqli_connect('localhost','root','','mytrack');

    if($_GET['newfriendId'])
    {
        
        $id = $_GET['newfriendId'];
        $user_id=$_SESSION['user_id'];
        
        // this query is used to check whether or not the users have been added as friends

        $que="SELECT * FROM friends WHERE user_id = '$user_id' AND friend_id='$id'";
        $runq = mysqli_query($con,$que);
        $rowcount=mysqli_num_rows($runq);


        if($rowcount)
        {

            echo 'Already present' ;

        }
        else {
            
            // this query is used to insert the friendship status to other user from current user

            $que="INSERT INTO friends (user_id, friend_id, status) VALUES ('$user_id', '$id', '0')";
            $runq = mysqli_query($con,$que);        
        
        }   
    }
?>
