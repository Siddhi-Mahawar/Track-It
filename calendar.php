<?php
include('check.php');

$user_id = $_SESSION['user_id'];

if(empty($_SESSION['fb_login']))
{
  $user = $userObj->userData($user_id);
  $verifyObj->authOnly();
}

//connect to the database
$con = mysqli_connect('localhost','root','','mytrack');

// get the shows which the user has added
$q = "SELECT * FROM shows WHERE user_id='$user_id'";
    $res = mysqli_query($con,$q);
    
    $show  = array();
    
    while($row = mysqli_fetch_array($res))
    {
        array_push($show,$row['show_id']);
    }


?>
<!DOCTYPE html>
<html>

<head>
<title>Track it!</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- <script src="dist/progressbar.js"></script> -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet">
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/js/mdb.min.js"></script>
<link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
<script src="fullcalendar/lib/jquery.min.js"></script>
<script src="fullcalendar/lib/moment.min.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>
<script>

//get all the events from the ajax call
$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "fetch-event.php",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: 'add-event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');
        },
        
        editable: true,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "delete-event.php",
                    data: "&id=" + event.id,
                    success: function (response) {
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        }

    });
});

function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>
<script>

var ar = <?php echo json_encode($show); ?>;
console.log(ar);

show_upcoming3(ar,0);

var c;

function show_upcoming3(show_id1,i)
{
    console.log("upcomin");
    if(i==0)
    {
        c=new Array();
    }
    if(i<show_id1.length)
    {
    if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }

        
        
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                myObj = JSON.parse(this.responseText);
                console.log(myObj);
                c.push(myObj.tv_results[0].id);
                show_up3(myObj.tv_results[0].id);
                show_upcoming3(show_id1,i+1);

            }
        }   
            xmlhttp.open('GET','https://api.themoviedb.org/3/find/'+show_id1[i]+'?api_key=993dceca3a50f4e4e854202a0095b29e&language=en-US&external_source=imdb_id',true);
            xmlhttp.send();
    }
    else if(i==show_id1.length)
        show_up3(0);
}

var data;
function show_up3(show_id2)
{
    
    if(show_id2==0)
    {
        data="";
    }
    if(show_id2<c.length)
    {

    if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }

        
        
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

                myObj = JSON.parse(this.responseText);
                console.log(myObj);
                show_up3(show_id2+1);
                var v;
                if(myObj.next_episode_to_air)
                {
                    v = myObj.next_episode_to_air.air_date;
                    // console.log(v);
                    // console.log(myObj.name);
                    addcalendar(v,myObj.name);
                }
                
                
            }
        }   

            xmlhttp.open('GET','https://api.themoviedb.org/3/tv/'+c[show_id2]+'?api_key=993dceca3a50f4e4e854202a0095b29e&language=en-US',true);
            xmlhttp.send();
    }
}

function addcalendar(v,showname)
{
    console.log(v);
    console.log(showname);
    var datastring = 'title='+ showname + '&start=' +v+'&end='+v;
    console.log(datastring);
    $.ajax({
                    type: "POST",
                    url: 'add-event1.php',
                    data: datastring,
                    success: function(data)
                    {
                        console.log(data);
                        // window.location = "http://localhost/TvTracker/tv_show.php?t="+id;
                    }
                });

}

</script>

<!-- styling of the page  -->
<style>
body {
    /* margin-top: 50px; */
    text-align: center;
    font-size: 12px;
    font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
}

#calendar {
    background-color:white;
    width: 700px;
    margin: 0 auto;
    padding:1%
}

.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}

</style>
</head>

<body style="color: #000 !important;
background-color: black ">
<?php
    include('navbar.php');
?>

    <div class="response"></div>
    <div id='calendar'></div>
    
</body>


</html>