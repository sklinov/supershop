$(function(){
    // ----PRODUCT LIST PAGE
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
    //Edit product
    $('#content').on("click","#edit-pr", function(){
        console.log("product edit");
        var formData = $(this).data('id'); 
        console.log(formData);
        $.ajax({
        type: 'post',
        url: 'controller/product_edit.php',
        data: {'id':formData},
        success: function(results) {
            $('#content').html(results);
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
    // ----EDIT PAGE
    //Cancel button
    $('#content').on("click","#button-cancel-product", function(){
        $('#content').load('controller/product.php');
    });
})