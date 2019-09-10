<!DOCTYPE html>
<?php
	require_once("db.php");
	$option = $_POST['option'];
	$id = $_POST['id'];
	$pin = $_POST['pin'];
	
	if($option == "Retrieve"){
		
		$query = "SELECT * from forms where id='".$id."'";
		if(mysql_num_rows(mysql_query($query))!=0){
			$result = mysql_fetch_assoc(mysql_query($query));
			if($result['pin'] != $pin){
				echo "<b>Sorry you entered a wrong pin. Please go back and enter it again.</b><br /><br />";
				$result = "";	
			}
		}
		else{
			echo "<b>Sorry ID not present. It will create a new one. Go Ahead</b><br /><br />";	
		}
	}
	else if($option == "Create"){
		$query = "SELECT * from forms where id='".$id."'";
		if(mysql_num_rows(mysql_query($query))!=0){
			echo "<b>Sorry ID already taken. Please go back and enter a new ID. Thank you</b><br /><br />";
		}
	}
?>


<html>
<head>

<title>
USC Roski Faculty Activity Report
</title>

<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" content="Wufoo">
<meta name="robots" content="index, follow">

<!-- CSS -->
<link href="css/structure.css" rel="stylesheet">
<link href="css/form.css" rel="stylesheet">

<!-- JavaScript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="scripts/wufoo.js"></script>

<!--[if lt IE 10]>
<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body id="public">
<div id="container" class="ltr">

<h1 id="logo">
<a href="http://www.wufoo.com" title="Powered by Wufoo">Wufoo</a>
</h1>

<form id="form48" name="form48" class="wufoo topLabel page" accept-charset="UTF-8" autocomplete="off" enctype="multipart/form-data" method="post" 
      action="https://roski.wufoo.com/forms/r12mb2yd0gn9mef/#public">
  
<header id="header" class="info">
<h2>USC Roski Faculty Activity Report</h2>
<div>** Please save the form before submitting...</div>
<div><br />
Please fill out this form in its entirety. This includes sections 1-4. All sections may not apply but you will be evaluated only on the information you provide in this form. Your initials on page 4 confirms that your application is complete and all information is accurate.<br />
<br />
<b>This form is designed to be completed in one sitting. For those who would like to work on this in multiple chunks, please consider:</b><br />
<br />
 - Print each page out (Click on the "next" button at the bottom of each page)<br />
 - Type the answer (or just the lengthy answers) into a Word document<br />
 - Cut and paste those answers into the form when ready to complete<br />
<br />
<b>Due date: 3/3/2014</b></div>
</header>

<ul>
<li id="foli226" class="notranslate first section      ">
<section>
<h3 id="title226">
I. TEACHING AND STUDENT-CENTERED ACTIVITIES
</h3>
</section>
</li><li id="foli1" class="notranslate      ">
<label class="desc" id="title1" for="Field1">
Name
</label>
<span>
<input id="Field1" name="Field1" type="text" class="field text fn" value="<?php echo $result['Field1']; ?>" size="8" tabindex="1" />
<label for="Field1">First</label>
</span>
<span>
<input id="Field2" name="Field2" type="text" class="field text ln" value="<?php echo $result['Field2']; ?>" size="14" tabindex="2" />
<label for="Field2">Last</label>
</span>
</li>
<li id="foli37" class="notranslate      ">
<label class="desc" id="title37" for="Field37">
Rank<br />
</label>
<div>
<input id="Field37" name="Field37" type="text" class="field text large" value="<?php echo $result['Field37']; ?>" maxlength="255" tabindex="3" onkeyup="" />
</div>
</li><li id="foli3" class="notranslate       ">
<label class="desc" id="title3" for="Field3">
Period Covered: January 1 - December 31
</label>
<div>
<select id="Field3" name="Field3" class="field select medium" tabindex="4" > 
<option value="2013" selected="selected">
2013
</option>
</select>
</div>
</li>
<li id="foli4" class="notranslate       "  >
<label class="desc" id="title4" for="Field4">
Please upload a current copy of your resume.
</label>
<div>
<input id="Field4" name="Field4" type="file" class="field file" size="12" tabindex="5" />
</div>
</li><li id="foli5" class="notranslate section      ">
<section>
<h3 id="title5">
STUDENT-BASED ACTIVITIES
</h3>
</section>
</li>

<li id="foli20" class="notranslate section      ">
<section>
<h3 id="title20">
</h3>
<div id="instruct20">Courses Taught in Fall Semester</div>
</section>
</li><li id="foli25" class="notranslate      ">
<label class="desc" id="title25" for="Field25">
Course 1
</label>
<div>
<input id="Field25" name="Field25" type="text" class="field text large" value="<?php echo $result['Field25']; ?>" maxlength="255" tabindex="6" onkeyup="" />
</div>
</li><li id="foli33" class="notranslate      ">
<label class="desc" id="title33" for="Field33">
Course 2 (if applicable)
</label>
<div>
<input id="Field33" name="Field33" type="text" class="field text large" value="<?php echo $result['Field33']; ?>" maxlength="255" tabindex="7" onkeyup="" />
</div>
</li><li id="foli34" class="notranslate      ">
<label class="desc" id="title34" for="Field34">
Course 3 (if applicable)
</label>
<div>
<input id="Field34" name="Field34" type="text" class="field text large" value="<?php echo $result['Field34']; ?>" maxlength="255" tabindex="8" onkeyup="" />
</div>
</li>

<li id="foli29" class="notranslate section      ">
<section>
<h3 id="title29">
</h3>
<div id="instruct29">Courses Taught in Spring Semester</div>
</section>
</li><li id="foli31" class="notranslate      ">
<label class="desc" id="title31" for="Field31">
Course 1
</label>
<div>
<input id="Field31" name="Field31" type="text" class="field text large" value="<?php echo $result['Field31']; ?>" maxlength="255" tabindex="9" onkeyup="" />
</div>
</li><li id="foli32" class="notranslate      ">
<label class="desc" id="title32" for="Field32">
Course 2 (if applicable)
</label>
<div>
<input id="Field32" name="Field32" type="text" class="field text large" value="<?php echo $result['Field32']; ?>" maxlength="255" tabindex="10" onkeyup="" />
</div>
</li><li id="foli26" class="notranslate      ">
<label class="desc" id="title26" for="Field26">
Course 3 (if applicable)
</label>
<div>
<input id="Field26" name="Field26" type="text" class="field text large" value="<?php echo $result['Field26']; ?>" maxlength="255" tabindex="11" onkeyup="" />
</div>
</li>

<li id="foli36" class="notranslate section      ">
<section>
<h3 id="title36">
</h3>
<div id="instruct36">Courses Taught in Summer Semester</div>
</section>
</li><li id="foli30" class="notranslate      ">
<label class="desc" id="title30" for="Field30">
Course 1
</label>
<div>
<input id="Field30" name="Field30" type="text" class="field text large" value="<?php echo $result['Field30']; ?>" maxlength="255" tabindex="12" onkeyup="" />
</div>
</li><li id="foli27" class="notranslate      ">
<label class="desc" id="title27" for="Field27">
Course 2 (if applicable)
</label>
<div>
<input id="Field27" name="Field27" type="text" class="field text large" value="<?php echo $result['Field27']; ?>" maxlength="255" tabindex="13" onkeyup="" />
</div>
</li><li id="foli35" class="notranslate      ">
<label class="desc" id="title35" for="Field35">
Course 3 (if applicable)
</label>
<div>
<input id="Field35" name="Field35" type="text" class="field text large" value="<?php echo $result['Field35']; ?>" maxlength="255" tabindex="14" onkeyup="" />
</div>
</li>

<li id="foli38" class="notranslate section      ">
<section>
<h3 id="title38">
</h3>
</section>
</li><li id="foli222" 
class="notranslate      "><label class="desc" id="title222" for="Field222">
Independent Study / Formal Mentoring / Thesis Committee Participation
</label>

<div>
<textarea id="Field222" 
name="Field222" 
class="field textarea large" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="15" 
onkeyup=""
 ><?php echo $result['Field222']; ?></textarea>

</div>

<p class="instruct" id="instruct222"><small>Please list independent study classes, formal mentoring, and/or thesis committee participation.<br />
<br />
Please list dates, names, and details as appropriate.</small></p></li>
<li id="foli221" class="notranslate      ">
<label class="desc" id="title221" for="Field221">
End of Semester Reviews
</label>
<div>
<input id="Field221" name="Field221" type="text" class="field text large" value="<?php echo $result['Field221']; ?>" maxlength="255" tabindex="16" onkeyup="" />
</div>
</li><li id="foli16" 
class="notranslate      "><label class="desc" id="title16" for="Field16">
Admissions, Recruitment, and Conversion Efforts
</label>

<div>
<textarea id="Field16" 
name="Field16" 
class="field textarea small" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="17" 
onkeyup=""
 ><?php echo $result['Field16']; ?></textarea>

</div>
</li><li id="foli39" class="notranslate section      ">
<section>
<h3 id="title39">
Please upload copies of all syllabi you have developed and used for the academic year.
</h3>
</section>
</li><li id="foli40" class="notranslate       "  >
<label class="desc" id="title40" for="Field40">
File 1
</label>
<div>
<input id="Field40" name="Field40" type="file" class="field file" size="12" tabindex="18" />
</div>
</li>
<li id="foli41" class="notranslate       "  >
<label class="desc" id="title41" for="Field41">
File 2
</label>
<div>
<input id="Field41" name="Field41" type="file" class="field file" size="12" tabindex="19" />
</div>
</li>
<li id="foli42" class="notranslate       "  >
<label class="desc" id="title42" for="Field42">
File 3
</label>
<div>
<input id="Field42" name="Field42" type="file" class="field file" size="12" tabindex="20" />
</div>
</li>

<li id="foli45" class="notranslate first section      ">
<section>
<h3 id="title45">
II. PROFESSIONAL WORK<br />
<a name="page2" id="page2">-</a>
</h3>
</section>
</li><li id="foli51" 
class="notranslate      "><label class="desc" id="title51" for="Field51">
Exhibitions / Commissions / Writings and Publications
</label>

<div>
<textarea id="Field51" 
name="Field51" 
class="field textarea large" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="21" 
onkeyup=""
 ><?php echo $result['Field51']; ?></textarea>

</div>

<p class="instruct" id="instruct51"><small>Please list by headings your professional work for this year. List solo exhibitions with locations and dates, group exhibitions with locations and dates, commissions, your writings and publications and/or your curatorial projects.</small></p></li>
<li id="foli50" 
class="notranslate      "><label class="desc" id="title50" for="Field50">
Reviews, monographs, essays, articles, etc. written about your work. Complete bibliographic entries.
</label>

<div>
<textarea id="Field50" 
name="Field50" 
class="field textarea medium" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="22" 
onkeyup=""
 ><?php echo $result['Field50']; ?></textarea>

</div>
</li><li id="foli207" class="notranslate section      ">
<section>
<h3 id="title207">
Your scholarly lectures and panel discussions
</h3>
<div id="instruct207">Please specify dates and roles.</div>
</section>
</li><li id="foli203" class="notranslate      ">
<label class="desc" id="title203" for="Field203">
Lecture of Panel Discussion #1
</label>
<div>
<input id="Field203" name="Field203" type="text" class="field text large" value="<?php echo $result['Field203']; ?>" maxlength="255" tabindex="23" onkeyup="" />
</div>
</li><li id="foli205" class="notranslate      ">
<label class="desc" id="title205" for="Field205">
Lecture of Panel Discussion #2
</label>
<div>
<input id="Field205" name="Field205" type="text" class="field text large" value="<?php echo $result['Field205']; ?>" maxlength="255" tabindex="24" onkeyup="" />
</div>
</li><li id="foli206" class="notranslate      ">
<label class="desc" id="title206" for="Field206">
Lecture of Panel Discussion #3
</label>
<div>
<input id="Field206" name="Field206" type="text" class="field text large" value="<?php echo $result['Field206']; ?>" maxlength="255" tabindex="25" onkeyup="" />
</div>
</li>

<li id="foli204" class="notranslate section      ">
<section>
<h3 id="title204">
Your Participation on Juries and Advisory Boards
</h3>
<div id="instruct204">Please specify dates and roles.</div>
</section>
</li><li id="foli208" class="notranslate      ">
<label class="desc" id="title208" for="Field208">
Juries and Advisory Boards #1
</label>
<div>
<input id="Field208" name="Field208" type="text" class="field text large" value="<?php echo $result['Field208']; ?>" maxlength="255" tabindex="26" onkeyup="" />
</div>
</li><li id="foli210" class="notranslate      ">
<label class="desc" id="title210" for="Field210">
Juries and Advisory Boards #2
</label>
<div>
<input id="Field210" name="Field210" type="text" class="field text large" value="<?php echo $result['Field210']; ?>" maxlength="255" tabindex="27" onkeyup="" />
</div>
</li><li id="foli209" class="notranslate      ">
<label class="desc" id="title209" for="Field209">
Juries and Advisory Boards #3<br />
</label>
<div>
<input id="Field209" name="Field209" type="text" class="field text large" value="<?php echo $result['Field209']; ?>" maxlength="255" tabindex="28" onkeyup="" />
</div>
</li>

<li id="foli212" class="notranslate section      ">
<section>
<h3 id="title212">
Research and Work in Progress
</h3>
</section>
</li><li id="foli224" 
class="notranslate      "><label class="desc" id="title224" for="Field224">
Research and Work in Progress
</label>

<div>
<textarea id="Field224" 
name="Field224" 
class="field textarea large" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="29" 
onkeyup=""
 ><?php echo $result['Field224']; ?></textarea>

</div>

<p class="instruct" id="instruct224"><small>Please list your research or work in progress.</small></p></li>

<li id="foli62" class="notranslate first section      ">
<section>
<h3 id="title62">
III. SERVICE TO THE SCHOOL AND UNIVERSITY
</h3>
</section>
</li><li id="foli61" 
class="notranslate      "><label class="desc" id="title61" for="Field61">
Peer mentoring - Provide details on your mentoring of other faculty members.
</label>

<div>
<textarea id="Field61" 
name="Field61" 
class="field textarea large" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="30" 
onkeyup=""
 ><?php echo $result['Field61']; ?></textarea>

</div>
</li><li id="foli65" class="notranslate section      ">
<section>
<h3 id="title65">
University Committees
</h3>
<div id="instruct65">Please specify dates and roles. Also, how often did the committee meet and how many times did it meet from Jan 1 - Dec 31, 2013.</div>
</section>
</li><li id="foli72" class="notranslate      ">
<label class="desc" id="title72" for="Field72">
Committee #1
</label>
<div>
<input id="Field72" name="Field72" type="text" class="field text large" value="<?php echo $result['Field72']; ?>" maxlength="255" tabindex="31" onkeyup="" />
</div>
</li><li id="foli68" class="notranslate      ">
<label class="desc" id="title68" for="Field68">
Committee #2
</label>
<div>
<input id="Field68" name="Field68" type="text" class="field text large" value="<?php echo $result['Field68']; ?>" maxlength="255" tabindex="32" onkeyup="" />
</div>
</li><li id="foli70" class="notranslate      ">
<label class="desc" id="title70" for="Field70">
Committee #3
</label>
<div>
<input id="Field70" name="Field70" type="text" class="field text large" value="<?php echo $result['Field70']; ?>" maxlength="255" tabindex="33" onkeyup="" />
</div>
</li>

<li id="foli71" class="notranslate section      ">
<section>
<h3 id="title71">
University Special Projects, Events, or Programs.
</h3>
<div id="instruct71">Please specify dates and roles.</div>
</section>
</li><li id="foli67" class="notranslate      ">
<label class="desc" id="title67" for="Field67">
Project, Event, or Program #1<br />
</label>
<div>
<input id="Field67" name="Field67" type="text" class="field text large" value="<?php echo $result['Field67']; ?>" maxlength="255" tabindex="34" onkeyup="" />
</div>
</li><li id="foli74" class="notranslate      ">
<label class="desc" id="title74" for="Field74">
Project, Event, or Program #2
</label>
<div>
<input id="Field74" name="Field74" type="text" class="field text large" value="<?php echo $result['Field74']; ?>" maxlength="255" tabindex="35" onkeyup="" />
</div>
</li><li id="foli73" class="notranslate      ">
<label class="desc" id="title73" for="Field73">
Project, Event, or Program #3<br />
</label>
<div>
<input id="Field73" name="Field73" type="text" class="field text large" value="<?php echo $result['Field73']; ?>" maxlength="255" tabindex="36" onkeyup="" />
</div>
</li>

<li id="foli79" class="notranslate section      ">
<section>
<h3 id="title79">
University Initiatives<br />
</h3>
<div id="instruct79">Please specify dates and roles.</div>
</section>
</li><li id="foli83" class="notranslate      ">
<label class="desc" id="title83" for="Field83">
Initiative #1<br />
</label>
<div>
<input id="Field83" name="Field83" type="text" class="field text large" value="<?php echo $result['Field83']; ?>" maxlength="255" tabindex="37" onkeyup="" />
</div>
</li><li id="foli84" class="notranslate      ">
<label class="desc" id="title84" for="Field84">
Initiative #2<br />
</label>
<div>
<input id="Field84" name="Field84" type="text" class="field text large" value="<?php echo $result['Field84']; ?>" maxlength="255" tabindex="38" onkeyup="" />
</div>
</li><li id="foli85" class="notranslate      ">
<label class="desc" id="title85" for="Field85">
Initiative #3<br />
</label>
<div>
<input id="Field85" name="Field85" type="text" class="field text large" value="<?php echo $result['Field85']; ?>" maxlength="255" tabindex="39" onkeyup="" />
</div>
</li>

<li id="foli86" class="notranslate section      ">
<section>
<h3 id="title86">
Roski Committee Service<br />
</h3>
<div id="instruct86">Please specify dates and roles. Also, how often did the committee meet and how many times did it meet from Jan 1 - Dec 31, 2013.</div>
</section>
</li><li id="foli90" class="notranslate      ">
<label class="desc" id="title90" for="Field90">
Committee #1
</label>
<div>
<input id="Field90" name="Field90" type="text" class="field text large" value="<?php echo $result['Field90']; ?>" maxlength="255" tabindex="40" onkeyup="" />
</div>
</li><li id="foli91" class="notranslate      ">
<label class="desc" id="title91" for="Field91">
Committee #2
</label>
<div>
<input id="Field91" name="Field91" type="text" class="field text large" value="<?php echo $result['Field91']; ?>" maxlength="255" tabindex="41" onkeyup="" />
</div>
</li><li id="foli92" class="notranslate      ">
<label class="desc" id="title92" for="Field92">
Committee #3
</label>
<div>
<input id="Field92" name="Field92" type="text" class="field text large" value="<?php echo $result['Field92']; ?>" maxlength="255" tabindex="42" onkeyup="" />
</div>
</li>

<li id="foli75" class="notranslate section      ">
<section>
<h3 id="title75">
Roski Special Events or Programs
</h3>
<div id="instruct75">Please specify dates and roles.</div>
</section>
</li><li id="foli76" class="notranslate      ">
<label class="desc" id="title76" for="Field76">
Special Event or Program #1<br />
</label>
<div>
<input id="Field76" name="Field76" type="text" class="field text large" value="<?php echo $result['Field76']; ?>" maxlength="255" tabindex="43" onkeyup="" />
</div>
</li><li id="foli88" class="notranslate      ">
<label class="desc" id="title88" for="Field88">
Special Event or Program #2<br />
</label>
<div>
<input id="Field88" name="Field88" type="text" class="field text large" value="<?php echo $result['Field88']; ?>" maxlength="255" tabindex="44" onkeyup="" />
</div>
</li><li id="foli87" class="notranslate      ">
<label class="desc" id="title87" for="Field87">
Special Event or Program #3<br />
</label>
<div>
<input id="Field87" name="Field87" type="text" class="field text large" value="<?php echo $result['Field87']; ?>" maxlength="255" tabindex="45" onkeyup="" />
</div>
</li>

<li id="foli96" class="notranslate section      ">
<section>
<h3 id="title96">
Roski Special Service in Academic Development
</h3>
<div id="instruct96">Please specify dates and roles.</div>
</section>
</li><li id="foli227" 
class="notranslate      "><label class="desc" id="title227" for="Field227">
Academic Development
</label>

<div>
<textarea id="Field227" 
name="Field227" 
class="field textarea large" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="46" 
onkeyup=""
 ><?php echo $result['Field227']; ?></textarea>

</div>
</li><li id="foli89" class="notranslate section      ">
<section>
<h3 id="title89">
Cross-Disciplinary work with other units within USC
</h3>
<div id="instruct89">Please specify dates and roles.</div>
</section>
</li><li id="foli97" class="notranslate      ">
<label class="desc" id="title97" for="Field97">
Cross-Disciplinary Work #1<br />
</label>
<div>
<input id="Field97" name="Field97" type="text" class="field text large" value="<?php echo $result['Field97']; ?>" maxlength="255" tabindex="47" onkeyup="" />
</div>
</li><li id="foli99" class="notranslate      ">
<label class="desc" id="title99" for="Field99">
Cross-Disciplinary Work #2<br />
</label>
<div>
<input id="Field99" name="Field99" type="text" class="field text large" value="<?php echo $result['Field99']; ?>" maxlength="255" tabindex="48" onkeyup="" />
</div>
</li><li id="foli98" class="notranslate      ">
<label class="desc" id="title98" for="Field98">
Cross-Disciplinary Work #3<br />
</label>
<div>
<input id="Field98" name="Field98" type="text" class="field text large" value="<?php echo $result['Field98']; ?>" maxlength="255" tabindex="49" onkeyup="" />
</div>
</li>
<li id="foli101" class="notranslate first section      ">
<section>
<h3 id="title101">
IV. ACCOMPLISHMENTS / OTHER
</h3>
</section>
</li><li id="foli216" 
class="notranslate      "><label class="desc" id="title216" for="Field216">
Other accomplishments that you feel made a special contribution to the Roski School and/or University.
</label>

<div>
<textarea id="Field216" 
name="Field216" 
class="field textarea medium" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="50" 
onkeyup=""
 ><?php echo $result['Field216']; ?></textarea>

</div>
</li>
<li id="foli217" 
class="notranslate      "><label class="desc" id="title217" for="Field217">
Comments on anything else you feel is worthy of consideration for this academic period that has not been indicated above.
</label>

<div>
<textarea id="Field217" 
name="Field217" 
class="field textarea medium" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="51" 
onkeyup=""
 ><?php echo $result['Field217']; ?></textarea>

</div>
</li>
<li id="foli219" class="notranslate      ">
<label class="desc" id="title219" for="Field219">
By entering my initials and submitting this form, I attest that all the above information is correct.
<span id="req_219" class="req">*</span>
</label>
<div>
<input id="Field219" name="Field219" type="text" class="field text small" value="" maxlength="255" tabindex="52" onkeyup="" required />
</div>
</li><li id="foli229" class="date notranslate      ">
<label class="desc" id="title229" for="Field229">
Date Submitted.
</label>
<span>
<input id="Field229-1" name="Field229-1" type="text" class="field text" value="" size="2" maxlength="2" tabindex="53" />
<label for="Field229-1">MM</label>
</span> 
<span class="symbol">/</span>
<span>
<input id="Field229-2" name="Field229-2" type="text" class="field text" value="" size="2" maxlength="2" tabindex="54" />
<label for="Field229-2">DD</label>
</span>
<span class="symbol">/</span>
<span>
 <input id="Field229" name="Field229" type="text" class="field text" value="" size="4" maxlength="4" tabindex="55" />
<label for="Field229">YYYY</label>
</span>
<span id="cal229">
<img id="pick229" class="datepicker" src="images/calendar.png" alt="Pick a date." />
</span>
</li>

 <li class="buttons ">
<div>
<input type="hidden" id="userid" value="<?php echo $id; ?>" />
<input type="hidden" id="pin" value="<?php echo $pin; ?>" />
<input type="hidden" id="opt" value="<?php echo $option; ?>" />
<input id="save" name="save" class="btTxt submit" 
    type="button" value="Save" onclick="saveform()"/>
<input id="saveForm" name="saveForm" class="btTxt submit" 
    type="submit" value="Submit" onclick="test()" /></div>
</li>

<li class="hide">
<label for="comment">Do Not Fill This Out</label>
<textarea name="comment" id="comment" rows="1" cols="1"></textarea>
<input type="hidden" id="idstamp" name="idstamp" value="S1pPfL5iwAoKO2m4iUjoCv9ncLd+CA5UYgHsT5Mtckw=" />
</li>
</ul>
</form> 

</div><!--container-->

<a class="powertiny" href="http://www.wufoo.com/" title="Powered by Wufoo"
style="display:block !important;visibility:visible !important;text-indent:0 !important;position:relative !important;height:auto !important;width:95px !important;overflow:visible !important;text-decoration:none;cursor:pointer !important;margin:0 auto !important">
<span style="background:url(./images/powerlogo.png) no-repeat center 7px; margin:0 auto;display:inline-block !important;visibility:visible !important;text-indent:-9000px !important;position:static !important;overflow: auto !important;width:62px !important;height:30px !important">Wufoo</span>
<b style="display:block !important;visibility:visible !important;text-indent:0 !important;position:static !important;height:auto !important;width:auto !important;overflow: auto !important;font-weight:normal;font-size:9px;color:#777;padding:0 0 0 3px;">Designed</b>
</a>
</body>
</html>
