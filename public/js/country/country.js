function editCountry(id, name){
     $("#txtCountryEdit").val(name);
     $("#countryID").val(id);
     $("#editCountry").modal('show');
}

function fillCountries(){
  $( "#countries" ).empty();
  $( "#countries" ).append("<img src='" + loadingImageUrl + "'/>");
  $.ajax({
    type:'GET',
    url:showCountryUrl,
    success:function(data){
      $( "#countries" ).empty();
      $("#countries").append(data);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
        $( "#countries" ).empty();
        $( "#countries" ).append("Сервертэй холбогдоход алдаа гарлаа.");
    }
  });
}

$(document).ready(function(){
  $("#frmNewCountry").keypress(function(e) {
      if(e.which == 13) {
          $('#btnNewCountry').click();
      }
  });
});

$(document).ready(function(){
  $("#btnNewCountry").click(function(){
    var proceed = true;
    if($("#txtCountryNew").val() == ""){
      alertify.error('Улсын нэр талбар хоосон байна.');
      proceed = false;
    }
    if(proceed){
      var csrf = $('meta[name=csrf-token]').attr("content");
      $.ajax({
        type:'POST',
        url:newUrl,
        data:{
          _token: csrf,
          txtCountryNew:$("#txtCountryNew").val()
        },
        success:function(data){
          alertify.alert(data);
          fillCountries();
          fillCountriesSelect();
          $("#txtCountryNew").val("");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
        }
      });
    }
  });
});



$(document).ready(function(){
  $("#frmEditCountry").keypress(function(e) {
      if(e.which == 13) {
          $('#btnEditCountry').click();
      }
  });
});

$(document).ready(function(){
  $("#btnEditCountry").click(function(e){
    e.preventDefault();
    var proceed = true;
    if($("#txtCountryEdit").val() == ""){
      alertify.error('Улсын нэр талбар хоосон байна.');
      proceed = false;
    }
    if(proceed){
      // var data = $("#frmEditCountry").serialize();
      // alert(data);
      //var data = $('#frmEditCountry').find('input').serialize();
      var csrf = $('meta[name=csrf-token]').attr("content");
      $.ajax({
        type:'POST',
        url:editUrl,
        data:{_token: csrf, countryID : $("#countryID").val(), txtCountryEdit:$("#txtCountryEdit").val()},
        success:function(data){
          $("#editCountry").modal('hide');
          alertify.alert(data);
          fillCountries();
          fillCountriesSelect();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
        }
      });
    }
  });
});



function deleteCountry(id){
  alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
    if (e) {
      var csrf = $('meta[name=csrf-token]').attr("content");
      $.ajax({
          type: 'POST',
          url: deleteUrl,
          data: {_token: csrf, countryID : id},
          success:function(data){
              alertify.alert("Амжилттай устлаа.");
              fillCountries();
              fillOperations();
              fillCountriesSelect();
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
              alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
          }
      })
    } else {
        alertify.error('Устгах үйлдэл цуцлагдлаа.');
    }
  });
}


function fillCountriesSelect(){
  $('#cmbCountryName')
    .find('option')
    .remove();
  $('#cmbEditCountry')
    .find('option')
    .remove();

    $.ajax({
        type: 'get',
        url: getCountriesUrl,
        success:function(response){
          $.each(response, function (key, value) {
              $('#cmbCountryName')
                  .append($("<option></option>")
                  .attr("value", value)
                  .text(key));
          });
          $.each(response, function (key, value) {
              $('#cmbEditCountry')
                  .append($("<option></option>")
                  .attr("value", value)
                  .text(key));
          });
        }
    });
}
