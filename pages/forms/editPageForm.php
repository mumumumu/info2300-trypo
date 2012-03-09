<div class="contentSection">
<h3>Edit a page</h3>
<hr />
<form method='post' style='display:inline;'>
	<select name='page'>
		<option value=''>----</option>
		<?php
			require('password.php');
			$mysqli = new mysqli($host, $login, $password, $databaseName);
			$query = "SELECT * FROM PageContent GROUP BY page";
			$result=$mysqli->query($query);
			while($array = $result->fetch_assoc()){
				echo "<option value='".$array['page']."'>".$array['page']."</option>";
			}
		?>
	</select>
	<input name='editPage' value='Edit Page' type='submit'/>
</form><span id='editPageWarning'></span><br /><br /></div>