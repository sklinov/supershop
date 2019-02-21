<?php

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/admin.css">
	<script src="scripts/jquery-3.3.1.min.js"></script>
	<script src="scripts/jquery.maskedinput.js"></script>
	<script src="scripts/script.js"></script>
	<title>Super Shop</title>
</head>
<body class="page">
	<div class="container">
		<div class="menu">
			<div class="menu__logo"><span class="menu__logo-line1">Super</span><br><span class="menu__logo-line2"> SHOP</span></div>
			<div class="menu__item">Заказы</div>
			<div class="menu__item">Покупатели</div>
			<div class="menu__item">Товары</div>
			<div class="menu__item">Категории</div>
			<div class="menu__footer">admin@mail.ru</div>
			<div class="menu__footer">выйти</div>
		</div>
		<div class="content">
			<?php
				include 'controller/product.php';
			?>	
		</div>
	</div>

</body>
</html>