<?php
	session_start();		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Profile</title>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="styles/navigation.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.8.11.custom.min.js"></script>
	</head>
	
	<body>
		<?php
			$page = "Your Profile";
			require("header.php");
		?>
        <div class="main">
        	<?php 
				if(!isset($_SESSION['isMember']) || $_SESSION['isMember'] == false) {
					print("<div class=\"content\"><div class=\"contentSection\">");
					print("<h3>You must be logged-in to view this page</h3>");
					print("</div></div>");
				}
				else {
					require("leftBoxes.php");
					include("password.php");
					$mysqli = new mysqli($host, $login, $password, $databaseName);
					if ( mysqli_connect_error() ) 
					{
						die("Can't connect to database: ".$mysqli->error);
					}
					else {
					$email = $_SESSION['email'];
					$query = "SELECT * FROM Login WHERE email='$email'";
					$result = $mysqli->query($query);
					
					if ($result && $result->num_rows == 1) {
						$array = $result->fetch_assoc();
						$fname = $array['firstname'];
						$lname = $array['lastname'];
						$orch  = $array['orchestra'];
						$instr = $array['instrument'];
						$currentPass = $array['password'];
					}
					if ($orch == "ypo") {
						$orch = "Young Peoples Orchestra";
					}
					else {
						$orch = "Symphonette";
					}
				}
				$mysqli->close();
			?>
				<div class="content">
					<div class="contentSection">
						<h2>Your Profile</h2>
						<hr />
						<br />
						<div class="field_container"><label>First Name:</label><?php echo($fname) ?></div>
						<div class="field_container"><label>Last Name:</label><?php echo($lname) ?></div>
						<div class="field_container"><label>Email:</label><?php echo($email) ?></div>
						<div class="field_container"><label>Orchestra:</label><?php echo($orch) ?></div>
						<div class="field_container"><label>Instrument:</label><?php echo($instr) ?></div>
						<br />
						<h3>Change Your Password?</h3>
						<form action="profile.php" method="post">
							<div class="field_container"><label>Current Password:</label><input type="password" id="password" name="password" /></div>
							<div class="field_container"><label>New Password:</label><input type="password" id="newPassword" name="newPassword" 
								 onkeyup="checkPassword(this.value)" /></div>
							<div class="field_container"><label>Confirm Password:</label><input type="password" id="confirmPassword" name="confirmPassword" /></div>
							<div class="button_container"><input type="submit" id="submit" name="submit" value="Change Password" /></div>
							<br />
							<div>Password Status: <span id="passwordStrength">Please begin entering a new password to change it.</span></div>
						</form>
					</div>
			
				<div id="warning" class="contentSection">
				<br />
				<?php
				if (isset($_POST['submit'])) {
					// Current password was not entered
					if (!isset($_POST['password']) || empty($_POST['password'])) {
						echo("<p>Please enter your current password.</p>");
					}
					// New password was not entered
					elseif (!isset($_POST['newPassword']) || empty($_POST['newPassword'])) {
						echo("<p>Please enter in a new password.</p>");
					}
					// Confirmation password was not entered
					elseif (!isset($_POST['confirmPassword']) || empty($_POST['confirmPassword'])) {
						echo("<p>Please confirm your password.</p>");
					}
					// Everything has been entered
					else {
						$hashpass = hash('sha256', $_POST['password']);
						
						// Password does not match the one in the database
						if ($hashpass != $currentPass) {
							echo("<p>Your current password was entered incorrectly. Please try again.</p>");
						}
						// Password matches
						else {
							// Check for how many kinds of characters in new password
							$kinds = 0;
							$array = array("[A-Z]", "[a-z]", "[0-9]", "[^A-Za-z0-9]");
							$newPwd = $_POST['newPassword'];
							foreach ($array as $i => $value) {
								if (preg_match("/$value/", $newPwd)) {
									$kinds++;
								}
							}
							// New password and confirmed password do not match
							if ($_POST['newPassword'] != $_POST['confirmPassword']) {
								echo("<p>Your new and confirmed passwords do not match. Please re-enter them.</p>");
							}
							// Password does not meet the requirements
							elseif (strlen($_POST['newPassword']) < 8) {
								echo("<p>Your new password is not long enough. It must be at least eight characters long. Please try again.</p>");
							}
							// Password does not contain enough kinds of characters
							elseif ($kinds < 3) {
								echo("<p>Your new password does not contain enough types of characters. You must have three ".
								"of the following: uppercase letters, lowercase letters, numbers, and/or symbols. Please try again.</p>");
							}
							// Hash the new password and put into the database
							else {
								$mysqli = new mysqli($host, $login, $password, $databaseName);
								if ( mysqli_connect_error() ) 
								{
									die("Can't connect to database: ".$mysqli->error);
								}
								else {
									$newHashPass = mysql_real_escape_string(hash('sha256', $_POST['newPassword']));
									$query = "UPDATE Login SET password='$newHashPass' WHERE email='$email'";
									$result = $mysqli->query($query);
					
									if ($result) {
										echo("<p>Thank you! Your password has been changed successfully.</p>");
									}
									else {
										echo("<p>Sorry, we were unable to update your password. Please try again.<p>");
									}
								}
							}
						}
					}
				}
				?>
				</div>
				<div class="contentSection">
					<br />
					<h3>Password Requirements</h3>
					<ol>
						<li>Minimum of 8 characters long</li>
						<li>Must contain at least three of the following types of characters:
							<ol>
								<li>Uppercase Letters</li>
								<li>Lowercase Letters</li>
								<li>Numbers</li>
								<li>Symbols</li>
							</ol>
						</li>
					</ol>	
				</div>
			</div>
				<?php
				}
				?>
		</div>
	</body>
	
</html>