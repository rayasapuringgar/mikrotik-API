<?php
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");	
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	$name=$_REQUEST['name'];
	$local=$_REQUEST['local']; if($local==""){$local = "0.0.0.0";}
	$remote=$_REQUEST['remote'];
	//$session=$_REQUEST['session']; if($session==""){$session = "365d 00:00:00";}
	
	$limit=$_REQUEST['limit']; if($limit==""){$limit = "";}	
	
	if($name != ""){
		$sql="SELECT pro_name FROM pppoe_pro WHERE pro_name='".$name."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);
		
		if($rows>0){
			echo "<script>alert('มีชื่อ ".$name." แล้วในฐานขื้อมูล กรุณาตั้งชื่อใหม่.')</script>";
			echo "<script>window.history.back()</script>";
		}else{
			mysql_query("INSERT INTO pppoe_pro VALUE('".$name."','".$local."','".$remote."','".$session."','".$limit."')");
			$ARRAY = $API->comm("/ppp/profile/add", array(
									"name" => $name,
									//"session-timeout" => $session,
									"local-address" => $local,
									"remote-address" => $remote,
									"rate-limit" => $limit
									
								));		
			echo "<script>alert('เพิ่ม Profile ".$name." สำเร็จแล้ว')</script>";
			echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=pppoe_profile_list' />";
			exit;
		}
	}
?>