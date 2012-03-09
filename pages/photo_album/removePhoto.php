<?php
require('password.php');
$mysqli = new mysqli($host, $login, $password, $databaseName) or die("Can't connect to database");
if(isset($_POST['remove'])){
	$removepid=$_POST['pid'];
	$aid=$_POST['aid'];
	foreach($removepid as  $pid){
		$mysqli->query("DELETE FROM Sequence WHERE aid = $aid AND pid = $pid") or die ("Failed to delete photo");
		$mysqli->query("UPDATE Album SET dLModified = NOW() WHERE aid = $aid") or die ("Failed to update date last modified");
	}	
	header('Location: admin.php');
}
$mysqli->close();
?>