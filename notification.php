<?php
$user_id=19;
$conn = new mysqli("localhost","root","","mytrack");
$count=0;
$sql="select * from comment WHERE user_id='$user_id'";
$result=mysqli_query($conn, $sql);


$ar = array();

while($row=mysqli_fetch_array($result))
{
	array_push($ar,$row['comment_id']);
}

$sql1 = "SELECT * FROM comment WHERE comment_parentid IN ('" . implode("','", $ar) . "') AND status='0'" ;
$result=mysqli_query($conn, $sql1);
$count = mysqli_num_rows($result);

?>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Facebook Like Header Notification in PHP</title>
	<link rel="stylesheet" href="notification-demo-style.css" type="text/css">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script type="text/javascript">

	function myFunction() {
		$.ajax({
			url: "view_notification.php",
			type: "POST",
			processData:false,
			success: function(data){
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
	</head>
	<body>
	<div class="demo-content">
		<div id="notification-header">
			   <div style="position:relative">
			   <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span id="notification-count"><?php if($count>0) { echo $count; } ?></span><img src="notification-icon.png" /></button>
				 <div id="notification-latest"></div>
				</div>			
		</div>
	<!-- <?php if(isset($message)) { ?> <div class="error"><?php echo $message; ?></div> <?php } ?>


	<?php if(isset($success)) { ?> <div class="success"><?php echo $success;?></div> <?php } ?> -->
		</div>
	</body>
</html>