$(function(){
    $('#content').on("click","#cat-add", function(){
        console.log("category add");
        var formData = $('#add-cat').val(); 
        console.log(formData);
        $.ajax({
        type: 'post',
        url: 'controller/category.php',
        data: {'new-name':formData},
        success: function(results) {
            console.log('success');
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
});