<div class="contentSection">
<h2>Contact Us</h2>
<br />
<h3>If you have any questions, have concerns, or would like to inform us of anything please let us know below:</h3>
<br />
<form method="post" action="contactUs.php">
		<div class="field_container"><label>Name</label><input type="text" name="name" value="<?php print($name); ?>" /></div>
		<div class="field_container"><label>Email</label><input type="text" name="email" value="<?php print($email); ?>" /></div>
      
		<div class="field_container">Any other questions, concerns, or comments:</div>
		<p><textarea name="comment" rows="10" cols="50"><?php print($comment); ?></textarea></p>
		<div class="button_container"><input type="submit" name="submit" value="Send"/></div>
</form>
	<br /><br /><br />
	<p><em>Mailing Address:</em><br />Three Rivers Young Peoples Orchestras<br />212 Ninth Street<br />Pittsburgh, PA 15222</p><br />
	<p><em>Phone:</em> (412) 391-0526</p>
	<p><em>Fax:</em> (412) 391-0527</p><br />
	<p><em>Office Hours:</em> 10 a.m. to 5:30 p.m. Monday-Friday</p>
	
</div>