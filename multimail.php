<?php


// connect to the database
    $con = mysqli_connect('localhost','root','','mytrack');
    
    //  get all the shows which are added
    $q = "SELECT DISTINCT show_id FROM shows";
    $res1 = mysqli_query($con,$q);

    $a = array();

    // get the result in an array
    while($row = mysqli_fetch_array($res1))
    {

            array_push($a,$row['show_id']);
    }



?>

<head>
<title>Track it!</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
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
<script type="text/javascript" src="man.js"></script>
</head>
<script>

    // get th upcoming epispode of the shows
    var ar = <?php echo json_encode($a); ?>;
    console.log(ar);
    show_upcoming(ar,0);

    function try1()
    {
        var datastring = 'name='+ e;
        // console.log(datastring);
        // send the mail to the users who have release date of some epispode of their tv show

        $.ajax({
                        type: "POST",
                        url: 'back.php',
                        data: datastring,
                        success: function(data)
                        {
                            console.log(data);
                        }
                    });
        }
    var c;
    var d;
    var e;
    function show_upcoming(show_id1,i)
    {
        if(i==0)
        {
            c=new Array();
            d = new Array();
            e = new Array();
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
                    // console.log(myObj);
                    c.push(myObj.tv_results[0].id);
                    d.push(show_id1[i]);
                    show_upcoming(show_id1,i+1);

                }
            }   
                xmlhttp.open('GET','https://api.themoviedb.org/3/find/'+show_id1[i]+'?api_key=993dceca3a50f4e4e854202a0095b29e&language=en-US&external_source=imdb_id',true);
                xmlhttp.send();
        }
        else if(i==show_id1.length)
        {
            show_up(0);
        }
    }

    function show_up(show_id2)
    {
        
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
                    var rel;
                    var today = new Date();
                    var tomorrow = new Date();
                    tomorrow.setDate(today.getDate());
                    if(tomorrow.getMonth()<9)
                    {
                        rel = tomorrow.getFullYear()+'-0'+(tomorrow.getMonth()+1)+'-';
                    }
                    else
                    {
                    rel = tomorrow.getFullYear()+'-'+(tomorrow.getMonth()+1)+'-';
                    }

                    if(tomorrow.getDate()<10)
                    {
                        rel+='0'+tomorrow.getDate();
                    }
                    else
                    {
                        rel+=tomorrow.getDate();
                    }
                    myObj = JSON.parse(this.responseText);
                                if(myObj.next_episode_to_air!=null)
                                {

                                    var show_rel=myObj.next_episode_to_air.air_date;
                                    if(show_rel == rel)
                                        e.push(d[show_id2]);
                                    
                                }
                                show_up(show_id2+1);
                                if(show_id2 == c.length-1)
                                    {
                                        console.log(e);
                                        try1();
                                    }
                    
                }
            }   

                xmlhttp.open('GET','https://api.themoviedb.org/3/tv/'+c[show_id2]+'?api_key=993dceca3a50f4e4e854202a0095b29e&language=en-US',true);
                xmlhttp.send();
        }
    }
</script>
<?php

?>