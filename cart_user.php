<?php
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
	$zapros = "SELECT * FROM products_site WHERE id_products IN ";
	$zapros = $zapros . "(SELECT id_products FROM purchases_site WHERE id_user IN ";
	$zapros = $zapros . "(SELECT id_user FROM users_site WHERE name_user = '" . $_SESSION['user_name'] . "'))";
	$result = mysql_query($zapros);
	if (isset($_POST['user_exit'])) {
		echo '
		<html>
			<head>
				<meta http-equiv="Refresh" content="0; URL=Example01.html">
			</head>
		</html>
		';
	}
	else{?>
		<!DOCTYPE html>
		<html>
	<head>
			<meta charset="utf-8">
			<link rel="shortcut icon" href="/teleph.ico" type="image/x-icon">
	</head>
		<style>
			body {
				height: 100%;
				background: url(fon2.jpg);
				background-size: cover;
				background-attachment: fixed;
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
			table {
				position: relative;
				top: -20px;
				left: 180px;
			}
			th {
				background: #0066FF;
				color: white;
			}
			td {
				background: rgba(100, 100, 100, 0.2);
				font-size: 26px;
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
			img {
				width: 100px;
			}	
			.style_checkbox {
				transform: scale(1.9);
				float: right;
			}
			#style_table{
				width: 1200px;
				height: 600px;
				overflow: auto;
				position: fixed;
				left: 200px;
				top: 100px;
			}
		</style>
	<body>
		<form method="post">
			<p><input type="submit" class="style_button" value=" Вернуться на предыдущую страницу " name="Return"></p>
			<?php
				if(isset($_POST['Return'])){ 
				echo '
				<html>
					<head>
						<meta http-equiv="Refresh" content="0; URL=page_users.php">
					</head>
				</html>
				';
			}?>
		</form>
		<form method="post" action="save_cart_user.php">
			<p><input type="submit" class="style_button" value=" Сохранить " name="Save"></p>
			<div id="style_table">
				<table border="2" width="1000" cellspacing="2" cellpadding="10" id='myTable'>
				<caption> Корзина </caption>
					<tr>
						<th>Фото Товара</th>
						<th>Имя Товара</th>
						<th>Цена Товара</th>
					</tr>
				<?php while($row = mysql_fetch_assoc($result)) { ?>
					<tr>
						<td align="center"><img src="Image/<?php echo ($row['name_products'] . '.jpg') ?>"> </td>
						<td align="center"><?php echo ($row['name_products']) ?></td>
						<td align="center">
							<input type='checkbox' class='style_checkbox' name="check_[]" value="<?php echo ($row['id_products']) ?>">
							<?php echo ($row['price_products']) ?>		
						</td>
					</tr>
				<?php }?>
				</table>
			</div>
		</form>
	</body>
		</html>
	<?php }?>