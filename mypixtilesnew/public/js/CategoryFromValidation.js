$(document).ready(function () {  
    var ext=['image/png','image/jpg','image/jpeg'];
    $('.m-form__help').html('');
    var file_length_flag=true;
    
    var form = $('#category_form'); 
    $('.m-form__help').html('');
    
    form.submit(function(e) {
        $('.help-block').html('');      
        $('.m-form__help').html('');
        $('.category_icon').html('');
            
            if($("input[name='_method']").val()=='post'){
                if(($('#cat_icon').get(0).files.length<=0)){
                    file_length_flag=false;                
                    $('.category_icon').html('Please select category icon');
                    $('.category_icon').show();                
                }else if($.inArray($('#cat_icon').get(0).files[0].type,ext)<0 || $('#cat_icon').get(0).files[0].type==''){             
                    file_length_flag=false;
                    $('.category_icon').html('Please select valid category icon');
                    $('.category_icon').show();
                }else{
                    $('.category_icon').html('');
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
  
});