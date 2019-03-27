$(function(){
    $('#content').on("click","#add-cat", function(){
        console.log("category add");
        var formData = $('#cat-name').val(); 
        console.log(formData);
        $.ajax({
        type: 'post',
        url: 'controller/category_add.php',
        data: {'new-name':formData},
        success: function(results) {
            $('#results').html(results);
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
});