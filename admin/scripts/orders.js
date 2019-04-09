$(function() {
    //Edit order
    $('#content').on("click",".edit-order", function(){
        console.log("order edit");
        var formData = $(this).data('id'); 
        console.log(formData);
        $.ajax({
        type: 'post',
        url: 'controller/order_edit.php',
        data: {'id':formData},
        success: function(results) {
            $('#content').html(results);
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
    //Save button
    $('#content').on("click","#button-save-order", function(){
        console.log("order save");
        var formData = {};
        // Process products, totals
        var id_product = $("input[name='order-edit-product-id']").map(function() {
            return $(this).val();
        }); 
        formData.id_product = Array.from(id_product);
        var product_quantity = $("input[name='order-edit-product-quantity']").map(function() {
            return $(this).val();
        });
        formData.product_quantity = Array.from(product_quantity);
        var product_price = $("input[name='order-edit-product-price']").map(function() {
            return $(this).val();
        });
        formData.product_price = Array.from(product_price);
        // Refresh total 
        formData.total=0;
            for(i=0;i<formData.id_product.length;i++)
            {
                formData.total+=formData.product_quantity[i]*formData.product_price[i];
            }
        // Other order input values
        formData.id = $("#order-edit-id").val();
        formData.id_user = $("#order-edit-id-user").val();
        formData.id_status = $(".status-option:selected").val();
        console.log(formData.id_status);
        formData.name = $("#order-edit-name").val();
        formData.phone = $("#order-edit-phone").val(); 
        formData.email = $("#order-edit-email").val();
        formData.city = $("#order-edit-city").val();
        formData.street = $("#order-edit-street").val();
        formData.building = $("#order-edit-building").val();
        formData.flat = $("#order-edit-flat").val();
        //formData.total = $("#order-edit-total").val();
        formData.id_shipping = $(".shipping-option:selected").val();
        formData.comment = $("#order-edit-comment").val();
        console.log(formData);
       
        // AJAX

        $.ajax({
        type: 'post',
        url: 'controller/order_save.php',
        data: formData,
        success: function(results) {
            $('#results').html(results);
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
    //Remove item
    // $('#content').on("click", $(".product-delete"), function(event){
    //     console.log(event.target);
    //     if(event.target.closest(".products")) {
    //         event.target.closest(".products").remove();
    //     }
    // });


    //Change in quantity
    $('#content').on("change", $("input[name='order-edit-product-quantity']"), function(){
        $('.products').each(function(){
            console.log($(this));
            var q = $(this).find($("input[name='order-edit-product-quantity']")).val();
            var p = $(this).find($("input[name='order-edit-product-price']")).val();
            var sum = q * p; 
            $(this).find("#order-edit-product-sum").html(sum);
        });
        
        //Count new total
        var total=0;
        var product_quantity = $("input[name='order-edit-product-quantity']").map(function() {
            return $(this).val();
        });
        var product_price = $("input[name='order-edit-product-price']").map(function() {
            return $(this).val();
        });
        for(i=0;i<product_quantity.length;i++)
        {
            total+=product_quantity[i]*product_price[i];
        }

        //Assign new values
        $("#order-total").html(total);
        $("#order-edit-total").val(total);  
    });
});