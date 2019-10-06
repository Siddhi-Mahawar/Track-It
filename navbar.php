
<!-- This file is the navbar of our Track It! -->
<script type="text/javascipt" src="man.js">
</script>

<style>
    @media(min-width: 500px)
    {.srchbar{
            width: 300%;
        }
        }
    @media (max-width: 500px)
    {
        .srchbar{
            width: 100%;
        }
    }
</style>
<link rel="stylesheet" href="notification-demo-style.css" type="text/css">
<nav class="mb-1 navbar navbar-expand-lg navbar-dark secondary-color lighten-1 sticky-top ">
  <a class="navbar-brand" href="home.php" style="font-size:200%;">MyTrack</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown" style="padding:10px">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" style="font-size:125%;">Shows
        </a>
        <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href="shows.php">My Shows</a>
          <a class="dropdown-item" href="calendar.php">Calender</a>
          <a class="dropdown-item" href="upcoming.php">Upcoming</a>
          <a class="dropdown-item" href="trend.php">Trending</a>
          <a class="dropdown-item" href="recommend.php">Recommendations</a>
          <a class="dropdown-item" href="towatch.php">To Watch</a>
        </div>
      </li>
      <li class="nav-item dropdown"  style="padding:10px">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" style="font-size:125%;">Users
        </a>
        <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href="friends.php">Friends</a>
          <a class="dropdown-item" href="friendrequest.php">Friend Requests</a>
          <a class="dropdown-item" href="users.php">Search Friends</a>
          <a class="dropdown-item" href="suggestions.php">Suggestions</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
    <li class="nav-item" style="padding:10px">
        <input class="form-control srchbar" type="text" placeholder="Search Shows" aria-label="Search"data-toggle="modal" data-target=".bd-example-modal-xl" style="width:100%;" >
      </li>
      <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img src="https://www.projectplace.com/Global/images_NEW/icons/large/online-member-management-icon.png" class="rounded-circle z-depth-0" style="max-width:40px;"
            alt="avatar image">
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
          aria-labelledby="navbarDropdownMenuLink-55">
          <a class="dropdown-item" href="home.php">Profile</a>
          <a class="dropdown-item" href="includes/logout.php">Logout</a>
        </div>
      </li>
      <li class="nav-item avatar dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" onclick="myFunction()">
          <img src="assets/img/notif.jpg" class="rounded-circle z-depth-0" style="max-width:40px;"
            alt="avatar image">
        </a>
        <div id="notification-latest"></div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title h4" id="myExtraLargeModalLabel">Search Show</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>    
                  <div class="modal-body">
                    <h3 id="headSeriesName">Show Name</h3>
                    <center>
                    <img src="https://cmkt-image-prd.global.ssl.fastly.net/0.1.0/ps/1382917/910/607/m1/fpnw/wm0/businessman-avatar-icon-01-.jpg?1466426985&s=9c232cc7dfe7b4e1f9252f29e16456e7" style="max-width: 200px;max-height:200px" id="seriesimg">
                    <input class="form-control " type="text" placeholder="Search Shows" aria-label="Search" id="seriesname" onkeyup="getseries()" >
                    
                  </center>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="showresult()">Search</button>
                  </div>
                </div>
              </div>
            </div>


            <script type="text/javascript">

	function myFunction() {
		$.ajax({
			url: "view_notification.php",
			type: "POST",
			processData:false,
			success: function(data){
        console.log(data);
				$("#notification-count").remove();					
				$("#notification-latest").show();$("#notification-latest").html(data);
			},
			error: function(){}           
		});
	 }
	 
	 $(document).ready(function() {
		$('body').click(function(e){
			if ( e.target.id != 'notification-icon'){
				$("#notification-latest").hide();
			}
		});
	});
		 
	</script>