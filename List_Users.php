<?php
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
//	$s = "123";
//	mysql_query("insert into t1 values('123')");
	$result = mysql_query('SELECT * FROM Users_Site');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="shortcut icon" href="/teleph.ico" type="image/x-icon">
	<style>
		table {
			position: relative;
			top: -100px;		
			left: 400px;	
		}
		body {
			height: 100%;
			background: url(fon2.jpg);
			background-size: cover;
			background-attachment: fixed;
		}
		th{
			background: #0066FF;
			color: white;
		}
		td {
			background: rgba(100, 100, 100, 0.2);
			font-size: 22px;
			font-weight: 600;
			color: #CC3300;
		}
		td:hover{
			background: #e6e6ff;
			color: #000000;			
		}
		td:focus{
			background: #e6e6ff;
			color: #000000;			
		}
		.style_button_add {
			position: relative;
			left: 35px;
			top: 50px;
			color: #0000FF;	
			background: rgba(210,210,210,1);
			font-size: 19px;
			text-decoration: none;
			border: 1px solid #333;
			padding: 5px 15px;
			font-weight: 600;
			border-radius: 40px;
		}
		.style_button {
			width: 350px;
			height: 40px;
			position: relative;
			left: 10px;
			top: 50px;
			color: #0000FF;
			border-radius: 40px;
			font-size: 17px;
			font-weight: 600;
		}
		.style_button:hover{
			background: #e6e6ff;
			color: #000000;
		}
		.style_checkbox {
			transform: scale(1.6);
			float: left;
		}
		#window_new_user {
				border-radius: 40px;
				background: rgba(255,153,51,1);
				width: 250px;
				height: 400px;
				position: relative;
				top: -10px;
				left: 0;
				display: none;
			}
		#window_new_user:target {display: block;}
		.style_close {
			color: #0000FF;	
			background: rgba(210,210,210,1);
			font-size: 15px;
			text-decoration: none;
			font-weight: 600;
		}
		.style_edit {
				width: 150px;
				height: 20px;
				border-radius: 40px;
				font-size: 20px;
				position: relative;
				left: 50px;
				top: 40px;
			}
	</style>
</head>
<body>
	<form method="post">
		<p><input type="submit" class="style_button" value=" Вернуться на предыдущую страницу " name="Return"></p>
		<p><a href="#window_new_user" class="style_button_add">Добавить нового пользователя</a></p>
		<?php
			if(isset($_POST['Return'])){ 
			echo '
			<html>
				<head>
					<meta http-equiv="Refresh" content="0; URL=admin_page.php">
				</head>
			</html>
			';
		}?>
	</form>
	<form method="post" action="save.php">
	<p><input type="submit" class="style_button" value=" Сохранить " name="Save"></p>
	<table border="2" width="1000" cellspacing="2" cellpadding="10" id='myTable'>
		<caption>Таблица зарегистрированных пользователей сайта</caption>
				<tr>
					<th>ИД Пользователя</th>
					<th>Имя Пользователя</th>
					<th>Пароль Пользователя</th>
				</tr>
			<?php while($row = mysql_fetch_assoc($result)) { ?>
				<tr>
					<?php if($row['id_user'] == 0) {?>
						<td contenteditable="false" align="center"> <?php echo ($row['id_user']) ?> </td>
						<td contenteditable="false" align="center"> <?php echo ($row['name_user']) ?> </td>
						<td contenteditable="false" align="center"> <?php echo ($row['password_user']) ?> </td>
					<?php }?>
					<?php if($row['id_user'] != 0) {?>
						<td contenteditable="false" align="center">
							<input type='checkbox' class='style_checkbox' name="check_[]" value="<?php echo ($row['id_user']) ?>">
							<?php echo ($row['id_user']) ?>
						</td>
						<td contenteditable="true" align="center"><?php echo ($row['name_user']) ?></td>
						<td contenteditable="true" align="center"><?php echo ($row['password_user']) ?></td>
					<?php }?>
				</tr>
			<?php }?>
	</table>
	</form>
			<div id = "window_new_user">
				<form method="post" action="adduser.php">
					<input type="submit" name = "save" value="Сохранить" style="position: relative; left: 75px; top: 370px; width: 100px; height: 30px;">
					<a href="#" class="style_close"><div>Закрыть</div></a>
					<font size="4"><p align="center" style="position: relative; top: 50px;"><b> ИМЯ ПОЛЬЗОВАТЕЛЯ: </b></p></font>
					<input class="style_edit" type='text' name='name_user'>
					<font size="4"><p align="center" style="position: relative; top: 50px;"><b> ПАРОЛЬ: </b></p></font> 
					<input class="style_edit" type='text' name='password_user'>
				</form>
			</div> 
</body>
</html>
