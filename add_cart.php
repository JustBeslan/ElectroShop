<?php
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
	$user = $_SESSION['user_name'];
	$id_pr = key($_POST);
	$zapr1 = mysql_query("SELECT COUNT(*) FROM purchases_site");
	$res1 = mysql_fetch_assoc($zapr1);
	$zapr2 = mysql_query("SELECT id_user FROM users_site WHERE name_user = '" . $user . "'");
	$res2 = mysql_fetch_assoc($zapr2);
//	echo "INSERT INTO purchases_site VALUES("  . ((int)($res1['COUNT(*)'])+1) . "," . $res2['id_user']. "," . $id_pr . ")";
	mysql_query("INSERT INTO purchases_site VALUES("  . ((int)($res1['COUNT(*)'])+1) . "," . $res2['id_user']. "," . $id_pr . ",0)");
	echo "
		<html>
			<head>
				<meta http-equiv='Refresh' content='0; URL=".$back."'>
			</head>
		</html>
	";
?>
