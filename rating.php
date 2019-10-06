<?php

include "core/init.php";
extract($_GET);
$con = mysqli_connect('localhost','root','','mytrack');
$userid = $_SESSION['user_id'];

if(empty($_SESSION['fb_login']))
{
  $user = $userObj->userData($userid);
  $verifyObj->authOnly();
}

$q = "SELECT * FROM tv WHERE show_id='$id'";
$res = mysqli_query($con,$q);

while($row = mysqli_fetch_array($res))
{
    $name = $row['show_name'];
}

$unid = $id."S".$sno."E".$epino;
$_SESSION['un_id'] = $unid;

?>
<html>
    <head>
    <title>Track it!</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

        <link href="style.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>
        
        <script type="text/javascript" src="man.js"></script>
        <!-- Script -->
        <script src="jquery-3.0.0.js" type="text/javascript"></script>
        <script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
        <style>
		@import url(https://fonts.googleapis.com/css?family=Lato:400,300,700);
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
*, *:before, *:after {
  box-sizing: border-box;
}

.movie-card{
  height: 100%;
  width: 100%;
}
a {
  text-decoration: none;
  color: #5C7FB8;
}
a:hover {
  text-decoration: underline;
}
.movie-card {
  font: 14px/22px "Lato", Arial, sans-serif;
  /* color: #A9A8A3; */
  padding: 20px 0;
}

.column1 {
  padding-left: 1%;
  padding-top: 10%;
  width: 25%;
  float: left;
  text-align: center;
}
.container {
  margin: 0 auto;
  width: 100%;
  height: 100%;
  /* background: #F0F0ED; */
  border-radius: 5px;
  position: relative;
  padding: 0;
}
.hero {
  height: 342px;
  margin: 0;
  position: relative;
  overflow: hidden;
  z-index: 1;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  background-repeat: no-repeat;
}
.hero:before {
  content: '';
  background-repeat: no-repeat;
  width: 200%;
  height: 100%;
  position: absolute;
  overflow: hidden;
  top: 0;
  left: 0;
  z-index: -1;
  background-size: 100%;
  transform: skewY(-2.2deg);
  transform-origin: 0 0;
  /* -webkit-backface-visibility: hidden; */
}
.cover {
  position: absolute;
  top: 160px;
  left: 40px;
  z-index: 2;
}
@media (min-width: 500px) {
  .details {
  padding: 190px 0 0 280px;
}
.details .title1 {
  color: black;
  font-size: 300%;
  margin-bottom: 13px;
  position: relative;
}
.details .title1 span {
  position: absolute;
  top: 3px;
  margin-left: 12px;
  background: #C4AF3D;
  border-radius: 5px;
  color: #544C21;
  font-size: 14px;
  padding: 0px 4px;
}
.details .title2 {
  color: #C7C1BA;
  font-size: 23px;
  font-weight: 300;
  margin-bottom: 15px;
}
.details .likes {
  margin-left: 24px;
}
.details .likes:before {
  content: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/icon_like.png");
  position: relative;
  top: 2px;
  padding-right: 7px;
}


}

@media (max-width: 500px)
{
  .details {
  padding: 10% 0 0 10%;
}
.details .title1 {
  color: white;
  font-size: 300%;
  margin-bottom: 13px;
  position: relative;
}
.details .title1 span {
  position: absolute;
  top: 3px;
  margin-left: 12px;
  background: #C4AF3D;
  border-radius: 5px;
  color: #544C21;
  font-size: 14px;
  padding: 0px 4px;
}
.details .title2 {
  color: #C7C1BA;
  font-size: 23px;
  font-weight: 300;
  margin-bottom: 15px;
}
.details .likes {
  margin-left: 24px;
}
.details .likes:before {
  content: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/icon_like.png");
  position: relative;
  top: 2px;
  padding-right: 7px;
}
.cover {
  position: absolute;
  top: 100px;
  left: 25%;
  z-index: 2;
}
.column1 {
  padding-left: 10%;
  padding-top: 16%;
  width: 100%;
  float: left;
  text-align: center;
  color:black;
}

}
.description {
  bottom: 0px;
  font-size: 16px;
  line-height: 26px;
  color: #000000;
}
.tag {
  /* background: white; */
  border-radius: 10px;
  padding: 3px 8px;
  font-size: 14px;
  margin-right: 4px;
  line-height: 35px;
  cursor: pointer;
  background: #ddd;
}

.column2 {
  padding-left: 10%;
  padding-top: 30px;
  margin-left: 20px;
  width: 70%;
  float: left;
}
@media (max-width: 500px)
{
  .column2{
    padding-left: 10%;
  padding-top: 30px;
  margin-left: 20px;
  width: 80%;
  /* float: left; */
  font-size: 8px;

  }  
}

.avatars {
  margin-top: 23px;
}
.avatars img {
  cursor: pointer;
}
.avatars img:hover {
  opacity: 0.6;
}
.avatars a:hover {
  text-decoration: none;
}
fieldset, label {
  margin: 0;
  padding: 0;
}
/****** Style Star Rating Widget *****/
.rating {
  border: none;
  float: left;
}
.rating > input {
  display: none;
}
.rating > label:before {
  margin: 5px;
  margin-top: 0;
  font-size: 1em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}
.rating > .half:before {
  content: "\f089";
  position: absolute;
}
.rating > label {
  color: #fff;
  float: right;
}
a[data-tooltip] {
  position: relative;
}
a[data-tooltip]::before, a[data-tooltip]::after {
  position: absolute;
  display: none;
  opacity: 0.;
}


.comment-form-container {
	background: transparent;
	
	padding: 20px;
	width:50%;
	border-radius: 2px;
	float:right;
	
}
.comment-form-container1 {
	background: transparent;

	padding: 20px;
	width:50%;
	border-radius: 2px;
	float:right;
	color:white;
}


.input-row {
	margin-bottom: 20px;
}

.input-field {
	width: 100%;
	border-radius: 2px;
	padding: 10px;
	border: #e0dfdf 1px solid;
}

.btn-submit {
	padding: 10px 20px;
	background: #333;
	border: #1d1d1d 1px solid;
	color: #f0f0f0;
	font-size: 0.9em;
	width: 100px;
	border-radius: 2px;
    cursor:pointer;
}

ul {
	list-style-type: none;
}

.comment-row {
	border-bottom: #e0dfdf 1px solid;	
	width: 50%;
	
}

.outer-comment {
	background: #F0F0F0;
	padding: 20px;
	border: #dedddd 1px solid;
	
	
}

span.commet-row-label {
	font-style: italic;
}

span.posted-by {
	color: #09F;
}

.comment-info {
	font-size: 0.8em;
}
.comment-text {
    margin: 10px 0px;
}
.btn-reply {
    font-size: 0.8em;
    text-decoration: underline;
    color: #888787;
    cursor:pointer;
}
#comment-message {
    margin-left: 200px;
    color: #189a18;
    display: none;
}
</style>
        <script type="text/javascript">

        var nam2 = <?php echo json_encode($name); ?>;
        var name = <?php echo json_encode($sno); ?>;
        
        var id = <?php echo json_encode($id); ?>;

        var eid =<?php echo json_encode($epino); ?>;
        showpart(id,nam2,name,eid);
        
        $(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {

                    // Get element id by data-id attribute
                    var el = this;
                    var el_id = el.$elem.data('id');

                    // rating was selected by a user
                    if (typeof(event) !== 'undefined') {
                        
                        var split_id = el_id.split("_");

                        var postid = split_id[1];  // postid

                        // AJAX Request
                        $.ajax({
                            url: 'rating_ajax.php',
                            type: 'post',
                            data: {postid:postid,rating:value},
                            dataType: 'json',
                            success: function(data){
                                // Update average
                                var average = data['averageRating'];
                                console.log(average);
                                $('#avgrating_'+postid).text(average);
                            }
                        });
                    }
                }
            });
        });
        </script>
    </head>
  <body style="background-color: black;">
<!--/.Navbar -->
<?php include('navbar.php'); ?>
      
            <?php
                    // User rating
                    $query = "SELECT * FROM rating WHERE episode_id='$unid' and user_id='$userid'";
                    $userresult = mysqli_query($con,$query);
                    $rating = 0;
                    if(mysqli_num_rows($userresult) == 0)
                        $rating=0;
                    else
                    {
                        $fetchRating = mysqli_fetch_array($userresult);
                        $rating = $fetchRating['rating'];
                    }
                    // get average
                    $query = "SELECT ROUND(AVG(rating),1) as rating FROM rating WHERE episode_id='$unid'";
                    $avgresult = mysqli_query($con,$query);

                    // echo mysqli_num_rows($avgresult);

                    $fetchAverage = mysqli_fetch_array($avgresult);
                    $averageRating = $fetchAverage['rating'];

                    // echo "hey\n";
                    // echo $averageRating;

                    if($averageRating <= 0){
                        $averageRating = "No rating yet.";
                    }
            ?>
                    
        </div>
        </div>

        
    <div class="comment-form-container1">
	<div class="post">
                        <!-- <h1><a href='<?php echo $link; ?>' class='link' target='_blank'><?php echo $title; ?></a></h1> -->
                        <!-- <div class="post-text">
                            <?php echo $content; ?>
                        </div> -->
                        <div class="post-action">
                            <!-- Rating -->
							<h1  style="color:#f7ec86">Rate this episode!!</h1>
                            <select class='rating' id='rating_<?php echo $unid; ?>' data-id='rating_<?php echo $unid; ?>'>
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="5" >5</option>
                            </select>
                            <div style='clear: both;'></div>
                            Average Rating : <span id='avgrating_<?php echo $unid; ?>'><?php echo $averageRating; ?></span>

                            <!-- Set rating -->
                            <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#rating_<?php echo $unid; ?>').barrating('set',<?php echo $rating; ?>);
                            });
                            
                            </script>
                        </div>
                    </div>
			</div>
		<div class="comment-form-container">
			<h1 style="color:#95c0e8">Post your comments here!!</h1>
        <form id="frm-comment">
            <div class="input-row">
                <input type="hidden" name="comment_id" id="commentId"
                    placeholder="Name" />
            </div>
            <div class="input-row">
                <textarea class="input-field" type="text" name="comment"
                    id="comment" placeholder=" Post your comments here!!">  </textarea>
            </div>
            <div>
                <input type="button" class="btn-submit btn-info" id="submitButton"
                    value="Publish" /><div id="comment-message">Comments Added Successfully!</div>
            </div>

        </form>
    
    <div id="output"></div>
    <script>
            function postReply(commentId) {
                $('#commentId').val(commentId);
                $("#comment").focus();
            }

            $("#submitButton").click(function () {
            	   $("#comment-message").css('display', 'none');
                var str = $("#frm-comment").serialize();

                $.ajax({
                    url: "comment-add.php",
                    data: str,
                    type: 'post',
                    success: function (response)
                    {
                        var result = eval('(' + response + ')');
                        if (response)
                        {
                            console.log(response);
                        	$("#comment-message").css('display', 'inline-block');
                            $("#comment").val("");
                            $("#commentId").val("");
                     	   listComment();
                        } else
                        {
                            alert("Failed to add comments !");
                            return false;
                        }
                    }
                });
            });
            
            $(document).ready(function () {
            	   listComment();
            });

            function listComment() {
                $.post("comment-list.php",
                        function (data) {
                            console.log(data);
                               var data = JSON.parse(data);
                            
                            var comments = "";
                            var replies = "";
                            var item = "";
                            var parent = -1;
                            var results = new Array();

                            var list = $("<ul class='outer-comment'>");
                            var item = $("<li>").html(comments);
                            
                            for (var i = 0; (i < data.length); i++)
                            {
                                var commentId = data[i]['comment_id'];
                                parent = data[i]['comment_parentid'];

                                if (parent == "0")
                                {
                                    var j = data[i]['user_id'];
                                    comments = "<div class='comment-row'>"+
                                    "<div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['comment_date'] + "</span></div>" + 
                                    "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
                                    "<div><a class='btn-reply' style='text-decoration:underline;color:#377ebf;' onClick='postReply(" + commentId + ")'>Reply</a></div>"+
                                    "</div>";

                                    var item = $("<li>").html(comments);
                                    list.append(item);
                                    var reply_list = $('<ul>');
                                    item.append(reply_list);
                                    listReplies(commentId, data, reply_list);
                                }
                            }
                            $("#output").html(list);
                        });
            }

            function listReplies(commentId, data, list) {
                for (var i = 0; (i < data.length); i++)
                {
                    if (commentId == data[i].comment_parentid)
                    {
                        var comments = "<div class='comment-row'>"+
                        " <div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['comment_date'] + "</span></div>" + 
                        "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
                        "<div><a class='btn-reply'  style='text-decoration:underline;color:#377ebf;' onClick='postReply(" + data[i]['comment_id'] + ")'>Reply</a></div>"+
                        "</div>";
                        var item = $("<li>").html(comments);
                        var reply_list = $('<ul>');
                        list.append(item);
                        item.append(reply_list);
                        listReplies(data[i].comment_id, data, reply_list);
                    }
                }
            }
        </script>
    </body>
</html>
<?php
  include('footer.php');
  ?>
