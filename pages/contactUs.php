<?php
	session_start();		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Contact Us</title>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="styles/navigation.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.8.11.custom.min.js"></script>
	</head>
	<body>
		<?php
			$page = "Contact Us";
			require("header.php");
			
			$name = "";
			$email = "";
			$comment = "";
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
					$query1 = "SELECT sectionHeader, sectionContent FROM PageContent WHERE page='Contact Us'";
					$result1 = $mysqli->query($query1);
					if($result1)
					{
						while($array = $result1->fetch_row())
						{
							print("<div class=\"contentSection\">");
							print("<h2>".$array[0]."</h2>");
							print("<hr />");
							print("<p>".$array[1]."</p>");
							print("</div>");
						}
					}
					
					$mysqli->close();
				}
				
				if (isset($_POST['submit']))
				{ 
					$successfulSubmission = true;
					
					$name = $_POST["name"];
					$name = strip_tags($name);
					$email = $_POST["email"];
					$email = strip_tags($email);
					$comment = $_POST["comment"];
					$comment = strip_tags($comment);
					
					if(!isset($name) || strlen($name) == 0)
					{
						$successfulSubmission = false;
						print("\t<p>Please include your name</p>");
					}
					if(!isset($email) || strlen($email) == 0)
					{
						$successfulSubmission = false;
						print("\t<p>Please include your email address. It will not be shared or put on any newsletter list, we only ask that you include your email so I can respond to your questions if necessary</p>");
					}
					if(!isset($comment) || strlen($comment) == 0)
					{
						$successfulSubmission = false;
						print("\t<p>Please include a comment</p>");
					}
					
					if($successfulSubmission)
					{
						$message = "Name: $name\nEmail: $email\n
						Comment:\n$comment"; 
						$message = wordwrap($message, 70);
						mail("cfsyanks6292@gmail.com", "Contact Form From INFO 2300 Project 3 Site", $message); 
						print("<p>$name, your message was sent successfully</p></div>");
					}
					else
					{
						require("contactUsForm.php");
						print("</div>");
					}
				}
				else
				{
					require("contactUsForm.php");
					print("</div>");
				}
			?>
			
        </div>
</body>
</html>