<?php
	session_start();		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Members</title>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="styles/navigation.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.8.11.custom.min.js"></script>
	</head>
	<body>
		<?php
			$page = "Members";
			require("header.php");
		?>
        <div class="main">
        	<?php 
				if(isset($_SESSION["isMember"]) && $_SESSION["isMember"] == true)
        		{
					require("leftBoxes.php");
					include("password.php");
					$mysqli = new mysqli($host, $login, $password, $databaseName);
					if ( mysqli_connect_error() ) 
					{
						die("Can't connect to database: ".$mysqli->error);
					}
					else
					{
						print("<div class=\"content\">");
						print("<div class=\"contentSection\">");
						print("<h2>Young Person's Orchestra</h2>");
						print("<hr />");
						$query1 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='violin'";
						$result1 = $mysqli->query($query1);
						if($result1)
						{
							if($result1->num_rows > 0)
							{
								print("<h3>Violin</h3>");
							}
							while($array = $result1->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query2 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='viola'";
						$result2 = $mysqli->query($query2);
						if($result2)
						{
							if($result2->num_rows > 0)
							{
								print("<h3>Viola</h3>");
							}
							while($array = $result2->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query3 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='cello'";
						$result3 = $mysqli->query($query3);
						if($result3)
						{
							if($result3->num_rows > 0)
							{
								print("<h3>Cello</h3>");
							}
							while($array = $result3->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query4 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='bass'";
						$result4 = $mysqli->query($query4);
						if($result2)
						{
							if($result4->num_rows > 0)
							{
								print("<h3>Bass</h3>");
							}
							while($array = $result4->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query5 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='harp'";
						$result5 = $mysqli->query($query5);
						if($result5)
						{
							if($result5->num_rows > 0)
							{
								print("<h3>Harp</h3>");
							}
							while($array = $result5->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query6 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='flute'";
						$result6 = $mysqli->query($query6);
						if($result6)
						{
							if($result6->num_rows > 0)
							{
								print("<h3>Flute</h3>");
							}
							while($array = $result6->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query7 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='oboe'";
						$result7 = $mysqli->query($query7);
						if($result7)
						{
							if($result7->num_rows > 0)
							{
								print("<h3>Oboe</h3>");
							}
							while($array = $result7->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query8 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='clarinet'";
						$result8 = $mysqli->query($query8);
						if($result8)
						{
							if($result8->num_rows > 0)
							{
								print("<h3>Clarinet</h3>");
							}
							while($array = $result1->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query9 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='bassoon'";
						$result9 = $mysqli->query($query9);
						if($result9)
						{
							if($result9->num_rows > 0)
							{
								print("<h3>Bassoon</h3>");
							}
							while($array = $result9->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query10 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='horn'";
						$result10 = $mysqli->query($query10);
						if($result10)
						{
							if($result10->num_rows > 0)
							{
								print("<h3>Horn</h3>");
							}
							while($array = $result10->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query11 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='trumpet'";
						$result11 = $mysqli->query($query11);
						if($result11)
						{
							if($result11->num_rows > 0)
							{
								print("<h3>Trumpet</h3>");
							}
							while($array = $result11->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query12 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='trombone'";
						$result12 = $mysqli->query($query12);
						if($result12)
						{
							if($result12->num_rows > 0)
							{
								print("<h3>Trombone</h3>");
							}
							while($array = $result12->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query13 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='tuba'";
						$result13 = $mysqli->query($query13);
						if($result2)
						{
							if($result13->num_rows > 0)
							{
								print("<h3>Tuba</h3>");
							}
							while($array = $result13->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query14 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='ypo' AND instrument='percussion'";
						$result14 = $mysqli->query($query14);
						if($result2)
						{
							if($result14->num_rows > 0)
							{
								print("<h3>Percussion</h3>");
							}
							while($array = $result14->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						print("</div>");
						$mysqli->close();
					}
						
					$mysqli = new mysqli($host, $login, $password, $databaseName);
					if ( mysqli_connect_error() ) 
					{
						die("Can't connect to database ".$mysqli->error);
					}
					else
					{
						$result1 = $mysqli->query($query1);
						print("<div class=\"contentSection\">");
						print("<h2>Symphonette</h2>");
						print("<hr />");
						$query1 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='sym' AND instrument='violin'";
						$result1 = $mysqli->query($query1);
						if($result1)
						{
							if($result1->num_rows > 0)
							{
								print("<h3>Violin</h3>");
							}
							while($array = $result1->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query2 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='sym' AND instrument='viola'";
						$result2 = $mysqli->query($query2);
						if($result2)
						{
							if($result2->num_rows > 0)
							{
								print("<h3>Viola</h3>");
							}
							while($array = $result2->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query3 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='sym' AND instrument='cello'";
						$result3 = $mysqli->query($query3);
						if($result3)
						{
							if($result3->num_rows > 0)
							{
								print("<h3>Cello</h3>");
							}
							while($array = $result3->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						$query4 = "SELECT firstname, lastname FROM Login WHERE access='student' AND  orchestra='sym' AND instrument='bass'";
						$result4 = $mysqli->query($query4);
						if($result2)
						{
							if($result4->num_rows > 0)
							{
								print("<h3>Bass</h3>");
							}
							while($array = $result4->fetch_row())
							{
								
								print("<p>".$array[0]." ".$array[1]."</p>");
							}
							print("<br />");
						}
						print("</div>");
						$mysqli->close();
					}
				}
				else
				{
					print("<div class=\"content\"><div class=\"contentSection\">");
					print("<h3>You must be logged-in to view this page</h3>");
					print("</div></div>");
				}
			?>
        </div>
</body>
</html>