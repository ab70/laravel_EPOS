$(document).ready(function () {
    $('#myForm input').on('change',function(){
        var setvalue = $("[type='radio']:checked").val();
        $('#setvalue').val($("[type='radio']:checked").val());
    });
});