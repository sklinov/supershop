$(function(){
	
	$('#menu__logo').click(function(){
	 	console.log("Click menu logo");
	 	$('#content').load('controller/main.php');
	});
	$('#orders, #orders-main').click(function(){
		console.log("Click order");
		$('#content').load('controller/orders.php');
	});
	$('#user,#user-main').click(function(){
		console.log("Click user");
		$('#content').load('controller/users.php');
	});

	$('#product,#product-main').click(function(){
		console.log("Click product");
		$('#content').load('controller/product.php');
	});

	$('#category,#category-main').click(function(){
		console.log("Click category");
		$('#content').load('controller/category.php');
	});
});