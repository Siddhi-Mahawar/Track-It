<!-- This file is used to send the friend request of the other users sent by the current user. -->
<?php 

    include('core/init.php');

    //connect to the database
    $con = mysqli_connect('localhost','root','','mytrack');
    $user_id=$_SESSION['user_id'];
    extract($_GET); 
    if($_GET['friendId'])
    {
        
        $f_id = $_GET['friendId'];
        $imdb_id=$_GET['imdb_id'];
        
        // this query is used to check whether or not the users have been added as friends

        $que="SELECT * FROM friendsuggest WHERE user_id = '$user_id' AND friend_id ='$f_id' AND imdb_id = '$imdb_id'";
        $runq = mysqli_query($con,$que);
        $rowcount=mysqli_num_rows($runq);
        echo $que;


        if($rowcount)
        {

            echo 'Already present' ;

        }
        else {
            
            // this query is used to insert the friendship status to other user from current user
            $currentDateTime = date('Y-m-d');
            $que="INSERT INTO friendsuggest(user_id, friend_id,imdb_id,Date ) VALUES ('$user_id', '$f_id', '$imdb_id','$currentDateTime')";
            $runq = mysqli_query($con,$que);        
            echo $que;
        
        }   
    }
?>
