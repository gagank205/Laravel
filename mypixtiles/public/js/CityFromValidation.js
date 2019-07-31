$(document).ready(function () {      
    var form = $('#city_form'); 
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
    $('#country_id').on('change',function(){
        var country=$('#country_id').val();
        $('#state_id').html("<option hidden value=''>Select State</option>");        
        $.ajax({
            
            url  :$('#ajax_route').val()+'/'+country,
            type :'GET',
            dataType:'json',
            async:false,
            success : function ( data )
            {                   
                $.each(data, function (key, value) {     
                    $('#state_id').append("<option value='"+value.id+"'>"+value.name+"</option>");
                });
            },
            error: function( json )
            {
                alert('error');
            }

        })
    });
    $('#m_table_2').on('click', '#delete_btn', function (e) {
        url_=$(this).data('remote');
        if(confirm('Are you sure want to delete this Record?')){
            window.location.href=url_;
        }        
    });
    $('#m_table_2').on('click', '.btn-status', function (e) {
        status=$(this).data('status')
        if(status=='Y'){
            message='Are you sure you want to deactivate this Record?';
        }else{
            message='Are you sure you want to activate this Record?';
        }
        if(confirm(message)==false){
            e.preventDefault();
        }
        
    });
    $('#reset').on('click',function(e){
        e.preventDefault();
        $('#m_table_2').DataTable().search('').draw();
    })
 
});