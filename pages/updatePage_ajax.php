<?php
require("password.php");
require("functions.php");
$mysqli = new mysqli($host, $login, $password, $databaseName) or die("Can't connect to database");
$page = $_POST['page'];
$oldHeader = $_POST['oldHeader'];
$newHeader = $_POST['newHeader'];
$newContent = sanitize(htmlspecialchars_decode($_POST['newContent']));
$mysqli->query("UPDATE PageContent SET sectionContent = '".$newContent."' WHERE (page = '".$page."' AND sectionHeader = '".$oldHeader."')") or die ("$page \n $oldHeader \n $newContent");
echo "ok";
$mysqli->close();
?>