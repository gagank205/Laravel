$(document).ready(function (){

    var ext=['image/png','image/jpg','image/jpeg'];
    $('.m-form__help').html('');
    var file_length_flag=true;  
    var email_length_flag=true;
    
    var form = $('#user_form');
    $('.m-form__help').html('');
    form.submit(function(e) {
        $('.help-block').html('');        
        $('.m-form__help').html('');           
        $('.user_image').html('');
            
            if($("input[name='_method']").val()=='post'){          
                if(($('#file-1').get(0).files.length<=0)){
                    file_length_flag=false;                
                    $('.user_image').html('Please select user profile image');
                    $('.user_image').show();                
                }else if($.inArray($('#file-1').get(0).files[0].type,ext)<0 || $('#file-1').get(0).files[0].type==''){             
                    file_length_flag=false;
                    $('.user_image').html('Please select valid profile image');
                    $('.user_image').show();                             
                }else{
                    $('.user_image').html('');
                    file_length_flag=true;
                }    
            }else{           
                    file_length_flag=true;
            }

        $.ajax({
            url     : form.attr('action'),
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            async:false,
            success : function ( json )
            {                   
                if(file_length_flag==true){                    
                    return true;    
                }else{                    
                    e.preventDefault();
                    return false;    
                }
            },
            error: function( json )
            {           
                if(json.status === 422) {                    
                    e.preventDefault();
                    var errors_ = json.responseJSON;
                    $.each(errors_.errors, function (key, value) {                                               
                        $('.'+key).html(value);
                    });
                }else{
                     if(file_length_flag!=true || email_length_flag!=true){                        
                        e.preventDefault();
                     }                    
                }
            }
        });
    });

    $('#m_table_2').on('click', '#data_show', function (e) {
        var url_ = $(this).data('url');
        var public_path = $(this).data('public_path');
        $.get(url_, function (data) {
            $('#f_name').val(data.user.first_name);
            $('#l_name').val(data.user.last_name);
            $('#email').val(data.user.email);
            $('#dob').val(data.user.dob);
            $('#contact_num').val(data.user.contact_number);
            $('#user_role').val(data.userrole.name);
            $('.active').hide();
            $('.inactive').hide();
            $('.pending').hide();
            if(data.user.approved_member=='Y'){
                $('.active').show();
            }else if(data.user.approved_member=='P'){
                $('.pending').show();
            }else{
                $('.inactive').show();
            }
            var img = data.user.image;
            if(img){
                var image_path = public_path + "/" + img;
            }
            else{
                var image_path = public_path + "/default_image.png";
            }
            $('#user_image').attr('src',image_path);
            $('#m_typeahead_modal').modal('show');
        });
    });

    $('#m_table_2').on('click', '#delete_btn', function (e) {
        if(confirm('Are you sure want to delete this Record?')==false){
            e.preventDefault();
        }
    });

    $('#m_table_2').on('click', '#is_active', function (e) {
        status=$(this).data('status');
        if(status=='Y'){
            message='Are you sure you want to inactivate this Record?';
        }else{
            message='Are you sure you want to activate this Record?';
        }
        if(confirm(message)==false){
            e.preventDefault();
        }
    });

    $('#m_table_2').on('click', '#approved_btn', function (e) {
        approve=$(this).data('approve');
        if(approve=='Y'){
            message='Are you sure you want to block this Record?';
        }else{
            message='Are you sure you want to unblock this Record?';
        }
        if(confirm(message)==false){
            e.preventDefault();
        }
    });
    
}); 