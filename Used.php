<?php
	session_start();
	$fp = fopen("info.txt",'r');
			$host = fgets($fp,30);
			$host = preg_replace('/\s+/','',$host);
			$_SESSION['host'] = $host;

			$name = fgets($fp,30);
			$name = preg_replace('/\s+/','',$name);
			$_SESSION['name'] = $name;

			$passw = fgets($fp,30);
			$passw = preg_replace('/\s+/','',$passw);
			$_SESSION['password'] = $passw;

			$db = fgets($fp,30);
			$db = trim($db," ");
			$_SESSION['database'] = $db;

	fclose($fp);

	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
//	mysql_query("SET NAMES 'cp866'");
	$str = "SELECT COUNT(*) FROM Users_Site WHERE name_user =" . "'" . $_POST['user_name'] . "'";
	$str = $str . "and password_user=" . "'" . $_POST['user_password'] . "'";
//	echo '<script>alert("' . $str . '");</script>';
//	echo "<script>alert('qweeqw');</script>";
	$result0 = mysql_query($str);
	$row0 = mysql_fetch_assoc($result0);
//	print_r($row0);
	echo $row0['COUNT(*)'];
	echo $back;

	if(($row0['COUNT(*)'] == 0) and ($back == "http://my_first.com/Example01.html")) {
		echo "<script>alert(\"No such user exists.\");</script>";
		echo "
			<html>
				<head>
					<meta http-equiv='Refresh' content='0; URL=".$back."'>
				</head>
			</html>
		";
	}
	else{
		if (($_POST['user_name'] == "Beslan") and ($_POST['user_password'] == "170898")) {
			echo '
				<html>
					<head>
						<meta http-equiv="Refresh" content="0; URL=admin_page.php">
					</head>
				</html>
			';
		}
		else{
			$_SESSION['user_name'] = $_POST['user_name'];
				echo "
				<html>
					<head>
						<meta http-equiv='Refresh' content='0; URL=page_users.php'>
					</head>
				</html>
				";
		}
	}
?>