<?php 
	session_start();
	$_SESSION['question'] = '';
	$_SESSION['email'] = '';
	include 'password.php'; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="styles/navigation.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.8.11.custom.min.js"></script>
<title>Forgot Your Password</title>
</head>

<body>
	
	<?php
			$page = "Forgot Password";
			require("header.php");
		?>
	<div class="main">
	<?php
		require("leftBoxes.php")
	?>
		<div class="content"><div class="contentSection">
			<h1>Forgot Your Password?</h1>
			<form id="forgotPassword" action="forgotPassword.php" method="post">
				<div class="field_container"><label>Reconfirm Email</label><input type="text" id="email" name="email" /></div>
				<div class="button_container"><input type="submit" id="submit" name="submit" value="Submit" /></div>
			</form></div></div>
	
	<?php //require("password.php"); 
		// Check that the email exists in database
		if (isset($_POST['submit'])) {
			if (empty($_POST['email'])) {
				echo("Please enter your email address.");
			}
			else {
				$mysqli = new mysqli($host, $login, $password, $databaseName);
				if (mysqli_connect_error()) {
					die("Can't connect to database: " . $mysqli->error);
				}
				else {
					// Clean up and validate the email address
					$email = mysql_real_escape_string(strip_tags(htmlentities($_POST['email'])));
					
					$query = "SELECT * FROM Login WHERE email='$email'";
					$result = $mysqli->query($query);
					
					if ($result->num_rows == 1) 
					{
						$password = substr(md5(rand().rand()), 0, 10);
						$hasedpassword = hash('sha256',$password);
						
						$query1 = "UPDATE Login SET password = '".$hasedpassword."' WHERE email = '".$email."'";
						$result1 = $mysqli->query($query1);
						if($result1)
						{
							$message = "your new password has been set as ".$password.". Please sign-in with this password, then go to the profile page to change your password.";
							mail($email, "Your new temporary password from TRYPO.org", $message); 						
							print("check your email for your new temporarily assigned password. The email can take up to 5 minutes to send.");
						}
					}
					else {
						echo("Sorry, your email address was not found. Please try again.");
					}
				}
				print("</div>");
				$mysqli->close();
			}
		}					
	?>
	</div>
</body>

</html>