<?php
	session_start();
	$back = $_SERVER['HTTP_REFERER'];
	$con = mysql_connect($_SESSION['host'],$_SESSION['name'],$_SESSION['password']);
	mysql_select_db($_SESSION['database'],$con);
	mysql_query("SET NAMES 'utf8'");
?>
<html>
<head>
	<title></title>
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
			top: -10px;
			color: #0000FF;
			border-radius: 40px;
			font-size: 17px;
			font-weight: 600;
		}
		.style_button_add {
			position: relative;
			left: 70px;
			top: -10px;
			color: #0000FF;	
			background: rgba(210,210,210,1);
			font-size: 19px;
			text-decoration: none;
			border: 1px solid #333;
			padding: 5px 15px;
			font-weight: 600;
			border-radius: 40px;
		}
		#window_new_product {
			overflow-y: auto;
			border-radius: 40px;
			background: rgba(255,153,51,1);
			width: 250px;
			height: 400px;
			position: fixed;
			top: 290px;
			left: 10px;
			display: none;
		}
		#window_new_product::-webkit-scrollbar{
			height: 80px;
			width: 10px;
			position: relative;
		}
		#window_new_product:target {display: block;}
		.style_close {
			position: relative;
			top: 40px;
			color: #0000FF;	
			background: rgba(210,210,210,1);
			font-size: 15px;
			text-decoration: none;
			font-weight: 600;
		}
		.style_edit {
			width: 200px;
			height: 30px;
			border-radius: 40px;
			font-size: 20px;
			position: relative;
			left: 20px;
			top: 40px;
		}
		#window_update_price {
			border-radius: 40px;
			background: rgba(255,153,51,1);
			width: 250px;
			height: 250px;
			position: fixed;
			top: 230px;
			left: 50px;
			display: none;
		}
		#window_update_price:target {display: block;}
		.style_close_2 {
			position: relative;
			color: #0000FF;
			background: rgba(210,210,210,1);
			font-size: 15px;
			text-decoration: none;
			font-weight: 600;
			top: -10px;
			left: 20px;
		}
		.style_edit_update {
			width: 150px;
			height: 20px;
			border-radius: 40px;
			font-size: 20px;
			position: relative;
			left: 50px;
			top: -10px;
		}
		.style_checkbox {
			transform: scale(1.9);
			float: left;
		}
		.style_update {
			background: rgba(255,153,51,1);
			position: fixed;
			color: #0000FF;	
			border: 1px solid #333;
			padding: 3px 15px;
			font-weight: 600;
			text-decoration: none;
			border-radius: 40px;
			font-size: 15px;
			top: 250px;
			left: 100px;
		}
		.type_tovar{
			position: relative;
			left: 50px;
			top : 80px;
			width: 150px;
			height: 30px;
		}
		.type_tovar_{
			position: relative;
			left: 400px;
			top : -230px;
			width: 150px;
			height: 30px;
		}
		.style_textarea{
			position: relative;
			top: 40px;
			left: 10px;
		}
		.style_forms_type{
			position: relative;
			top: 30px;
			left: 600px;
		}
		.style_type_tovar{
			position: relative;
			top: 40px;
			left: -600px;
			transform: scale(1.3);
			font-weight: 600;
		}
		.style_type_tovar2{
			transform: scale(1);
			font-weight: 10;
		}
		#add_product{
			position: relative;
			top: -70px;
		}
		#style_table{
			width: 1000px;
			height: 600px;
			overflow: auto;
			position: relative;
			left: 400px;
			top: -100px;
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
	</style>
<script>
	function update(){
		var save = document.getElementById("save1");
		var id = document.getElementById("id_product1");
		var new_price = document.getElementById("new_price_product1");
		if((id.value.length == 0) || (new_price.value.length == 0)) save.disabled = true;
		else save.disabled = false;
	}
	function change(){
		var type = document.getElementById("type");
		var forms = document.getElementById("add_product");
		var textarea_ = document.getElementById("new_product_other1");
		if(type.value == "smartphone"){
			var p1 = document.createElement("p");
			var osn_camera_tovara = document.createElement("input");
				osn_camera_tovara.name = "osn_camera_new_product";
				osn_camera_tovara.id = "osn_camera_new_product1";
				osn_camera_tovara.placeholder = "Основная камера";
				osn_camera_tovara.title = "КОЛИЧЕСТВО МП ОСНОВНОЙ КАМЕРЫ";
				osn_camera_tovara.className = "style_edit";
				osn_camera_tovara.onkeyup = function(){add();};
			p1.appendChild(osn_camera_tovara);
			forms.insertBefore(p1,textarea_);
//			forms.appendChild(p1);

			var p2 = document.createElement("p");
			var front_camera_tovara = document.createElement("input");
				front_camera_tovara.name = "front_camera_new_product";
				front_camera_tovara.id = "front_camera_new_product1";
				front_camera_tovara.placeholder = "Фронтальная камера";
				front_camera_tovara.title = "КОЛИЧЕСТВО МП ФРОНТАЛЬНОЙ КАМЕРЫ";
				front_camera_tovara.className = "style_edit";
				front_camera_tovara.onkeyup = function(){add();};
			p2.appendChild(front_camera_tovara);
			forms.insertBefore(p2,textarea_);
//			forms.appendChild(p2);
		}
		if((type.value == "laptop") && (forms.length == 13)) {
			forms[11].remove();
			forms[10].remove();
		}
			add();
	}
	function add(){
		var save = document.getElementById("save_tovar");
		var type = document.getElementById("type");
		var name = document.getElementById("name_new_product1");
		var price = document.getElementById("price_new_product1");
		var creater = document.getElementById("creater_new_product1");
		var processor = document.getElementById("processor_new_product1");
		var diag = document.getElementById("diag_new_product1");
		var razresh = document.getElementById("razresh_new_product1");
		var OC = document.getElementById("OC_new_product1");
		var memory = document.getElementById("Memory_new_product1");

		var front = document.getElementById("front_camera_new_product1");
		var osn = document.getElementById("osn_camera_new_product1");
		if(type.value == "No"){
			save.disabled = true;
		}
		else{
			if((name.value.length != 0) && (price.value.length != 0) && (creater.value.length != 0) && (processor.value.length != 0) && (diag.value.length != 0)){
				if((razresh.value.length != 0) && (OC.value.length != 0) && (memory.value.length != 0)){
					if(type.value == "smartphone"){
						if((front.value.length != 0) && (osn.value.length != 0)) {
							save.disabled = false;
						}
						else save.disabled = true;
					}
					if(type.value == "laptop") save.disabled = false;
				}
				else save.disabled = true;
			}
			else save.disabled = true;
		}
	}
</script>
<body>
	<form method="post" class="style_forms_type" id = "forms_type"  name="name_forms_type_tovar">
		<label style="position: relative; top: -1px; left: -1px; font-weight: 600;">Выберете тип товара, который покажет таблица :</label>
		<input type="submit" name="laptop_" value="Ноутбуки">
		<input type="submit" name="smartphone_" value="Смартфоны">
	</form>
	<?php
		if(isset($_POST['laptop_'])) $_SESSION['type']='laptop_';
		if(isset($_POST['smartphone_'])) $_SESSION['type']='smartphone_';
		$result = mysql_query("SELECT * FROM products_site WHERE id_products IN (SELECT id FROM " . $_SESSION['type'] . "site)");
	?>
	<form method="post">
		<p><input type="submit" class="style_button" value=" Вернуться на предыдущую страницу " name="Return"></p>
		<p><a href="#window_new_product" class="style_button_add">Добавить новый товар</a></p>
	</form>
	<div id = "window_new_product">
		<form method="post" action="addproduct.php" id="add_product">
			<font size="4"><p align="center" style="position: relative; top: 110px;"><b> ТИП ТОВАРА: </b></p></font>
			<a href="#" class="style_close"><div>Закрыть</div></a>
			<p>
				<select name="type_tovar" class="type_tovar" onchange="change()" id="type">
					<option value="No">Не выбрано</option>
					<option value="laptop">Ноутбук</option>
					<option value="smartphone">Смартфон</option>
				</select>
			</p>
			<font size="4"><p align="center" style="position: relative; top: 90px;"><b> ИНФОРМАЦИЯ О ТОВАРЕ: </b></p></font>
			<input type="submit" name = "save" id="save_tovar" value="Сохранить" disabled 
				style="position: relative; left: 75px; top: 650px; width: 100px; height: 30px;">
			<p><input class="style_edit" type='text' name='name_new_product' id = "name_new_product1"
				onkeyup="add()" placeholder="Наименование" title="Имя товара"></p>
			<p><input class="style_edit" type='text' name='price_new_product' id = "price_new_product1" 
				onkeyup="add()" placeholder="Цена(в Руб)" title="Цена товара. Формат: цифры(0-9). Результат: целое число"></p>
			<p><input class="style_edit" type='text' name='creater_new_product'id = "creater_new_product1" 
				onkeyup="add()" placeholder="Производитель" title="Производитель товара"></p>
			<p><input class="style_edit" type='text' name='processor_new_product' id = "processor_new_product1" 
				onkeyup="add()" placeholder="Процессор" title="Модель процессора товара"></p>
			<p><input class="style_edit" type='text' name='diag_new_product' id = "diag_new_product1" 
				onkeyup="add()" placeholder="Диагональ" title="Диагональ экрана. Формат: цифры(0-9). Результат: целое число"></p>
			<p><input class="style_edit" type='text' name='razresh_new_product' id = "razresh_new_product1" 
				onkeyup="add()" placeholder="Разрешение экрана" title="Разрешение экрана. Формат: цифры(0-9) * цифры(0-9). Результат: целое число * целое число"></p>
			<p><input class="style_edit" type='text' name='OC_new_product' id = "OC_new_product1"
				onkeyup="add()" placeholder="ОС" title="Операционна Система товара"></p>
			<p><input class="style_edit" type='text' name='Memory_new_product' id = "Memory_new_product1" 
				onkeyup="add()" placeholder="Объем памяти(в Гб)" title="Объем оперативной памяти товара. Формат: цифры(0-9). Результат: целое число"></p>
			<textarea name="new_product_other" cols="30" rows="5" class="style_textarea" id="new_product_other1" 
				placeholder="Другая информация о товаре" title="Остальная информация о товаре"></textarea>
		</form>
	</div>
	<form method="post" action="save_product.php">
		<p><input type="submit" class="style_button" value=" Сохранить " name="Save_"></p>
<!--/////////////////////////////////////////////////////////-->
			<div id="style_table">
				<table border="2" width="1000" cellspacing="2" cellpadding="10" id='myTable'>
					<caption>Таблица продуктов сайта</caption>
					<tr>
						<th>ИД Товара</th>
						<th>Фото Товара</th>
						<th>Имя Товара</th>
						<th>Цена Товара</th>
					</tr>
				<?php while($row = mysql_fetch_assoc($result)) { ?>
					<tr>
						<td align="center">
							<input type='checkbox' class='style_checkbox' name="check_[]" value="<?php echo ($row['id_products']) ?>">
							<?php echo ($row['id_products']) ?>
						</td>
						<td align="center"><img src="Image/<?php echo ($row['name_products'] . '.jpg') ?>"> </td>
						<td align="center"><?php echo ($row['name_products']) ?></td>
						<td align="center">
							<?php echo ($row['price_products']) ?>		
						</td>
					</tr>
				<?php }?>
				</table>
			</div>
<!--/////////////////////////////////////////////////////////-->
		<a href = "#window_update_price" class="style_update"> Изменить цену </a>
	</form>
	<div id = "window_update_price">
		<form method="post">
			<input type="submit" name = "save_update" value="Сохранить" id="save1" disabled
				style="position: relative; left: 75px; top: 230px; width: 100px; height: 20px;">
			<a href="#" class="style_close_2"><div>Закрыть</div></a>
			<font size="3"><p align="center" style="position: relative; top: -10px; left: 3px;"><b> ИД Товара: </b></p></font>
			<input class="style_edit_update" type='text' name='id_product' id="id_product1" onkeyup="update()">
			<font size="3"><p align="center" style="position: relative; top: -10px; left: 3px;"><b> Новая Цена: </b></p></font>
			<input class="style_edit_update" type='text' name='new_price_product' id="new_price_product1" onkeyup="update()">
		</form>
	</div>
</body>
</html>
<?php	
	if(isset($_POST['Return'])){ 
		echo '
		<html>
			<head>
				<meta http-equiv="Refresh" content="0; URL=admin_page.php">
			</head>
		</html>
		';
	}
	if(isset($_POST['save_update'])){
		$str3 = "UPDATE products_site SET price_products = " . $_POST['new_price_product'] . " WHERE id_products =" . $_POST['id_product'];
		mysql_query($str3);
		echo "<script> alert('Новая цена успешно установлена ') </script>";
		echo "
		<html>
			<head>
				<meta http-equiv='Refresh' content='0; URL=List_Products.php'>
			</head>
		</html>
		";
	}
?>
