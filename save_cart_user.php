<?php
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
	$checkbox_id = $_POST['check_'];
	$i = count($checkbox_id);
	for($j=0; $j<$i; $j++){
		$zapros0 = "SELECT id_purchases FROM purchases_site WHERE id_products=($checkbox_id[$j] - $j) AND id_user IN";
		$zapros0 = $zapros0 . "(SELECT id_user FROM users_site WHERE name_user = '" . $_SESSION['user_name'] . "')";
		$arr1 = mysql_query($zapros0);
		$res1 = mysql_fetch_assoc($arr1);
		$zapros1 = "DELETE FROM purchases_site WHERE id_products=($checkbox_id[$j] - $j) AND id_user IN";
		$zapros1 = $zapros1 . "(SELECT id_user FROM users_site WHERE name_user = '" . $_SESSION['user_name'] . "')";
		mysql_query($zapros1);
		$zapros2 = "UPDATE purchases_site SET id_purchases=id_purchases-1 WHERE id_purchases>" . $res1['id_purchases'];
		mysql_query($zapros2);	
	}
	echo "<script> alert('Успешно сохранено') </script>";
	echo "
		<html>
			<head>
				<meta http-equiv='Refresh' content='0; URL=page_users.php'>
			</head>
		</html>
	";
?>