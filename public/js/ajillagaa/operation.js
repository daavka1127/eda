var checkOperationNew = false;

function editOperation(id, countryID, eelj, leaveDate, arriveDate){
    $('option[value=' + countryID + ']')
           .attr('selected',true);
     $("#txtEditEelj").val(eelj);
     $("#single_cal3").val(leaveDate);
     $("#single_cal4").val(arriveDate);
     $("#opirationID").val(id);
     $("#editOperation").modal('show');
}

$(document).ready(function(){
    $("#cmbCountryName").change(function(){
      if($("#cmbCountryName").val() != -1 && $("#txtNewEelj").val() != ""){
        var csrf = $('meta[name=csrf-token]').attr("content");
        checkOperation(csrf, $("#cmbCountryName").val(), $("#txtNewEelj").val());
      }
    });
    $("#txtNewEelj").keyup(function(){
      if($("#cmbCountryName").val() != -1 && $("#txtNewEelj").val() != ""){
        var csrf = $('meta[name=csrf-token]').attr("content");
        checkOperation(csrf, $("#cmbCountryName").val(), $("#txtNewEelj").val());
      }
    });
});

function checkOperation(csrf, country, eelj){
    $("#error_message").empty();
    $("#error_message").append('<img width="30" src="' + loading_smallImageUrl + '" /> <label class="control-label">Уншиж байна...</label>');
    $.ajax({
      type:'POST',
      url:checkOperationInsert,
      data:{_token: csrf, country: country, eelj: eelj},
      success:function(data){
          if(data > 0){
            checkOperationNew = false;
            $("#error_message").empty();
            $("#error_message").append('<img width="30" src="' + wrongImageUrl + '" /> <label class="control-label">Бүртгэлтэй байна</label>');
          }
          else{
            checkOperationNew = true;
            $("#error_message").empty();
            $("#error_message").append('<img width="30" src="' + correctImageUrl + '" /> <label class="control-label">Боломжтой байна</label>');
          }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          checkOperationNew = false;
          $("#error_message").empty();
          $("#error_message").append('<img width="30" src="' + wrongImageUrl + '" /> <label class="control-label">Алдаа гарлаа.</label>');
      }
    });
    return checkOperationNew;
}

function fillOperations(){
  $( "#operations" ).empty();
  $( "#operations" ).append("<img src='" + loadingImageUrl + "'/>");
  $.ajax({
    type:'GET',
    url:showOperationUrl,
    success:function(data){
      $( "#operations" ).empty();
      $("#operations").append(data);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
        $( "#operations" ).empty();
        $( "#operations" ).append("Сервертэй холбогдоход алдаа гарлаа.");
    }
  });
}

$(document).ready(function(){
  $("#frmNewOperation").keypress(function(e) {
      if(e.which == 13) {
          $('#btnNewOperation').click();
      }
  });
});

$(document).ready(function(){
  $("#btnNewOperation").click(function(){
    var proceed = true;
    if($("#cmbCountryName").val() == -1){
      alertify.error('Улсын нэр талбараа сонгоно уу!');
      proceed = false;
    }
    if($("#txtNewEelj").val() == ''){
      alertify.error('Ээлжийн дугаараа оруулна уу!');
      proceed = false;
    }
    if($("#single_cal1").val() == ''){
      alertify.error('Явсан өдрөө оруулна уу!');
      proceed = false;
    }
    if($("#single_cal2").val() == ''){
      alertify.error('Ирсэн өдрөө дугаараа оруулна уу!');
      proceed = false;
    }
    if(checkOperationNew == false){
      alertify.error('Энэ ээлж бүртгэлтэй байна!');
      proceed = false;
    }
    var csrf = $('meta[name=csrf-token]').attr("content");
    if(proceed){
      // var data = $("#frmNewOperation").serialize();
      $.ajax({
        type:'POST',
        url:newOperationUrl,
        data:{_token: csrf, country: $("#cmbCountryName").val(), eelj: $("#txtNewEelj").val(), leaveDate: $("#single_cal1").val(), arriveDate: $("#single_cal2").val()},
        success:function(data){
          alertify.alert(data);
          fillOperations();
          $("#cmbCountryName").val(-1);
          $("#txtNewEelj").val('');
          $("#single_cal1").val('');
          $("#single_cal2").val('');
          $("#error_message").empty();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
        }
      });
    }
  });
});



$(document).ready(function(){
  $("#frmEditOperation").keypress(function(e) {
      if(e.which == 13) {
          $('#btnEditOperation').click();
      }
  });
});

$(document).ready(function(){
  $("#btnEditOperation").click(function(){
    var proceed = true;
    if($("#cmbEditCountry").val() == -1){
      alertify.error('Улсын нэр талбараа сонгоно уу!');
      proceed = false;
    }
    if($("#txtEditEelj").val() == ''){
      alertify.error('Ээлжийн дугаараа оруулна уу!');
      proceed = false;
    }
    if($("#single_cal3").val() == ''){
      alertify.error('Явсан өдрөө оруулна уу!');
      proceed = false;
    }
    if($("#single_cal4").val() == ''){
      alertify.error('Ирсэн өдрөө дугаараа оруулна уу!');
      proceed = false;
    }
    if(proceed){
      var csrf = $('meta[name=csrf-token]').attr("content");
      $.ajax({
        type:'POST',
        url:editOperationUrl,
        data:{_token: csrf, operationID: $('#opirationID').val(), country: $("#cmbEditCountry").val(), eelj: $("#txtEditEelj").val(), leaveDate: $("#single_cal1").val(), arriveDate: $("#single_cal2").val()},
        success:function(data){
          $("#editOperation").modal('hide');
          alertify.alert(data);
          fillOperations();
          $("#cmbCountryName").val(-1);
          $("#txtEditEelj").val("");
          $("#single_cal3").val("");
          $("#single_cal4").val("");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
        }
      });
    }
  });
});



function deleteOperation(id){
  alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
    if (e) {
      var csrf = $('meta[name=csrf-token]').attr("content");
      $.ajax({
          type: 'POST',
          url: deleteOperationUrl,
          data: {_token: csrf, operationID : id},
          success:function(data){
              alertify.alert("Амжилттай устлаа.");
              fillOperations();
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
