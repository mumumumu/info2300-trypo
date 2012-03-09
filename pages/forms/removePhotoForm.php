<form id="uploadform" method="post" action="removePhoto.php">
	<input type="hidden" name="aid" value="<?php echo $aid ?>"/>
	<input type="submit" name="remove" value="Remove Marked Photos" style='display:block;'/>	
<?php
	printAdminPhotos($aid,$mysqli);
?>
</form>