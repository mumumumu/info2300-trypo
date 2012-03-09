<?php
	session_start();
	require("password.php");
	require("functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Admin</title>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="styles/navigation.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.8.11.custom.min.js"></script>
	</head>
	<body>
<?php
	$page = "Admin";
	require("header.php");
?>
	<div class="main"><div class="noLeft">
		
<?php 
if(isset($_SESSION['access']) && $_SESSION['access']=='admin'){
	if(isset($_POST['editPage'])){
		if(isset($_POST['page']) && $_POST['page'] != ' '){
			include("editPageForm.php");
			$page = $_POST['page'];
			$mysqli = new mysqli($host, $login, $password, $databaseName) or die("Can't connect to database");
			$result=$mysqli->query("SELECT * FROM PageContent WHERE page='".$page."'");
			if($result && $result->num_rows>0){
				while($array = $result->fetch_assoc()){
					$sectionHeader = htmlentities($array['sectionHeader']);
					$sectionContent = htmlentities($array['sectionContent']);
					print("<div class='newContents' contentEditable=true>");
					print("<div name='".$page."' class='contentSection'>");
					print("<h2 name='".$sectionHeader."' class='oldheader'>".$sectionHeader."</h2>");
					print("<hr />");
					print("<p name='".$sectionContent."' class='oldcontent'>".$sectionContent."</p>");
					print("<br/>");
					print("<input type='submit' class='change' value='Save Changes'/>");
					print("</div>");
					print("</div>");
				}
			}
			$mysqli->close();
			include("addUserForm.php");
			include("editPhotoAlbum.php");
		}
	}else if(isset($_POST['addUser'])){
		$successfulSubmission = true;
		if(isset($_POST['firstName']) && $_POST['firstName'] != ""){
			$firstname = strip_tags($_POST['firstName']);
		}else{
			$successfulSubmission = false;
		}
		if(isset($_POST['lastName']) && $_POST['lastName'] != ""){
			$lastname = strip_tags($_POST['lastName']);
		}else{
			$successfulSubmission = false;
		}
		if(isset($_POST['email'] ) && $_POST['lastName'] != ""){
			$email = strip_tags($_POST['email']);
		}else{
			$successfulSubmission = false;
		}
		if(isset($_POST['instruments']) && $_POST['instruments'] != " "){
			$instrument = $_POST['instruments'];
		}else{
			$successfulSubmission = false;
		}		
		if($successfulSubmission){
			$orchestra = $_POST['orchestra'];
			$password = substr(md5(rand().rand()), 0, 10);
			$hashedpassword = hash('sha256',$password);
			include("password.php");
			$mysqli = new mysqli($host, $login, $password, $databaseName);
			if ( mysqli_connect_error()){
				die("Can't connect to database: ".$mysqli->error);
			}else{
				$query2 = "INSERT INTO  Login (email, password, firstname, lastname, access, instrument, orchestra) VALUES ('".$email."', '".$hashedpassword."', '".$firstname."', '".$lastname."', 'student', '".$instrument."', '".$orchestra."')";
				$result2 = $mysqli->query($query2);
				if($result2){
					print("<div class=\"contentSection\"><h3>User was added successfully</h3></div>");
				}
				$mysqli->close();
			}
		}else{
			include("editPageForm.php");
			include("addUserForm.php");
			include("editPhotoAlbum.php");
		}
	}else if(isset($_POST['editAlbum']) && $_POST['album']!=""){
		include("editPageForm.php");
		include("addUserForm.php");
		include("editPhotoAlbum.php");
		$aid = $_POST['album'];
		include("uploadPhotoForm.php");
		include("removePhotoForm.php");
	}else{
		include("editPageForm.php");
		include("addUserForm.php");
		include("editPhotoAlbum.php");
	}
}
	else{
	print("<h3>you must be logged in as a web administrator to view this page</h3>");}
?>
    </div></div>
</body>
</html>