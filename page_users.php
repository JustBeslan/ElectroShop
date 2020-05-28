<?php
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
	$result = mysql_query('SELECT * FROM products_site');
	$_POST['user_name'] = $_SESSION['user_name'];
?>
<html>
	<head>
		<meta charset = "utf-8">
		<title> Магазин </title>
		<link rel="shortcut icon" href="/teleph.ico" type="image/x-icon">
		<style>
			body {
				height: 100%;
				background: url(fon2.jpg);
				background-size: cover;
				background-attachment: fixed;
			}
			table {
				background: white;
				border-radius: 40px;
			}
			img {width: 100px;}
			img:hover{
				width: 180px;
				height: 150px;
			}
			td:hover{background: rgba(255,153,51,1);}
			.c_th {color: rgba(255,153,51,1);}
			.style_button {
				width: 80px;
				height: 20px;
				position: fixed;
				left: 180px;
				color: #0000FF;
				border-radius: 10px;
				font-size: 15px;
				font-weight: 600;
			}
			.style_button:hover{
				background: #e6e6ff;
				color: #000000;
			}
			.style_button2 {
				width: 300px;
				height: 20px;
				position: fixed;
				left: 280px;
				color: #0000FF;
				border-radius: 10px;
				font-size: 15px;
				font-weight: 600;
			}
			.style_button2:hover{
				background: #e6e6ff;
				color: #000000;
			}
			.style_a {
				position: relative;
				left: 1px;
				top: -10px;
				color: #0000FF;	
				font-size: 11px;
				text-decoration: none;
				font-weight: 600;
			}
			.style_a:hover{
				background: #e6e6ff;
				color: #000000;
			}
			.style_end {
				width: 200px;
				height: 30px;
				position: fixed;
				left: 1320px;
				top: 100px;
				background: rgba(255,153,51,1);
				border-radius: 10px;
				font-size: 15px;
				font-weight: 600;
			}
			.style_end:hover{
				background: #e6e6ff;
				color: #000000;
			}
			#style_table{
				width: 1200px;
				height: 600px;
				overflow: auto;
				position: fixed;
				left: 200px;
				top: 100px;
			}
			#style_table::-webkit-scrollbar{
				height: 1px;
				width: 1px;
				position: relative;
			}
			.style_forms_type_tovar{
				position: relative;
				top: 100px;
				left: 30px;
			}
			.style_button_type_tovar{
				position: relative;
				top: 1px;
				left: 5px;
				width: 150px;
				height: 30px;
				-webkit-transform: skewX(-30deg);
				transform: skewX(-30deg);
				font-size:17;
				font-weight:600;
				background: rgba(255,153,51,1);				
			}
			.style_charact{
				float: left;
				font-size: 18;
				color: red;
				font-weight: 600;
				position: relative;
				left: 5px;
				top: 1px;
			}
			.style_charact2{
				float: left;
				font-size: 18;
				color: grey;
				font-weight: 600;
				position: relative;
				left: 5px;
				top: 1px;
			}
		</style>
	</head>
	<body>
		<form method="post" action="cart_user.php">
			<p><input type="submit" class="style_button" name="user_exit" value=" Выйти "></p>
			<p><input type="submit" class="style_button2" name="look_cart_user" value=" Посмотреть выбранные товары "></p>
			<label><input type="hidden">Ваше Имя :	</label>
			<label><input type="hidden"><b><i><?php echo $_POST['user_name']; ?></i></b></label>
		</form>
		<form method="post" class="style_forms_type_tovar">
			<label style="position: relative; top: -1px; left: -1px; font-weight: 600;">Выберете тип товара:</label>
			<p><input type="submit" value="Ноутбуки" name="laptop" class="style_button_type_tovar"></p>
			<p><input type="submit" value="Смартфоны" name="smartphone" class="style_button_type_tovar"></p>
		</form>
		<?php
			if(isset($_POST['laptop'])) $_SESSION['type']='laptop';
			if(isset($_POST['smartphone'])) $_SESSION['type']='smartphone';
			$result = mysql_query("SELECT * FROM products_site WHERE id_products IN (SELECT id FROM " . $_SESSION['type'] . "_site)");
		?>
		<form method="post" action="add_cart.php">
<!--/////////////////////////////////////////////////////////-->
			<div id="style_table">
				<table border="0" width="1000" cellspacing="2" cellpadding="5" align="center" id='myTable'>
					<caption></caption>
					<tr>
						<th></th>
						<th class="c_th"><i><b> Наименование </b></i></th>
						<th class="c_th"><i><b> Цена </b></i></th>
					</tr>
				<?php while($row = mysql_fetch_assoc($result)) {
						$charact = mysql_query("SELECT * FROM " . $_SESSION['type'] . "_site WHERE id = " . $row['id_products']);
						$charact_arr = mysql_fetch_assoc($charact);
					?>
					<tr>
						<td align="center"><img src="Image/<?php echo ($row['name_products'] . '.jpg') ?>"> </td>
						<td align="center" style="font-size: 30px;">
							<i><b><?php echo ($row['name_products']) ?></b></i>
							<p class="style_charact">
								<?php 	echo "<label class='style_charact'>Производитель :</label>";
										echo "<label class='style_charact2'>".$charact_arr['creater']."</label>";
										echo "<label class='style_charact'> , Процессор :</label>";
										echo "<label class='style_charact2'>".$charact_arr['processor']."</label>";
										echo "<label class='style_charact'> , Диагональ экрана :</label>";
										echo "<label class='style_charact2'>".$charact_arr['diag']."</label>";
								 ?>
								<?php 	echo "<br><label class='style_charact'>Разрешение экрана :</label>";
										echo "<label class='style_charact2'>".$charact_arr['razresh']."</label>";
										echo "<label class='style_charact'> , Система :</label>";
										echo "<label class='style_charact2'>".$charact_arr['oc']."</label>";
										echo "<br><label class='style_charact'>Оперативная память(Гб) :</label>";
										echo "<label class='style_charact2'>".$charact_arr['memory']."</label>";
								 ?>
								 <?php
								 	if($_SESSION['type'] == "smartphone"){
										echo "<br><label class='style_charact'> Основная камера(Мп) :</label>";
										echo "<label class='style_charact2'>".$charact_arr['mp_osn_camera']."</label>";
										echo "<br><label class='style_charact'> Фронтальная камера(Мп) :</label>";
										echo "<label class='style_charact2'>".$charact_arr['mp_front_camera']."</label>";								 		
								 	}
								 ?>
							</p>
						</td>
					<?php
						$zapros = "SELECT COUNT(*) FROM purchases_site WHERE id_user IN (SELECT id_user FROM users_site WHERE name_user = '";
						$zapros = $zapros . $_POST['user_name'] . "')" . "and id_products = " . $row['id_products'];
						$result2 = mysql_query($zapros);
						$row3 = mysql_fetch_assoc($result2);
						if ($row3['COUNT(*)'] == 0) { ?>
								<td align="center" style="font-size: 30px;">
									<i><b><?php echo ($row['price_products'] . "	Рублей") ?></b></i>
									<p><input type='submit' class="style_a" value="Добавить в корзину" name= "<?php echo $row['id_products'] ?>"></p>
								</td>
						<?php }
						else{?>							
								<td align="center" style="font-size: 30px;"><i><b><?php echo ($row['price_products'] . "	Рублей") ?></b></i>
									<p><i><b><label style=" font-size: 13; position: relative; left: 1px; color: rgba(255,153,51,1);">
										Добавлено в корзину</label></b></i></p>
								</td>
						<?php }?>

					</tr>
				<?php }?>
				</table>
			</div>
<!--/////////////////////////////////////////////////////////-->
		</form>
		<form method="post">
			<input type="submit" name="end" class = "style_end" value="Оформить заказ">
		</form>
		<p><label style="position: relative; top: 550px; left: 10px; font-weight: 600; font-size: 20;">Адрес: город Кранодар</label></p>
		<p><label style="position: relative; top: -188px; left: 1115px; font-weight: 600; font-size: 20;">Контакты: Тел. +7-999-999-99-99</label></p>
		<p><label style="position: relative; top: -190px; left: 1220px; font-weight: 600; font-size: 20;">E-mail: Some_E_mail@gmail.com</label></p>
	</body>
</html>
<?php
	if(isset($_POST['end'])){
		$str = "SELECT SUM(price_products) FROM products_site WHERE id_products IN";
		$str = $str . "(SELECT id_products FROM purchases_site WHERE id_user IN";
		$str = $str . "(SELECT id_user FROM users_site WHERE name_user = '" . $_SESSION['user_name'] . "') and completed <> 1)";
		$result1 = mysql_query($str);
		$row1 = mysql_fetch_assoc($result1);
		$str33 = "SELECT id_user FROM users_site WHERE name_user = '" . $_SESSION['user_name'] . "'";
		$result33 = mysql_query($str33);
		$row33 = mysql_fetch_assoc($result33);
//		echo "SELECT max(completed) FROM purchases_site WHERE id_user = " . $row33['id_user'];
		$str2 = "SELECT max(completed) FROM purchases_site WHERE id_user = " . $row33['id_user'];
		$result2 = mysql_query($str2);
		$row2 = mysql_fetch_assoc($result2);
//		echo "UPDATE purchases_site SET completed =" . ($row2['max(completed)']+1) . " WHERE id_user = " . $row33['id_user'] . " and completed <> 1 " ;
		mysql_query("UPDATE purchases_site SET completed =" . ($row2['max(completed)']+1) . " WHERE id_user = " . $row33['id_user'] . " and completed <> 1 "  );
//		mysql_query("INSERT INTO completed_orders VALUES(" . ($row2['COUNT(*)']+1) . "," . $row33['id_user'] . "," . $row1['SUM(price_products)'] . ")");
		echo "
		<script> 
			alert('Сумма выбранных товаров " . $row1['SUM(price_products)'] . " Pублей.');
			alert(' Спасибо, что посетили наш магазин)).')
		</script>";
	}
?>