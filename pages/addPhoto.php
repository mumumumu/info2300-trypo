<?php
require('password.php');
require('functions.php');
$MAX_SIZE=6500;
$file_id='image';
$aid=$_POST['aid'];
$status='';
$filename=$_FILES[$file_id]['name'];
$tmpfile=$_FILES[$file_id]['tmp_name'];
if(!$_FILES[$file_id]['name']){
	echo returnStatus("<h4>no file specfied</h4>");
}else{
	$mysqli = new mysqli($host, $login, $password, $databaseName) or die(returnStatus("Can't connect to database"));
	$path_info = pathinfo($_FILES['image']['name']);
	$extension = strtolower($path_info['extension']);
	$filename = htmlentities(sanitize($path_info['basename']));
	$dupe = $mysqli->query("SELECT * FROM Photo NATURAL JOIN Sequence WHERE filename = '$filename' AND aid = $aid") or die (returnStatus("Error querying photo database. 1")); 
	if($dupe->num_rows>0){
		echo returnStatus("<h4> Duplicate Entry Detected </h4>");
	}else{
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
			echo returnStatus("<h4>Unknown extension! <br/> This site only supports .jpg .gif .png</h4>");
		}else{
			$size=filesize($_FILES['image']['tmp_name']);
			if ($size > $MAX_SIZE*1024){
				echo returnStatus("<h4>You have exceeded the size limit!</h4>");
			}else{
				$target_path = "images/photos/".$filename;
				$dupe = $mysqli->query("SELECT * FROM Photo WHERE filename = '$filename'") or die (returnStatus("Error querying photo database. 2")); 		//check for server duplicate
				if($dupe->num_rows>0){
					$array = $dupe->fetch_assoc();
					$pid = $array['pid'];
					$mysqli->query("INSERT INTO Sequence(aid,pid,sequence) VALUES($aid,$pid,(SELECT IFNULL((SELECT MAX(sequence) FROM Sequence AS original WHERE aid=$aid)+1,1)))") or die (returnStatus("Error updating sequence $aid $pid"));	
					$mysqli->query("UPDATE Album SET dLModified = NOW()") or die (returnStatus("Error updating data last modified."));
					echo (returnStatus("<h4>Upload Successful</h4>"));
				}else{
					if(move_uploaded_file($_FILES['image']['tmp_name'],$target_path)){
						$mysqli->query("INSERT INTO Photo(filename) VALUES('$filename')") or die (returnStatus("Error adding photo"));
						$mysqli->query("INSERT INTO Sequence(aid,pid,sequence) 
								VALUES($aid,(SELECT pid FROM Photo WHERE filename = '$filename'),(SELECT IFNULL((SELECT MAX(sequence) FROM Sequence AS original WHERE aid=$aid)+1,1)))") or die (returnStatus("Error inserting photo into sequence"));	
						$thumb_path = "images/thumbs/tn_".$filename;
						generateThumb($target_path,$extension,$thumb_path,200);
						$acover_path = "images/acover/ac_".$filename;
						generateThumb($target_path,$extension,$acover_path,400);
						$mysqli->query("UPDATE Album SET dLModified = NOW()") or die (returnStatus("Error updating data last modified."));
						echo (returnStatus("<h4>Upload Successful</h4>"));
					}else{
						echo (returnStatus("<h4>There was an error uploading the file, please try again!</h4>"));
					}
				}
			}
		}
	}
}

function returnStatus($status){
	return "<html><body><script type='text/javascript'>function init(){if(top.uploadComplete) top.uploadComplete('".$status."');}window.onload=init;
</script></body></html>";
}

?>