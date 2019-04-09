$(function(){
	var stateObject = {};
	window.onpopstate = function(event) {
		History.back();	
	}
	History.back();
	
	$('#menu__logo').click(function(){
	 	console.log("Click menu logo");
		 $('#content').load('controller/main.php');
		 history.pushState(stateObject,"Main","main.html");
	});
	$('#orders, #orders-main').click(function(){
		console.log("Click order");
		$('#content').load('controller/orders.php');
		history.pushState(stateObject,"Order","order.html");
	});
	$('#user,#user-main').click(function(){
		console.log("Click user");
		$('#content').load('controller/users.php');
		history.pushState(stateObject,"User","user.html");
	});

	$('#product,#product-main').click(function(){
		console.log("Click product");
		$('#content').load('controller/product.php');
		history.pushState(stateObject,"Product","product.html");
	});

	$('#category,#category-main').click(function(){
		console.log("Click category");
		$('#content').load('controller/category.php');
		history.pushState(stateObject,"Category","category.html");
	});
});