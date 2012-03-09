$(document).ready(function(){
	var leftHeight = $(".left").outerHeight();
	var rightHeight = $(".content").outerHeight();

	if (leftHeight == null && rightHeight == null) {
		$(".main").css({"height":"100%"});
	}
	else {
		var max = (leftHeight > rightHeight)?leftHeight:rightHeight;
		$(".main").css({"height": max + "px"});
	}
});

$(document).ready(function() {	
	/* Begin Login Stuff */
	$('#login_box').hide();
	$('#email').blur(function(){
		if($('#email').val()=='') $('#email').val('Email');
	});
	$('#email').focus(function(){
		if($('#email').val()=='Email') $('#email').val('');
	});
	$('#psw').blur(function(){
		if($('#psw').val()=='') $('#psw').val('Password');
	});
	$('#psw').focus(function(){
		if($('#psw').val()=='Password') $('#psw').val('');
	});
	$('#sign_in').click(function(){
		$('#sign_in').hide('slide',{direction:'right'}, function(){
			$('#login_box').show('slide',{direction:'right'});
		});
	});
	$('#login_button').click(function(){
		//$("#login_response").text('Validating....');
		/*$('#login_box').hide('slide',{direction:'right'}, function(){
			$('#login_response').fadeIn(1000);
		});*/
		$.post(
			'ajax_login.php',
			{email:$('#email').val(),psw:$('#psw').val()},
			function(data){
				if(data=='yes'){
					document.location='index.php';
				}else{
					alert('Email or Password are incorrect.');
					//$('#login_response').html('NO LOGIN FOR YOU');
				}
			}
		);
	return false;
	});
	$("#login_box").click(function(){
		return false;
	});
	$(document).click(function(){
		if($('#sign_in').is(":hidden")){
			$('#login_box').hide('slide',{direction:'right'}, function(){
				$('#sign_in').show('slide',{direction:'right'});
			});
		}
	});
	$("#forgotPassword").click(function(){
		location.href=$(this).attr("href");
	});
	/* End Login Stuff */
	
	/* Begin Admin Panel Stuff */
	$('.change').click(function(){
		var page = $(this).parent().attr("name")
		var oldHeader = $(this).parent().find(".oldheader").attr("name");
		var newHeader = $(this).parent().find(".oldheader").html();
		var newContent = $(this).parent().find(".oldcontent").html()
		$.post(
			'updatePage_ajax.php',
			{page:page,oldHeader:oldHeader,newHeader:newHeader,newContent:newContent},
			function(data){
				if(data=='ok'){
					alert('Update Successful');
				}else{
					alert('Update Failed');
				}
			}
		);
	});
	/* End Admin Panel Stuff */
});

function uploadComplete(status){
   //set the status message to that returned by the server
   document.getElementById('status').innerHTML=status;
}

function orchestraSelection(node){
	var orchestra = node.value;
	
	if (orchestra != ""){
		if(orchestra == "ypo"){
			var instr = new Array("Choose Instrument", "Violin", "Viola", "Cello", "Bass", "Harp", "Flute", "Oboe", "Clarinet", "Bassoon", "Horn", "Trumpet", "Trombone", "Tuba", "Percussion");
		}else if(orchestra == "sym"){
			var instr = new Array("Choose Instrument", "Violin", "Viola", "Cello", "Bass");
		}
		var i = 0;
		var options;
		for(i = 0; i < instr.length; i++) {
			options += "<option id=\"" + instr[i] + "\" value=\"" + instr[i] + "\">" + instr[i] + "</option>";
		}
		$("#instruments").html(options);
	}else{
		$("#instruments").html("");
	}
}

function displayRequirements() {
	var sym = document.getElementById("sym");
	var ypo = document.getElementById("ypo");
	
	var warning = document.getElementById("warning");
	warning.innerHTML = "";
	
	var auditionRequirements = document.getElementById("auditionRequirements");
	auditionRequirements.innerHTML = "";
	
	var selected = document.getElementById("instruments").value;
	
	if(!sym.checked && !ypo.checked) {
		warning.innerHTML = "<p>Please choose one of the orchestras for further options.</p>";
		return;
	}
	else if(document.getElementById("Choose Instrument").selected) {
		warning.innerHTML = "<p>Please select an instrument.</p>";
		return;
	}
	else {
		if(sym.checked) {
			if(document.getElementById("Choose Instrument").selected) {
				warning.innerHTML = "<p>You must select an instrument</p>";
			}else if(document.getElementById("Violin").selected) {
				auditionRequirements.innerHTML="<h3>Violin - Symphonette</h3><ul><li>The following scales in 2 octaves: C, G, D, F, B major</li><li>Any shifting etude showing familiarity with positions 1 through 4, such as Kayser, Wohlfahrt or Sitt</li><li>Concerto of your choice, such as Seitz #2 or #5, or pieces of similar difficulty - (not the Vivaldi Concerto in A minor)</li></ul>";
			}else if(document.getElementById("Viola").selected) {
				auditionRequirements.innerHTML="<h3>Viola - Symphonette</h3><ul><li>The following scales in 2 octaves: C, G, D, F, B major</li><li>Any etude such as Wohlfahrt, Op. 45, Vol. 1, or equivalent</li><li>Solo piece of your choice which includes 1st and 3rd positions</li></ul>";
			}else if(document.getElementById("Cello").selected) {
				auditionRequirements.innerHTML="<h3>Cello - Symphonette</h3><ul><li>The following scales in 2 octaves: C, G, D, F, B major</li><li>Any etude of your choice</li><li>A solo piece of your choice that includes 1st and 4th positions</li></ul>";
			}else if(document.getElementById("Bass").selected) {
				auditionRequirements.innerHTML="<h3>Bass - Symphonette</h3><ul><li>C, F, G major scales in one octave</li><li>Any etude of your choice</li><li>A solo piece of your choice</li></ul>";
			}else {
				warning.innerHTML = "<p>There was an error, please refresh the page and try again</p>";
				auditionRequirements.innerHTML = "";
			}
		}else if(ypo.checked) {
			if(document.getElementById("Choose Instrument").selected) {
				warning.innerHTML = "<p>You must select an instrument.</p>";
			}else if(document.getElementById("Violin").selected) {
				auditionRequirements.innerHTML = "<h3>Violin - Young People\'s Orchestra</h3><ul><li>G major scale in 3 octaves - 4 notes to a bow</li><li>Solo piece such as Accolay Concerto, Bach Concerto in a minor, Nardini Concerto in e minor, Haydn Concerto in G major or any piece of equal or greater difficulty</li><li><a href=\"auditionExcerpts/ypgviolin1.pdf\">Mozart, Symphony in D major KV 297, V1n I, 1st movement, from the beginning to bar 51</a></li></ul>";
			}else if(document.getElementById("Viola").selected) {
				auditionRequirements.innerHTML = "<h3>Viola - Young People\'s Orchestra</h3><ul><li>Scales of your choice in 3 octaves - 4 notes to a bow</li><li>Telemann Concerto or any piece of similar difficulty that has two contrasting movements - one slow and one fast tempo</li><li>Have studied 60 Studies - Wohlfahrt, Op.45, Vol. 1, Kayser or equivalent studies</li></ul>";
			}else if(document.getElementById("Cello").selected) {
				auditionRequirements.innerHTML = "<h3>Cello - Young People\'s Orchestra</h3><ul><li>Major or melodic minor scale of your choice in 3 octaves</li><li>A solo piece of your choice that includes tenor clef</li><li><a href=\"auditionExcerpts/ypgcello1.pdf\">Beethoven Symphony No. 5, the beginning of the 3rd movement</a></li><li><a href=\"auditionExcerpts/ypgcello2.pdf\">Mendelssohn's \"Scherzo\" from Midsummer Night's Dream</a></li></ul>";
			}else if(document.getElementById("Bass").selected) {
				auditionRequirements.innerHTML = "<h3>Bass - Young People\'s Orchestra</h3><ul><li>One or two octaves of any of the following scales: F, G, B, C, A</li><li>An etude or solo piece of your choice</li><li><a href=\"auditionExcepts/ypgbass1\">Beethoven Symphony No. 5, beginning of 3rd movement</li></ul>";
			}else if(document.getElementById("Harp").selected) {
				auditionRequirements.innerHTML = "<h3>Harp - Young People\'s Orchestra</h3><ul><li>a prepared solo from standard repertoire, appropriate for your proficiency level</li><li>An etude of your choice</li></ul>";
			}else if(document.getElementById("Flute").selected) {
				auditionRequirements.innerHTML = "<h3>Flute - Young People\'s Orchestra</h3><ul><li>All major scales in 2 octaves</li><li>An etude from Andersen, Op. 21, or a caprice by Theobald Boehm</li><li>2 movements of a Mozart Concerto or a piece of comparable difficulty</li></ul>";
			}else if(document.getElementById("Oboe").selected) {
				auditionRequirements.innerHTML = "<h3>Oboe - Young People\'s Orchestra</h3><ul><li>Major scales through 4 sharps and 4 flats</li><li>Handel or Marcello Sonata - 2 contrasting movements, or a piece of equal or greater difficulty</li><li>Be able to play long tones from pianissimo to fortissimo back to pianissimo</li></ul>";
			}else if(document.getElementById("Clarinet").selected) {
				auditionRequirements.innerHTML = "<h3>Clarinet - Young People\'s Orchestra</h3><ul><li>Chromatic scale from low E to high E and back, slurred and staccato</li><li>One etude from Rose 32 Etudes or Melodious and Progressive Etudes by David Hite (Southern Music, pub)</li><li>Concertino by Weber or \"Adagio and Tartella\" by Ernesto Cavallini, or a piece of equal or greater difficulty</li></ul>";
			}else if(document.getElementById("Bassoon").selected) {
				auditionRequirements.innerHTML = "<h3>Bassoon - Young People\'s Orchestra</h3><ul><li>Major scales through 4 sharps and 4 flats</li><li>Choose one of the 50 Advanced Studies from Weisenborn Practical Method for the Bassoon</li><li>Solo piece of your choice</li></ul>";
			}else if(document.getElementById("Horn").selected) {
				auditionRequirements.innerHTML = "<h3>Horn - Young People\'s Orchestra</h3><ul><li>Major and minor scales through 3 sharps and 3 flats</li><li>Mozart Horn Concerto No. 3, 1st movement (only the exposition), Kopprasch Book 1, exercise No. 15</li></ul>";
			}else if(document.getElementById("Trumpet").selected) {
				auditionRequirements.innerHTML = "<h3>Trumpet - Young People\'s Orchestra</h3><ul><li>Major and minor scales through 3 sharps and 3 flats</li><li>\"Aria and Rondo\" by Fioco</li></ul>";
			}else if(document.getElementById("Trombone").selected) {
				auditionRequirements.innerHTML = "<h3>Trumpet - Young People\'s Orchestra</h3><ul><li>Major and minor scales through 3 sharps and 3 flats</li><li>\"Morceau Symphonique\" by Guilmant</li></ul>";
			}else if(document.getElementById("Tuba").selected) {
				auditionRequirements.innerHTML = "<h3>Tuba - Young People\'s Orchestra</h3><ul><li>Major and minor scales through 3 sharps and 3 flats</li><li>\"Larghetto and Allegro\" by Handel/Little (Belwin Mills)</li></ul>";
			}else if(document.getElementById("Percussion").selected) {
				auditionRequirements.innerHTML = "<h3>Percussion - Young People\'s Orchestra</h3><ul><li>An etude of your choice on snare, timpani or mallets</li><li>Rudiments and sight reading</li><li><em>Bring your own sticks</em></li></ul>";
			}else {
				warning.innerHTML = "<p>There was an error, please refresh the page and try again.</p>";
				auditionRequirements.innerHTML = "";
			}
		}else {
			warning.innerHTML = "<p>There was an error, please refresh the page and try again.</p>";
			auditionRequirements.innerHTML = "";
		}
		$(document).ready(function(){
			var leftHeight = $(".left").outerHeight();
			var rightHeight = $(".content").outerHeight();

			var max = (leftHeight > rightHeight)?leftHeight:rightHeight;
			$(".main").css({"height": max + "px"});
		});
	}
}

$(function() {
	$( "#accordion" ).accordion({collapsible:true});
});

$(function(){
	$( "#draggable" ).draggable();
});

function checkPassword(pwd) {
	if (pwd.length == 0) {
		message("Please begin entering a new password to change it.", "#0000FF");
	} else if (pwd.length < 8) {
		message("Weak. Minimum of 8 characters.", "#FF0000");
	} else {
		var kinds = 0;
		var patterns = ["[0-9]", "[A-Z]", "[a-z]", "[^0-9-A-Za-z]"];
		for ( var index in patterns ) {
			kinds += (pwd.search(patterns[index]) != -1 ? 1 : 0);
		}
		if ( kinds < 3 ) {
			message("Moderate. Must contain at least 3 kinds of characters (uppercase, lowercase, numbers, symbols)", "#FF6600");
		} else {
			message("OK. Password matches all requirements.", "#00AA00");
		}
	}
}

function message(txt, color) {
	var warn = document.getElementById("passwordStrength");
	warn.innerHTML = txt;
	warn.style.color = color;
}
