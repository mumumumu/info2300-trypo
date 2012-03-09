<?php
	session_start();		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Discussion Board</title>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="styles/navigation.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.8.11.custom.min.js"></script>
	</head>
	<body>
		<?php
			$page = "Discussion Board";
			require("header.php");
		?>
        <div class="main">
        	<?php 
        		include("password.php");
        		if(isset($_SESSION["isMember"]) && $_SESSION["isMember"] == true){
					require("leftBoxes.php");
					
					print("<div class=\"content\">");
					if(isset($_POST["submit"]))	{
						$post = htmlentities(trim(mysql_real_escape_string($_POST["post"])));
						if(!isset($_POST["post"]) || $_POST["post"] == "" || $_POST["post"] ==	"Enter what you would like to post here."){
							print("<p>You must enter something to post to the discussion board</p>");
							require("discussionBoardForm.php");
						} else {
							$mysqli = new mysqli($host, $login, $password, $databaseName);
							if ( mysqli_connect_error()){
								die("Can't connect to database: ".$mysqli->error);
							} else {
								$query = "INSERT INTO  DiscussionBoard (user,time,post) VALUES ('".$_SESSION["firstname"]."', NOW(), '".$post."')";
								$result = $mysqli->query($query) or die("Failed to send post to database");
								$mysqli->close();
								print("<p>loading...</p>");
								print("<meta http-equiv='refresh' content='0; discussionBoard.php' />");	
							}
						}	
					} else {
						require("discussionBoardForm.php");
					}	
					$mysqli = new mysqli($host, $login, $password, $databaseName);
					if ( mysqli_connect_error()){
						die("Can't connect to database: ".$mysqli->error);
					} else {
						$query1 = "SELECT * FROM DiscussionBoard ORDER BY time DESC ";
						$result1 = $mysqli->query($query1);
						if($result1) {
							if($result1->num_rows > 0) {
								print("<br /><br /><div class=\"contentSection\">");
							}
							$i = 0;
							while(($array = $result1->fetch_row()) && ($i < 15)) {	
								print("<div class=\"post\">");
								print("<p><em>Posted by ".$array[0]." at ".$array[1]."</em></p>");
								print("<p>".$array[2]."</p></div><br />");
								$i = $i + 1;
							}
							if($result1->num_rows > 0) {
								print("</div>");
							}
						}
						$mysqli->close();
					}
					print("</div>");
				} else {
					print("<div class=\"content\"><div class=\"contentSection\">");
					print("<h3>You must be logged-in to view this page</h3>");
					print("</div></div>");
				}
			?>
        </div>
</body>
</html>