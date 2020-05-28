<?php
	session_start();
	$fp = fopen("info.txt",'r');
		$host = fgets($fp,30);
		$host = preg_replace('/\s+/','',$host);
		
		$name = fgets($fp,30);
		$name = preg_replace('/\s+/','',$name);
		
		$passw = fgets($fp,30);
		$passw = preg_replace('/\s+/','',$passw);
		
		$db = fgets($fp,30);
		$db = trim($db," ");
	fclose($fp);
	
	$con = mysql_connect("$host","$name","$passw");
	mysql_select_db("$db",$con);
	mysql_query("SET NAMES 'utf8'");

	$back = $_SERVER['HTTP_REFERER'];
//	mysql_query("SET CHARACTER SET 'cp866'");
//	mysql_set_charset("cp866");

//	$b=0;
//	$result = mysql_query('SELECT table_name FROM information_schema.tables');
//	while ($row = mysql_fetch_assoc($result)){
//		if ($row['table_name'] == "users_site") $b = 1;
//	}
//	if($b == 0) {
//		$fd2 = fopen("Spisok_Users.sql", 'r+');
//		$str = "CREATE TABLE Users_Site(id_user SMALLINT(3), name_user CHAR(40), password_user CHAR(40)) default character set = 'cp866'";
//		fwrite($fd2, $str);	
//		mysql_query($str);
//		$str = "INSERT INTO users_site VALUES(0,'Beslan','170898')";
//		fwrite($fd2, $str);
//		mysql_query($str);
//		fclose($fd2);
//	}
	$buff=true;
	if (($_POST['name_user'] == "")or($_POST['password_user'] == "")or($_POST['confirm_password_user'] == "")) {
		echo "<script>alert(\"Какое то поле осталось пустым.\");</script>";
		$buff=false;
		echo "
		<html>
			<head>
				<meta http-equiv='Refresh' content='0; URL=".$back."'>
			</head>
		</html>
		";
	}
	if (($_POST['confirm_password_user'] != $_POST['password_user'])and($buff == true)) {
		echo "<script>alert(\"Поля ПОДТВЕРДИТЬ ПАРОЛЬ и ПАРОЛЬ не совпадают.\");</script>";
		echo "
		<html>
			<head>
				<meta http-equiv='Refresh' content='0; URL=".$back."'>
			</head>
		</html>
		";
	}
	if (($_POST['confirm_password_user'] == $_POST['password_user'])and($buff == true)){
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
			$result1 = mysql_query("SELECT COUNT(*) FROM Users_Site");
			$row = mysql_fetch_assoc($result1);
//			$fd2 = fopen("Spisok_Users.sql", 'r+');
//			fseek($fd2,0,SEEK_END);
			$str = "INSERT INTO Users_Site VALUES(" . $row['COUNT(*)'] . "," . "'" . $_POST['name_user'] . "'" . ",";
			$str = $str . "'" . $_POST['password_user'] . "'" .  ")";
//			fwrite($fd2, $str);
//			fclose($fd2);
//			echo "<script>alert($str);</script>";
//			echo $str;
			mysql_query($str);
//			$str2 = "CREATE TABLE " . $_POST['name_user'] . "_products(id INT(3))";
//			mysql_query($str2);
			echo "<script>alert(\"Новый пользователь был успешно зарегистрирован.\");</script>";
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