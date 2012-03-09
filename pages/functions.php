<?php	

	function printAlbums($mysqli){
		$query = "SELECT * FROM Album";
		$result = $mysqli->query($query); 
		if ($result && $result->num_rows > 0) {
			while($array = $result->fetch_assoc() ){
				$coverID = $array['coverPhoto'];
				if($coverID == NULL){
					$imgURL = "images/acover/nocover.jpg";
				}else{
					$url = $mysqli->query("SELECT filename FROM Photo WHERE pid=$coverID");
					$url = $url->fetch_assoc();
					$imgURL = "images/acover/ac_".$url['filename'];
				}
				echo "
					<br />
					<div class='albumCover'>
						<p><b>".$array['atitle']."</b></p>
						<a href='album.php?aid=".$array['aid']."'> 
							<img src='".$imgURL."' width='400' height='275' alt='".$array['atitle']."'/>
						</a>
					</div>";
			}
		}
	}
	
	function printAlbumPhotos($aid, $mysqli){
		$query = "SELECT * FROM Photo";
		$result = $mysqli->query($query);
		if($result && $result->num_rows>0){
			while($array = $result->fetch_assoc()){
				$imgURL = "images/thumns/tn_".$array['filename'];
				echo "
					<div class='photo'>
						<a href='".$imgURL."'></a>
					</div>";
			}
		}
	}

	function printAdminPhotos($aid, $mysqli){
		$query = "SELECT * FROM Photo NATURAL JOIN Sequence WHERE aid = $aid";
		$result = $mysqli->query($query);
		if($result && $result->num_rows>0){
			while($array = $result->fetch_assoc()){
				$imgURL = "images/thumbs/tn_".$array['filename'];
				echo "
					<div class='photo'>
						<a href='".$imgURL."' rel='lightbox[$aid]'><img src='".$imgURL."' alt='".$imgURL."'></a>
						<br/><input type='checkbox' name='pid[]' value='".$array['pid']."' /> Remove from Album
					</div>";
			}
		}
	}
	
	function imageResize($img, $target) { 
		$dimensions = getimagesize($img);
		$width = $dimensions[0];
		$height = $dimensions[1];
		$array['oldWidth'] = $width;
		$array['oldHeight'] = $height;
		if ($width > $height) { 
			$percentage = ($target/$width); 
		} else { 
			$percentage = ($target/$height); 
		} 
		$width = round($width * $percentage); 
		$height = round($height * $percentage); 
		$array['newWidth']=$width;
		$array['newHeight']=$height;
		return $array; 
	} 

	function generateThumb($path,$extension,$name,$size){
		if($extension == 'jpg' || $extension == 'jpeg'){
			$src_img=imagecreatefromjpeg($path);
		}
		if($extension == 'png'){
			$src_img=imagecreatefrompng($path);
		}
		if($extension == 'gif'){
			$src_img=imagecreatefromgif($path);
		}
		$newDimension = imageResize($path,$size);
		$oldWidth = $newDimension['oldWidth'];
		$oldHeight = $newDimension['oldHeight'];
		$newWidth = $newDimension['newWidth'];
		$newHeight = $newDimension['newHeight'];
		$dst_img=ImageCreateTrueColor($newWidth,$newHeight);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$newWidth,$newHeight,$oldWidth,$oldHeight); 
		if($extension == 'jpg' || $extension == 'jpeg'){
			imagejpeg($dst_img,$name);
		}
		if($extension == 'png'){
			imagepng($dst_img,$name);
		}
		if($extension == 'gif'){
			imagejgif($dst_img,$name);
		}
	}
	
	function check($varname,$destination,$message){
		if(!isset($_POST[$varname])){
			header("Location: $destination");
		}elseif(empty($_POST[$varname])){
			echo "$message";
		}else{
			return $_POST[$varname];
		}
	}
	
	function sanitize($data){
		$data = trim($data);
		$data = mysql_real_escape_string($data);
		return $data;
	}
?>
