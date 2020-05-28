<?php
//	header('charset=utf-8');
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");

	$result1 = mysql_query("SELECT min(id_products-1) FROM products_site WHERE id_products-1 not IN(SELECT id_products FROM products_site) AND id_products-1>0");
	$row1 = mysql_fetch_assoc($result1);
	$stolb = 'min(id_products-1)';
	if($row1['min(id_products-1)'] == "") {
		$result1 = mysql_query("SELECT max(id_products)+1 FROM products_site");
		$row1 = mysql_fetch_assoc($result1);
		$stolb = 'max(id_products)+1';
	}
	$str = "INSERT INTO products_site VALUES(" . $row1[$stolb] . ",'" . $_POST['name_new_product'] . "',";
	$str = $str . $_POST['price_new_product'] . ",'" . $_POST['type_tovar'] . "')";
	
	if ($_POST['new_product_other'] != ""){
		$file = "Information_about_tovar/" . $_POST['type_tovar'] . "/" . $_POST['name_new_product'] . ".txt";
		$fp = fopen($file,"w");
		fwrite($fp,$_POST['new_product_other']);
		fclose($fp);
	}

	$str2 = "INSERT INTO " . $_POST['type_tovar'] . "_site VALUES('" . $row1[$stolb] . "','" . $_POST['creater_new_product'] . "','";
	$str2 = $str2 . $_POST['processor_new_product'] . "'," . $_POST['diag_new_product'] . ",'" . $_POST['razresh_new_product'] . "','" . $_POST['OC_new_product'];
	$str2 = $str2 . "'," . $_POST['Memory_new_product'];

	if($_POST['type_tovar'] == "laptop") $str2 = $str2 . ")";
	if($_POST['type_tovar'] == "smartphone") $str2 = $str2 . "," . $_POST['osn_camera_new_product'] . "," . $_POST['front_camera_new_product'] . ")";
//	echo $str;
//	echo $str2;

	mysql_query($str);
	mysql_query($str2);
	echo "<script>alert(\"Новый продукт успешно зарегистрирован.\");</script>";
	echo "
		<html>
			<head>
				<meta http-equiv='Refresh' content='0; URL=".$back."'>
			</head>
		</html>
	";
?>