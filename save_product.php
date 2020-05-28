<?php
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
	$checkbox_id = $_POST['check_'];
	$i = count($checkbox_id);
	for($j=0; $j<$i; $j++){
		mysql_query("DELETE FROM " . $_SESSION['type'] . "site WHERE id= ($checkbox_id[$j] - $j)");

		mysql_query("DELETE FROM purchases_site WHERE id_products = ($checkbox_id[$j] - $j)");

		mysql_query("DELETE FROM products_site WHERE id_products = ($checkbox_id[$j] - $j)");
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