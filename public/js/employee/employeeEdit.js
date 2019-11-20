$(document).ready(function(){
    $("#btnEditEmpMission").click(function(){
        if(updateRD != ""){
            thinkSex(data["RD"]);
            var csrf = $('meta[name=csrf-token]').attr("content");
            $("#txtEditRegister").val(data["RD"]);
            $("#hideEditOldRegister").val(data["RD"]);
            $("#cmbEditRankType").val(data["rankType"]);
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
                        $("select[name='cmbEditUnit']").val(response[0].unit);
                        $('#txtEditRank').val(response[0].rank);
                        $('#hideInsertOrUpdate').val("0");
                    }
                    else{
                      $('#hideInsertOrUpdate').val("1");

                        $('#txtEditLastname').val('');
                        $('#txtEditFirstname').val('');
                        $("select[name='cmbEditUnit']").val('-1');
                        $('#txtEditRank').val('');
                    }
                }
            });
            // START tsoliig fill hiiij bn
            $.ajax({
                type: 'post',
                url: getRankUrl,
                data: {_token: csrf, rankNum:data["rankType"]},
                success:function(response){
                  $("select[name='cmbEditRank']").prop('disabled', false).find('option[value]').remove();
                  $("select[name='cmbEditRank']")
                      .append($("<option></option>")
                      .attr("value", "-1")
                      .text("Сонгоно уу"));
                  $.each(response, function (key, value) {
                      $("select[name='cmbEditRank']")
                          .append($("<option></option>")
                          .attr("value", value)
                          .text(key));

                  });
                  $("#cmbEditRank").val(data["rankCode"]);
                }
            });
            //START salbariig fill hiij bn
            $.ajax({
                type: 'POST',
                url: getSectorUrl,
                data: {_token: csrf, countryID:$("#cmbCountry").val()},
                success:function(response){
                  $("select[name='cmbEditSector']").prop('disabled', false).find('option[value]').remove();
                  $("select[name='cmbEditSector']")
                      .append($("<option></option>")
                      .attr("value", "-1")
                      .text("Сонгоно уу"));
                  $.each(response, function (key, value) {
                      $("select[name='cmbEditSector']")
                          .append($("<option></option>")
                          .attr("value", value)
                          .text(key));
                  });
                  $("select[name='cmbEditSector']").val(data["sector"]);
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
                        $("select[name='cmbEditUnit']").val(response[0].unit);
                        $('#txtEditRank').val(response[0].rank);
                        $('#hideInsertOrUpdate').val("0");
                    }
                    else{
                      $('#hideInsertOrUpdate').val("1");

                        $('#txtEditLastname').val('');
                        $('#txtEditFirstname').val('');
                        $("select[name='cmbEditUnit']").val('-1');
                        $('#txtEditRank').val('');
                    }
                }
            });
        }
        else{
          $('#txtNewLastname').val('');
          $('#txtNewFirstname').val('');
          $("select[name='cmbNewUnit']").val('-1');
          $('#txtNewRank').val('');
        }
        checkMissionEmp();
    });
});


// Tsolnii turul songohod tsoliig fill hiine
$(document).ready(function(){
    $("#cmbEditRankType").change(function(){
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'post',
            url: getRankUrl,
            data: {_token: csrf, rankNum:$("#cmbEditRankType").val()},
            success:function(response){
              $("select[name='cmbEditRank']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbEditRank']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("select[name='cmbEditRank']")
                      .append($("<option></option>")
                      .attr("value", value)
                      .text(key));
              });
            }
        });
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
        $.ajax({
            type: 'POST',
            url: getSectorUrl,
            data: {_token: csrf, countryID:$("#cmbEditCountry").val()},
            success:function(response){
              $("select[name='cmbEditSector']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbEditSector']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("select[name='cmbEditSector']")
                      .append($("<option></option>")
                      .attr("value", value)
                      .text(key));
              });
            }
        });
    });
});


$(document).ready(function(){
    $("#btnEditEmpMissionPost").click(function(){
        var isUpdate = true;
        if($("#txtEditRegister").val() == ""){
            alertify.error('Регистрийн дугаар хоосон байна!!!');
            isUpdate = false;
        }
        if($("#txtEditLastname").val() == ""){
            alertify.error('Овог хоосан байна!!!');
            isUpdate = false;
        }
        if($("#txtEditFirstname").val() == ""){
            alertify.error('Нэр хоосон байна!!!');
            isUpdate = false;
        }
        if($("#cmbEditUnit").val() == "-1"){
            alertify.error('Албан хаагчийн ангиа сонгоно уу!!!');
            isUpdate = false;
        }
        if($("#txtEditRank").val() == ""){
            alertify.error('Ангийн албан тушаал хоосон байна!!!');
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
        if($("#cmbEditRankType").val() == "-1"){
            alertify.error('Ажиллагааны цолоо сонгоно уу!!!');
            isUpdate = false;
        }
        if($("#cmbEditRank").val() == "-1"){
            alertify.error('Ажиллагааны цолоо сонгоно уу!!!');
            isUpdate = false;
        }
        if(isUpdate){
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
              type:'POST',
              url:editUrl,
              data:{
                _token: csrf,
                old_rd:$("#hideEditOldRegister").val(),
                rd:$("#txtEditRegister").val(),
                lastName:$("#txtEditLastname").val(),
                firstname:$("#txtEditFirstname").val(),
                unit:$("#cmbEditUnit").val(),
                rankAlbanTushaal:$("#txtEditRank").val(),
                id:$("#hideMissionId").val(),
                country:$("#cmbEditCountry").val(),
                eelj:$("#cmbEditEelj").val(),
                sector:$("#cmbEditSector").val(),
                rankType:$("#cmbEditRankType").val(),
                rank:$("#cmbEditRank").val(),
                operationRank:$("#txtEditOperationRank").val()
              },
              success:function(data){
                if(data == "00"){
                  alertify.error("Алдаа гарлаа!!!");
                }
                else{
                  alertify.alert(data);
                  refresh();
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
