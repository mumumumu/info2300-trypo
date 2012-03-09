<?php
	session_start();		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Support TRYPO</title>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="styles/navigation.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.8.11.custom.min.js"></script>
	</head>
	<body>
		<?php
			$page = "Support Trypo";
			require("header.php");
		?>
        <div class="main">
        	<?php 
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
					$query1 = "SELECT sectionHeader, sectionContent FROM PageContent WHERE page='Support Trypo'";
					$result1 = $mysqli->query($query1);
					if($result1)
					{
						while($array = $result1->fetch_row())
						{
							print("<div class=\"contentSection\">");
							print("<h2>".$array[0]."</h2>");
							print("<hr />");
							print($array[1]);
							print("<br />");
							print("</div>");
						}
						print("<a href='http://pittsburghgives.guidestar.org/NonprofitProfile.aspx?OrgId=3253' target='_blank'><img src='images/donate.jpg' width='200' height='100' alt='Donate!' /></a>");
					}
					print("</div>");
					$mysqli->close();
				}
			?>
			
			
        </div>
</body>
</html>