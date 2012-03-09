<div class="header">
	<img src="images/orchestra_left.png" width="160" height="129" alt="The Three Rivers Young Peoples Orchestra in Concert" />
    <a href="index.php"><img class="header" src="images/trypo_logo.jpg" alt="TRYPO Logo" /></a>
	<img src="images/orchestra_right.png" width="163" height="129" alt="The Three Rivers Young Peoples Orchestra in Concert" />
	 <!--navbar-->
	 <?php
	$guestNavigationArray = array("Home" => "index.php", "About Us" => "aboutUs.php", "Auditions" => "auditions.php", "Upcoming Events" => "upcomingEvents.php", "Media" => "media.php", "Support Trypo" => "supportTrypo.php", "Contact Us" => "contactUs.php");
	$memberNavigationArray = array("Your Profile" => "profile.php", "Members" => "members.php", "Calendar" => "calendar.php", 
	"Discussion Board" => "discussionBoard.php");
	print("\t<div id=\"nav_bar\"><ul id=\"navigation\">");
	foreach ($guestNavigationArray as $thepage => $url) {
		if($page == $thepage){
			print("<li id=\"currentPage\"><a href=\"$url\">$thepage</a></li>");
		}else{
			print("<li class=\"notCurrentPage\"><a href=\"$url\">$thepage</a></li>");
		}
	}
	if(isset($_SESSION["isMember"]) && $_SESSION["isMember"] == true){
		foreach($memberNavigationArray as $thepage =>$url){
			if($page == $thepage){
				print("<li id=\"currentPage\"><a href=\"$url\">$thepage</a></li>");
			}else{
				print("<li class=\"notCurrentPage\"><a href=\"$url\">$thepage</a></li>");
			}
		}
		if(isset($_SESSION["access"]) && $_SESSION["access"]=='admin'){
			if($page == 'Admin'){
				print("<li id=\"currentPage\"><a href='admin.php'>Admin</a></li>");
			}else{
				print("<li class=\"notCurrentPage\"><a href='admin.php'>Admin</a></li>");
			}
		}
	}
	print("</ul></div>");
	if(isset($_SESSION['firstname'])){
		$name = $_SESSION['firstname'];
		echo "<div id='welcome'><p><b>Welcome, $name</b></p></div>&nbsp;";
	?>
	<div id='logout'>
		<form action="ajax_login.php" method="post">
			<input type='submit' name='logout' value='Logout' id='logout'/>
		</form>
	</div>
	<?php
	}else{	
	?>
	<div id='welcome'>
		<p><b>Welcome to TRYPO</b></p>
	</div>&nbsp;
	<!-- Login Stuff -->
	<div id="member_login_box"><a href="#" id="sign_in">Member Login</a></div>
   	<!-- <div id="login_reponse"></div>-->
	<div id="login_box">
		<form id="login_form" action="" method="post">
			<table>
				<tr>
				<td><input name="email" type="text" id="email" value="Email"/></td>
				<td><input name="psw" type="password" id="psw" value="Password"/></td>
				<td><a href="forgotPassword.php" id="forgotPassword">Forgot Password?</a></td>
				<!--td id="login_response"></td>-->
				<td align="right"><input type="submit" id="login_button" name="submit" value="Login"/></td>
				</tr>
			</table>
		</form>
	</div>
	<?php
	}
	?>
</div>
