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
	$('#content').on("click","#selectcat", function(){
		   console.log("category chosen");
		   var formData = $('#catdropdown').val(); 
		   console.log(formData);
			 $.ajax({
		      type: 'post',
		      url: 'controller/product_list.php',
		      data: {'catdropdown':formData},
		      success: function(results) {
		        $('#results').html(results);
		      },
		      error: function() {
		      	console.log('ajax error');
		      }
	    	});
	});


});