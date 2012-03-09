<?php
	session_start();		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Auditions</title>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="styles/navigation.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.8.11.custom.min.js"></script>
	</head>
	<body>
		<?php
			$page = "Auditions";
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
					$query1 = "SELECT sectionHeader, sectionContent FROM PageContent WHERE page='Auditions'";
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
					}
				

	$mysqli->close();
	}?>
	<div class="contentSection">
		<br />
		<h2>Audition Requirements</h2>
		<hr />
		<br />
		<form id="controlForm" class="controls" action="indexAns.php" method="post" onsubmit="return false;">
			<div><input type="radio" name="orchestra" value="sym" id="sym" onclick="orchestraSelection(this)"/> Symphonette (Ages 10-15)</div>
			<div><input type="radio" name="orchestra" value="ypo" id="ypo" onclick="orchestraSelection(this)" /> Young Persons Orchestra (Ages 14-18)</div>
			<div><select id="instruments">
				<option id="choose" value="choose">No Orchestra Selected</option>
			</select>
			<input type="button" onclick="displayRequirements()" value="Display Audition Requirements" /></div>
		</form>
	<br />
	<div id="warning"></div>
	<br /><br />
	<div id="auditionRequirements"></div>
    </div></div></div>
</body>
</html>