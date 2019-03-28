$(function(){
    //Add category 
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
    //Delete category
    $('#content').on("click","#del-cat", function(){
        console.log("category delete");
        var formData = $(this).data('cat-id'); 
        console.log(formData);
        $.ajax({
        type: 'post',
        url: 'controller/category_delete.php',
        data: {'cat-id':formData},
        success: function(results) {
            $('#results').html(results);
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
    //Edit category
    $('#content').on("click","#button-save", function(){
        var formData = [];
        console.log("category save");
        console.log($("#cat-edit-name").val(),$("#cat-edit-title").val(),$("#cat-edit-desc").val())
        formData.id = $("#cat-edit-id").val();
        formData.name = $("#cat-edit-name").val();
        formData.title = $("#cat-edit-title").val(); 
        formData.desciption = $("#cat-edit-desc").val();  
        console.log(formData);
        $.ajax({
        type: 'post',
        url: 'controller/category_save.php',
        data: { 'id': formData.id,
                'name' :formData.name,
                'title':formData.title,
                'description':formData.desciption
        },
        success: function(results) {
            $('#results').html(results);
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
    //Cancel button
    $('#content').on("click","#button-cancel", function(){
        $('#content').load('controller/category.php');
    });

    //Load category
    $('#content').on("click","#edit-cat", function(){
        console.log("category edit");
        var formData = $(this).data('cat-id'); 
        console.log(formData);
        $.ajax({
        type: 'post',
        url: 'controller/category_edit.php',
        data: {'cat-id':formData},
        success: function(results) {
            $('#content').html(results);
        },
        error: function() {
            console.log('ajax error');
        }
        });
    });
});