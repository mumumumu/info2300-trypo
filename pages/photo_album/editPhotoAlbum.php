<div class="contentSection">
<h3>Edit an Album</h3>
<hr/>
<form method='post' style='display:inline;'>
	<select name='album'>
			<option value=''>----</option>			
<?php 
	require('password.php');
	$mysqli = new mysqli($host, $login, $password, $databaseName);
	if ( mysqli_connect_error()){
		die("Can't connect to database: ".$mysqli->error);
	}else{
		$query = "SELECT * FROM Album";
		$result = $mysqli->query($query);				
		if($result && $result->num_rows>0){		
			while($array = $result->fetch_assoc()){
				print("<option value='".$array['aid']."'>".$array['atitle']."</option>");
			}
		}
	}
?>
	</select>	
	<input type='submit' name='editAlbum' value='Edit Album'/>	
	
</form>