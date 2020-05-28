<?php
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
	$checkbox_id = $_POST['check_'];
	$i = count($checkbox_id);
	for($j=0; $j<$i; $j++){
//		$row1 = mysql_query("SELECT name_user FROM users_site WHERE id_user=($checkbox_id[$j] - $j)");
//		$row2 = mysql_fetch_assoc($row1);
//		mysql_query("DROP TABLE " . $row2['name_user'] . "_products");
		mysql_query("DELETE FROM purchases_site WHERE id_user=($checkbox_id[$j] - $j)");
		mysql_query("DELETE FROM users_site WHERE id_user=($checkbox_id[$j] - $j)");
		mysql_query("UPDATE users_site SET id_user = id_user-1 WHERE id_user>($checkbox_id[$j] - $j)");
	}
	echo "<script> alert('Успешно сохранено') </script>";
	echo "
		<html>
			<head>
				<meta http-equiv='Refresh' content='0; URL=".$back."'>
			</head>
		</html>
	";	
?>