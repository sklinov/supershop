<?php
require 'controller/db.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/admin.css">
	<script src="scripts/jquery-3.3.1.min.js"></script>
	<script src="scripts/jquery.maskedinput.js"></script>
	<title>Super Shop</title>
</head>
<body class="page">
	<div class="container">
		<div class="menu">
			<div class="menu__logo" id="menu__logo"><span class="menu__logo-line1">Super</span><br><span class="menu__logo-line2"> SHOP</span></div>
			<div class="menu__item" id="orders">Заказы</div>
			<div class="menu__item" id="user">Покупатели</div>
			<div class="menu__item" id="product">Товары</div>
			<div class="menu__item" id="category">Категории</div>
			<div class="menu__footer">admin@mail.ru</div>
			<div class="menu__footer">выйти</div>
		</div>
		<div class="content" id="content">
			<?php include 'controller/main.php'?>	
		</div>
	</div>
<script src="scripts/index.js"></script>
<script src="scripts/product.js"></script>
<script src="scripts/category.js"></script>
</body>
</html>