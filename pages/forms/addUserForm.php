<html>
<head>
<script type="text/javascript" src="script.js"></script>
</head>
<body>
<div class="contentSection">
<h3>Add a New Student</h3>
<hr />
<form action="admin.php" method="post" enctype="multipart/form-data" id='user'>
	<div class="field_container"><label for='firstName'>First name: </label><input type='text' name='firstName'/></div>
	<div class="field_container"><label for='lastName'>Last name: </label><input type='text' name='lastName'/></div>
	<div class="field_container"><label for='email'>Email: </label><input type='text' name='email'/></div>
	
	<label for='orchestra'>Orchestra: </label>
	<input type="radio" name="orchestra" value="sym" id="sym" onclick="orchestraSelection(this)"/> Symphonette (Ages 10-15)&nbsp;&nbsp;&nbsp;
    <input type="radio" name="orchestra" value="ypo" id="ypo" onclick="orchestraSelection(this)" /> Young Persons Orchestra (Ages 14-18)<br />
	
	<select id='instruments' name='instruments'>
		<option value=" ">Choose Instrument</option>
		<span id='instrumentDropDown'></span>
	</select>
	
	<br /><br />
	<input name='addUser' value='Add User' type='submit' />
</form><span id='addUserWarning'></span><br /><br /></div>
</body>
</html>