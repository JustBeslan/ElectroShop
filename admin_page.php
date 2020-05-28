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
//	$con = mysql_connect("$host","$name","$passw");
//	mysql_select_db("$db",$con);
//	mysql_query("SET NAMES 'utf8'");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
		<link rel="shortcut icon" href="/teleph.ico" type="image/x-icon">	
	<style>
		body {
			height: 100%;
			background: url(fon2.jpg);
			background-size: cover;
			background-attachment: fixed;
		}
		.style_button {
			width: 500px;
			height: 40px;
			position: relative;
			left: 100px;
			top: 170px;
			color: #0000FF;
			border-radius: 40px;
			font-size: 17px;
			font-weight: 600;
		}
		.style_button:hover{
			background: #e6e6ff;
			color: #000000;
		}
	</style>
</head>
<body>
	<form method="post">
		<p><input type="submit" class="style_button" name="admin_list_users" value=" Просмотреть зарегистрированных пользователей "></p>
		<p><input type="submit" class="style_button" name="admin_list_product" value=" Просмотреть товары "></p>
		<p><input type="submit" class="style_button" name="admin_exit" value=" Выйти "></p>		
	</form>
</body>
</html>
<?php
	if (isset($_POST['admin_exit'])) {
		echo '
		<html>
			<head>
				<meta http-equiv="Refresh" content="0; URL=Example01.html">
			</head>
		</html>
		';
	}
	if (isset($_POST['admin_list_users'])) {
		echo '
		<html>
			<head>
				<meta http-equiv="Refresh" content="0; URL=List_Users.php">
			</head>
		</html>
		';
	}
	if (isset($_POST['admin_list_product'])) {
		echo '
		<html>
			<head>
				<meta http-equiv="Refresh" content="0; URL=List_Products.php">
			</head>
		</html>
		';
	}
?>
