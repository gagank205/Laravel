$(document).ready(function (){
    checkBox();
    var form = $('#userrole_form'); 
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
        $('#m_table_2').on('click', '#delete_country', function (e) {
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
    $('#reset').on('click',function(e){
        e.preventDefault();
        $('#m_table_2').DataTable().search('').draw();
    });
});
//check all checkbox 
$(".module_class").on("click", function(){

        var chk_class=($(this).data('class'));
        var chk_flag=($(this).data('check'));       
        clicked=chk_flag;                       
        $(this).data('check',!clicked);
        $("."+chk_class).prop("checked", !clicked);
        checkBox();
});
$('.action_').click(function(){
    checkBox();
});

function checkBox(){
    $.each($('.module_action_checkbox'),function(key,val){
        if($(this).find('.action_:checked').length>0){
            $(this).find('.module_class').prop('checked',true);
        }else{
            $(this).find('.module_class').prop('checked',false);
        }
    });
}