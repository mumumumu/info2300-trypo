<?php
session_start();
include('functions.php');
include('password.php');
if(isset($_POST['logout'])){
	session_destroy();
	session_unset();
	header('Location: index.php');
}else{
	$email=sanitize($_POST['email']);
	$hashPass=hash('sha256', sanitize($_POST['psw']));
	$mysqli = new mysqli($host, $login, $password, $databaseName);
	if(mysqli_connect_error()){
		die("Can't connect to server");
	}else{
		$query = sprintf("SELECT * FROM Login WHERE email = '%s' AND password = '%s'",$email,$hashPass);
		$result=$mysqli->query($query);
		$array = $result->fetch_assoc();
		if($result && $result->num_rows==1){
			echo "yes";
			$_SESSION['firstname'] = $array['firstname'];
			$_SESSION['access'] = $array['access'];
			$_SESSION['email'] = $array['email'];
			$_SESSION['isMember'] = true;
		}else{
			echo "no";
		}
	}
	$mysqli->close();
}
?>