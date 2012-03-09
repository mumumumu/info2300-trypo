<script type="text/javascript">
/*Script Source: http://www.devrecipes.com/2009/07/13/ajax-style-file-upload-without-page-refresh/*/
function initUpload() {
   /*set the target of the form to the iframe and display the status
      message on form submit.
  */
	document.getElementById('uploadform').onsubmit=function() {
	document.getElementById('uploadform').target = 'target_iframe';
    document.getElementById('status').style.display="block"; 

	}
}

//This function will be called when the upload completes.
function uploadComplete(status){
   //set the status message to that returned by the server
   document.getElementById('status').innerHTML=status;
}

window.onload=initUpload;
</script>

<form id="uploadform" method="post" enctype="multipart/form-data" action="addPhoto.php">
<p>Add a photo to the album</p>
<input type="hidden" name="aid" value=<?php echo "$aid";?> />
<input name="image" id="file" size="27" type="file" /><br />
<input type="submit" name="action" value="Upload" />
<span id="status" style="display:none">uploading...</span>
<iframe id="target_iframe" name="target_iframe" src="" style="width:0;height:0;border:0px"></iframe>

</form>

