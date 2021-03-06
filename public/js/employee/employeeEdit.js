$(document).ready(function(){
    $("#btnEditEmpMission").click(function(){
        if(updateRD != ""){
            thinkSex(data["RD"]);
            var csrf = $('meta[name=csrf-token]').attr("content");
            $("#txtEditRegister").val(data["RD"]);
            $("#hideEditOldRegister").val(data["RD"]);
            $("#cmbEditRank").val(data["rankCode"]);
            $("#txtEditOperationRank").val(data["operationRank"]);
            $("#hideMissionId").val(data["id"]);
            //START eelj combobox-iig fill hiij bn
            $.ajax({
                type: 'get',
                url: getEeljUrl,
                data: {_token: csrf, country:$("#cmbCountry").val()},
                success:function(response){
                  $("select[name='cmbEditEelj']").prop('disabled', false).find('option[value]').remove();
                  $("select[name='cmbEditEelj']")
                      .append($("<option></option>")
                      .attr("value", "-1")
                      .text("Сонгоно уу"));
                  $.each(response, function (key, value) {
                      $("select[name='cmbEditEelj']")
                          .append($("<option></option>")
                          .attr("value", key)
                          .text(key));
                  });

                  $("#cmbEditEelj").val($("#cmbEelj").val());
                }
            });
            $("#cmbEditCountry").val($("#cmbCountry").val());
            //START Alban haagchiiin medeelliig fill hiij bn
            $.ajax({
                type: 'post',
                url: getEmpByRDUrl,
                data: {_token: csrf, register:$("#txtEditRegister").val()},
                success:function(response){
                    if(response.length > 0){
                        $('#txtEditLastname').val(response[0].lastName);
                        $('#txtEditFirstname').val(response[0].firstname);
                        $("#cmbEditUnit").val(response[0].unit);
                        $('#txtEditRank').val(response[0].rank);
                        $('#hideInsertOrUpdate').val("0");
                    }
                    else{
                      $('#hideInsertOrUpdate').val("1");

                        $('#txtEditLastname').val('');
                        $('#txtEditFirstname').val('');
                        $("#cmbEditUnit").val('');
                        $('#txtEditRank').val('');
                    }
                }
            });
            $("#editEmpMission").modal('show');
        }else{
            alert("Засах албан хаагчаа сонгоно уу!!!");
        }
    });
});


$(document).ready(function(){
    $("#txtEditRegister").keyup(function(){
        if($("#txtEditRegister").val().length == 10){
            thinkSex($("#txtEditRegister").val());
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type: 'post',
                url: getEmpByRDUrl,
                data: {_token: csrf, register:$("#txtEditRegister").val()},
                success:function(response){
                    if(response.length > 0){
                        $('#txtEditLastname').val(response[0].lastName);
                        $('#txtEditFirstname').val(response[0].firstname);
                        $("#cmbEditUnit").val(response[0].unit);
                        $('#txtEditRank').val(response[0].rank);
                        $('#hideInsertOrUpdate').val("0");
                    }
                    else{
                      // $('#hideInsertOrUpdate').val("1");
                      //
                      //   $('#txtEditLastname').val('');
                      //   $('#txtEditFirstname').val('');
                      //   $("#cmbEditUnit").val('');
                      //   $('#txtEditRank').val('');
                    }
                }
            });
        }
        else{
          // $('#txtNewLastname').val('');
          // $('#txtNewFirstname').val('');
          // $("select[name='cmbNewUnit']").val('-1');
          // $('#txtNewRank').val('');
        }
    });
});



//Ajillagaanii uls songoh uyd eeljin dugaar combog fill hiij bn
$(document).ready(function(){
    $("#cmbEditCountry").change(function(){
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'get',
            url: getEeljUrl,
            data: {_token: csrf, country:$("#cmbEditCountry").val()},
            success:function(response){
              $("select[name='cmbEditEelj']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbEditEelj']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("select[name='cmbEditEelj']")
                      .append($("<option></option>")
                      .attr("value", key)
                      .text(key));
              });
            }
        });
    });
});


$(document).ready(function(){
    $("#btnEditEmpMissionPost").click(function(){
        var isUpdate = true;
        if($("#txtEditLastname").val() == ""){
            alertify.error('Овог хоосан байна!!!');
            isUpdate = false;
        }
        if($("#txtEditFirstname").val() == ""){
            alertify.error('Нэр хоосон байна!!!');
            isUpdate = false;
        }
        if($("#cmbEditUnit").val() == ""){
            alertify.error('Албан хаагчийн ангиа сонгоно уу!!!');
            isUpdate = false;
        }
        if($("#cmbEditCountry").val() == "-1"){
            alertify.error('Ажиллагааны улсаа сонгоно уу!!!');
            isUpdate = false;
        }
        if($("#cmbEditEelj").val() == "-1"){
            alertify.error('Ажиллагааны ээлжээ сонгоно уу!!!');
            isUpdate = false;
        }
        if(isUpdate){
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
              type:'POST',
              url:editUrl,
              data:{
                _token: csrf,
                old_rd:$("#hideEditOldRegister").val().trim().replace(' ', ''),
                rd:$("#txtEditRegister").val().trim().replace(' ', ''),
                lastName:$("#txtEditLastname").val(),
                firstname:$("#txtEditFirstname").val(),
                unit:$("#cmbEditUnit").val(),
                rankAlbanTushaal:$("#txtEditRank").val(),
                id:$("#hideMissionId").val(),
                country:$("#cmbEditCountry").val(),
                eelj:$("#cmbEditEelj").val(),
                rank:$("#cmbEditRank").val(),
                operationRank:$("#txtEditOperationRank").val(),
                hideMissionId:$("#hideMissionId").val()
              },
              success:function(data){
                if(data.status == "success"){
                    alertify.alert(data.msg);
                    $("#editEmpMission").modal('hide');
                    refresh();
                }
                else{
                    alertify.error(data.msg);
                }
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                  alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
              }
            });
        }
    });
});


function thinkSex(register){
    var res = register.substring(8, 9);
    if((res%2) == 1){
        $("#editSex").html("Хүйс: эр");
    }
    else {
        $("#editSex").html("Хүйс: эм");
    }
}
