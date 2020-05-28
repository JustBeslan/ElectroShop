<?php
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
	$result1 = mysql_query("SELECT COUNT(*) FROM Users_Site");
	$row = mysql_fetch_assoc($result1);
	$buff=true;
	if (($_POST['name_user'] == "")or($_POST['password_user'] == "")) {
		echo "<script>alert(\"Какое-то поле пустое.\");</script>";
		$buff=false;
		echo "
		<html>
			<head>
				<meta http-equiv='Refresh' content='0; URL=".$back."'>
			</head>
		</html>
		";
	}
	if ($buff == true){
		$result0 = mysql_query("select * from users_site where name_user='" . $_POST['name_user'] . "'");
		$row0 = mysql_fetch_assoc($result0);
		if($row0['id_user'] != "") {
			echo "<script>alert(\"Такой пользователь уже зарегистрирован.\");</script>";
			echo "
			<html>
				<head>
					<meta http-equiv='Refresh' content='0; URL=".$back."'>
				</head>
			</html>
			";
		}
		else {
			$str = "INSERT INTO Users_Site VALUES(" . $row['COUNT(*)'] . "," . "'" . $_POST['name_user'] . "'" . ",";
			$str = $str . "'" . $_POST['password_user'] . "'" .  ")";
			mysql_query($str);
//			$str2 = "CREATE TABLE " . $_POST['name_user'] . "_products(id INT(3))";
//			mysql_query($str2);
			echo "<script>alert(\"Новый пользователь успешно был зарегистрирован.\");</script>";
			echo "
			<html>
				<head>
					<meta http-equiv='Refresh' content='0; URL=".$back."'>
				</head>
			</html>
			";
		}
	}
?>
