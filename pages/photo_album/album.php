<?php
	session_start();
	require("password.php");
	require("functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Albums</title>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="styles/navigation.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.8.11.custom.min.js"></script>
	</head>
	<body> 
<?php
	$page = "Albums";
	$aid = @mysql_real_escape_string($_GET['aid']);
	require("header.php");
	$mysqli = new mysqli($host, $login, $password, $databaseName);
	if (mysqli_connect_error()){
		die("Can't connect to database: ".$mysqli->error);
	}
	else{
		if(is_numeric($aid)){
			$query1 = "SELECT * FROM Photo NATURAL JOIN Sequence WHERE aid=$aid";
			$query2 = "SELECT atitle FROM Album WHERE aid = $aid";
		}else{
			die("Invalid Album Selected");
		}
?>
    <div class="main">
		<div class="noLeft">
<?php 
		$result1 = $mysqli->query($query1);
		$result2 = $mysqli->query($query2);
		$atitle = $result2->fetch_assoc();
		print("<h3>".$atitle['atitle']." Photo Gallery</h3>");
		if($result1){
			while($array = $result1->fetch_assoc()){
				$imgURL = "images/photos/".$array['filename'];
				$imgURL_tn = "images/thumbs/tn_".$array['filename'];
				print("<div class=\"photo\"><a href='".$imgURL."'><img src='".$imgURL_tn."' alt='".$imgURL_tn."'/></a></div>");
			}
		}
		$mysqli->close();
?>	
		</div>
	</div>

<?php
	}
?>
</body>
</html>

