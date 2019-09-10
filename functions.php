<?php
	require_once("db.php");
	// Get all values
	
						$field1       			= urldecode($_POST['Field1']);
						$field2					= urldecode($_POST['Field2']);
						$field37				= urldecode($_POST['Field37']);
						$field25				= urldecode($_POST['Field25']);
						$field33				= urldecode($_POST['Field33']);
						$field34				= urldecode($_POST['Field34']);
						$field31				= urldecode($_POST['Field31']);
						$field32				= urldecode($_POST['Field32']);
						$field26				= urldecode($_POST['Field26']);
						$field30				= urldecode($_POST['Field30']);
						$field27				= urldecode($_POST['Field27']);
						$field35				= urldecode($_POST['Field35']);
						$field222				= urldecode($_POST['Field222']);
						$field221				= urldecode($_POST['Field221']);
						$field16				= urldecode($_POST['Field16']);
						$field51				= urldecode($_POST['Field51']);
						$field50				= urldecode($_POST['Field50']);
						$field203				= urldecode($_POST['Field203']);
						$field205				= urldecode($_POST['Field205']);
						$field206				= urldecode($_POST['Field206']);
						$field208				= urldecode($_POST['Field208']);
						$field210				= urldecode($_POST['Field210']);
						$field209				= urldecode($_POST['Field209']);
						$field224				= urldecode($_POST['Field224']);
						$field61				= urldecode($_POST['Field61']);
						$field72				= urldecode($_POST['Field72']);
						$field68				= urldecode($_POST['Field68']);
						$field70				= urldecode($_POST['Field70']);
						$field67				= urldecode($_POST['Field67']);
						$field74				= urldecode($_POST['Field74']);
						$field73				= urldecode($_POST['Field73']);
						$field83				= urldecode($_POST['Field83']);
						$field84				= urldecode($_POST['Field84']);
						$field85				= urldecode($_POST['Field85']);
						$field90				= urldecode($_POST['Field90']);
						$field91				= urldecode($_POST['Field91']);
						$field92				= urldecode($_POST['Field92']);
						$field76				= urldecode($_POST['Field76']);
						$field88				= urldecode($_POST['Field88']);
						$field87				= urldecode($_POST['Field87']);
						$field227				= urldecode($_POST['Field227']);
						$field97				= urldecode($_POST['Field97']);
						$field99				= urldecode($_POST['Field99']);
						$field98				= urldecode($_POST['Field98']);
						$field216				= urldecode($_POST['Field216']);
						$field217				= urldecode($_POST['Field217']);	
	
	
	
	
	
	$userid = $_GET['id'];
	$type = $_GET['create'];
	$pin = $_GET['pin'];
	
	if($type == "Retrieve"){
		$query = "SELECT * from forms where id='".$userid."'";
		if(mysql_num_rows(mysql_query($query))==0){
			$type = "Create";
		}
	}
	if($type == "Create"){
$query = "INSERT INTO forms values (
'$userid',
'$pin',
'$field1',
'$field2',
'$field37',
'$field25',
'$field33',
'$field34',
'$field31',
'$field32',
'$field26',
'$field30',
'$field27',
'$field35',
'$field222',
'$field221',
'$field16',
'$field51',
'$field50',
'$field203',
'$field205',
'$field206',
'$field208',
'$field210',
'$field209',
'$field224',
'$field61',
'$field72',
'$field68',
'$field70',
'$field67',
'$field74',
'$field73',
'$field83',
'$field84',
'$field85',
'$field90',
'$field91',
'$field92',
'$field76',
'$field88',
'$field87',
'$field227',
'$field97',
'$field99',
'$field98',
'$field216',
'$field217')";

			mysql_query($query);
	
	}else if($type == "Retrieve"){
$query = "UPDATE forms SET 
Field1	='$field1',
Field2	='$field2',
Field37	='$field37',
Field25	='$field25',
Field33	='$field33',
Field34	='$field34',
Field31	='$field31',
Field32	='$field32',
Field26	='$field26',
Field30	='$field30',
Field27	='$field27',
Field35	='$field35',
Field222='$field222',
Field221='$field221',
Field16	='$field16',
Field51	='$field51',
Field50	='$field50',
Field203='$field203',
Field205='$field205',
Field206='$field206',
Field208='$field208',
Field210='$field210',
Field209='$field209',
Field224='$field224',
Field61	='$field61',
Field72	='$field72',
Field68	='$field68',
Field70	='$field70',
Field67	='$field67',
Field74	='$field74',
Field73	='$field73',
Field83	='$field83',
Field84	='$field84',
Field85	='$field85',
Field90	='$field90',
Field91	='$field91',
Field92	='$field92',
Field76	='$field76',
Field88	='$field88',
Field87	='$field87',
Field227	='$field227',
Field97	='$field97',
Field99	='$field99',
Field98	='$field98',
Field216	='$field216',
Field217	='$field217' WHERE id='$userid'";
		mysql_query($query);
	}
?>	


