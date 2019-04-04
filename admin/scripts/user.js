$(function() {
    //Edit user
    $('#content').on("click",".edit-user", function(){
        console.log("user edit");
        var formData = $(this).data('id'); 
        console.log(formData);
        $.ajax({
        type: 'post',
        url: 'controller/user_edit.php',
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
    $('#content').on("click","#button-save-user", function(){
        var formData = {};
        console.log("user save");
        //console.log($("#cat-edit-name").val(),$("#cat-edit-title").val(),$("#cat-edit-desc").val())
        formData.id = $("#user-edit-id").val();
        formData.name = $("#user-edit-name").val();
        formData.phone = $("#user-edit-phone").val(); 
        formData.email = $("#user-edit-email").val();
        formData.city = $("#user-edit-city").val();
        formData.street = $("#user-edit-street").val();
        formData.building = $("#user-edit-building").val();
        formData.flat = $("#user-edit-flat").val();
        
        console.log(formData);
        console.log(JSON.stringify(formData));
        $.ajax({
        type: 'post',
        url: 'controller/user_save.php',
        data: formData,
        success: function(results) {
            $('#results').html(results);
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
    //Delete button
    $('#content').on("click","#button-delete-user", function () {
        var number_of_orders =  parseInt($(this).data('number-of-orders'),10);
        console.log(number_of_orders);
        if(number_of_orders == 0) {
        formData = {};
        console.log("user delete");
        formData.id = $("#user-edit-id").val();
        console.log("image id:",formData.img_id,"  product id:",formData.id);
        $.ajax({
            type:'post',
            url: 'controller/user_delete.php',
            data: formData,
            success: function(results) {
                $('#results').html(results);
            },
            error: function() {
                console.log('ajax error');
            }
            });
        }
        else 
        {
            $('#results').html("У данного пользователя есть заказы. Удаление невозможно.");
        }
    });
    //Cancel button
    $('#content').on("click","#button-cancel-user", function(){
        $('#content').load('controller/users.php');
    });
});