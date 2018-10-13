$(document).ready(function(){
    $('.languageSwitcher').change(function(){
        var locale = $(this).val();
        var _tocken = $('input[name=_tocken]').val();
        $.ajax({
            url:"/language",
            type:'POST',
            data:{locale:locale,_tocken:_tocken},
            datatype:'json',
            success:function(data){},
            error:function(data){},
            beforeSend:function(data){},
            complete:function(data){
                window.location.reload(true);
            }
        });
    });
});
