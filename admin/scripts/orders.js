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
});