$(document).ready(function(){
  $("select[name='unit']").change(function () {
        var unit = $("select[name='unit']").val();
        if(unit !== '' && unit !== null){
            $("select[name='rank']").prop('disabled', false).find('option[value]').remove();
            fillRankname(unit);
        }
        else{
            $("select[name='arrangement']").prop('disabled', false).find('option[value]').remove();
        }
        //alert(generalArrangement);
    });
});


function fillRankname(unit){
  $.ajax({
      type: 'get',
      url: '{{ url('/get/rank') }}',
      data: {rankType:unit},
      success:function(response){
        $.each(response, function (key, value) {
            $("select[name='bag']")
                .append($("<option></option>")
                .attr("value", value)
                .text(key));
        });
      }
  });
}
