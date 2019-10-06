<?php

    // include the file
    include('core/init.php');
    $user_id = $_SESSION['user_id'];

    // connect to the database
    $con = mysqli_connect('localhost','root','','mytrack');

    $json = array();

    // get the events added to the calendar
    $sqlQuery = "SELECT * FROM tbl_events WHERE user_id='$user_id' ORDER BY id";

    $result = mysqli_query($con, $sqlQuery);
    $eventArray = array();

    // get all the events and add in the array
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($con);
    echo json_encode($eventArray);
?>