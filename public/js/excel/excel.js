$(document).ready(function(){
    $("#country").change(function(){
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'get',
            url: getEeljUrl,
            data: {_token: csrf, country:$("#country").val()},
            success:function(response){
              $("select[name='eelj']").prop('disabled', false).find('option[value]').remove();
              $("select[name='eelj']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("select[name='eelj']")
                      .append($("<option></option>")
                      .attr("value", key)
                      .text(key));
              });
            }
        });
    });
});
