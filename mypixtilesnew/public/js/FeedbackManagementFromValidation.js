$(document).ready(function () {      
    var form = $('#category_form'); 
    $('.m-form__help').html('');    
    form.submit(function(e) { 
        $('.help-block').html('');        
        $('.m-form__help').html('');           
        $.ajax({
            url     : form.attr('action'),
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            async:false,
            success : function ( json )
            {                   
                return true; 
            },
            error: function( json )
            {           
                if(json.status === 422) {
                    e.preventDefault();
                    var errors_ = json.responseJSON;
                    $.each(errors_.errors, function (key, value) {
                        
                        $('.'+key).html(value);                       
                    });
                } 
            }
        });
    });
    $('.is_approve').hide();
    $('.pending').hide();
    $('.disapprove').hide();

    $('#m_table_2').on('click', '#btn_show', function (e) {
        var url_ = $(this).data('url');
        $.get(url_, function (data) {
            $('#user_name').val(data.feedback.user_name);
            $('#item_name').val(data.feedback.item_purchased);
            $('#email').val(data.feedback.email_id);
            $('#feedback_msg').html(data.feedback.feedback);
            if(data.feedback.approved_feedback=='Y'){
                $('.is_approve').show();
            }else if(data.feedback.approved_feedback=='P'){
                $('.pending').show();
            }else{
                $('.disapprove').show();
            }
            $('#m_typeahead_modal').modal('show');
        });
    });

    $('#m_table_2').on('click', '#approved_btn', function (e) {
        approve=$(this).data('approve');
        if(approve=='Y'){
            message='Are you sure want to inactivate this Record?';
        }else{
            message='Are you sure want to approve this Record?';
        }
        if(confirm(message)==false){
            e.preventDefault();
        }

    });

    $('#m_table_2').on('click', '#delete_btn', function (e) {
        if(confirm('Are you sure want to delete this Record?')==false){
            e.preventDefault();
        }
    });
    $('#m_table_2').on('click', '#is_active', function (e) {
        status=$(this).data('status');
        if(status=='Y'){
            message='Are you sure want to inactivate this Record?';
        }else{
            message='Are you sure want to activate this Record?';
        }
        if(confirm(message)==false){
            e.preventDefault();
        }
    });
  
});