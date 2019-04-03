$(function(){
    // ----PRODUCT LIST PAGE
    var product_list = function() {
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
    };
    $('#content').on("change","#catdropdown", product_list);
    $('#content').on("load", product_list);

    // $('#content').on("click","#selectcat", function(){
    //     console.log("category chosen");
    //     var formData = $('#catdropdown').val(); 
    //     console.log(formData);
    //     $.ajax({
    //     type: 'post',
    //     url: 'controller/product_list.php',
    //     data: {'catdropdown':formData},
    //     success: function(results) {
    //         $('#results').html(results);
    //     },
    //     error: function() {
    //         console.log('ajax error');
    //     }
    //     });
    // });

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
    //Upload image
    $('#content').on("click","#img-upload", function () {
        console.log("file upload");
        var file_data = $('#img-upload-file').prop('files')[0];
        var formData = new FormData("pr-edit");
        //formData.id = $("#pr-edit-id").val();
        formData.append('file', file_data);
        //console.log(formData.file);
        $.ajax({
            type:'post',
            url: 'controller/product_image_upload.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(results) {
                $('#results').html(results);
            },
            error: function() {
                console.log('ajax error');
            }
            });
    }); 
    //Save button
    $('#content').on("click","#button-save-product", function(){
        var formData = {};
        console.log("product save");
        //console.log($("#cat-edit-name").val(),$("#cat-edit-title").val(),$("#cat-edit-desc").val())
        formData.id = $("#pr-edit-id").val();
        formData.name = $("#pr-edit-name").val();
        formData.description = $("#pr-edit-desc").val(); 
        formData.sku = $("#pr-edit-sku").val();
        formData.price = $("#pr-edit-price").val();
        formData.old_price = $("#pr-edit-old-price").val();
        formData.quantity = $("#pr-edit-quantity").val();
        formData.badge = $("input[name='pr-edit-badge']:checked").val(); 
        console.log(formData);
        console.log(JSON.stringify(formData));
        $.ajax({
        type: 'post',
        url: 'controller/product_save.php',
        data: formData,
        success: function(results) {
            $('#results').html(results);
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
    //Cancel button
    $('#content').on("click","#button-cancel-product", function(){
        $('#content').load('controller/product.php');
    });
})