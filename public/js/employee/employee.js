//Ajillagaanii uls songoh uyd eeljin dugaar combog fill hiij bn
$(document).ready(function(){
    $("#cmbCountry").change(function(){
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'get',
            url: getEeljUrl,
            data: {_token: csrf, country:$("#cmbCountry").val()},
            success:function(response){
              $("select[name='cmbEelj']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbEelj']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("select[name='cmbEelj']")
                      .append($("<option></option>")
                      .attr("value", key)
                      .text(key));
              });
            }
        });
    });
});

//Ajillagaanii uls songoh uyd eeljin dugaar combog fill hiij bn
$(document).ready(function(){
    $("#cmbNewCountry").change(function(){
        checkMissionEmp();
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'get',
            url: getEeljUrl,
            data: {_token: csrf, country:$("#cmbNewCountry").val()},
            success:function(response){
              $("select[name='cmbNewEelj']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbNewEelj']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("select[name='cmbNewEelj']")
                      .append($("<option></option>")
                      .attr("value", key)
                      .text(key));
              });
            }
        });
        $.ajax({
            type: 'POST',
            url: getSectorUrl,
            data: {_token: csrf, countryID:$("#cmbNewCountry").val()},
            success:function(response){
              $("select[name='cmbNewSector']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbNewSector']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("select[name='cmbNewSector']")
                      .append($("<option></option>")
                      .attr("value", value)
                      .text(key));
              });
            }
        });
    });
});


$(document).ready(function(){
    $("#cmbNewRankType").change(function(){
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'post',
            url: getRankUrl,
            data: {_token: csrf, rankNum:$("#cmbNewRankType").val()},
            success:function(response){
              $("select[name='cmbNewRank']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbNewRank']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("select[name='cmbNewRank']")
                      .append($("<option></option>")
                      .attr("value", value)
                      .text(key));
              });
            }
        });
    });
});


$(document).ready(function(){
    $("#txtNewRegister").keyup(function(){
        if($("#txtNewRegister").val().length == 10){
            thinkSex($("#txtNewRegister").val());
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type: 'post',
                url: getEmpByRDUrl,
                data: {_token: csrf, register:$("#txtNewRegister").val()},
                success:function(response){
                    if(response.length > 0){
                        $('#txtNewLastname').val(response[0].lastName);
                        $('#txtNewFirstname').val(response[0].firstname);
                        $("select[name='cmbNewUnit']").val(response[0].unit);
                        $('#txtNewRank').val(response[0].rank);
                        $('#hideInsertOrUpdate').val("0");
                        // $('#txtNewLastname').prop('disabled','disabled');
                        // $('#txtNewFirstname').prop('disabled','disabled');
                        // $("select[name='cmbNewUnit']").prop('disabled','disabled');
                        // $('#txtNewRank').prop('disabled','disabled');
                    }
                    else{
                      $('#hideInsertOrUpdate').val("1");
                      // $('#txtNewLastname').removeProp('disabled');
                      // $('#txtNewFirstname').removeProp('disabled');
                      // $("select[name='cmbNewUnit']").removeProp('disabled');
                      // $('#txtNewRank').removeProp('disabled');

                        $('#txtNewLastname').val('');
                        $('#txtNewFirstname').val('');
                        $("select[name='cmbNewUnit']").val('-1');
                        $('#txtNewRank').val('');
                    }
                }
            });
        }
        else{
          $('#txtNewLastname').val('');
          $('#txtNewFirstname').val('');
          $("select[name='cmbNewUnit']").val('-1');
          $('#txtNewRank').val('');
          $("#newSex").html("Хүйс: ");
        }
      checkMissionEmp();
    });
});


$(document).ready(function(){
    $("#btnNewEmpMission").click(function(){
        var isInsert = true;
        if($("#txtNewRegister").val() == ""){
            alertify.error('Регистрийн дугаар хоосон байна!!!');
            isInsert = false;
        }
        if($("#hideIsInsertMission").val() == "0"){
            isInsert = false;
        }
        if($("#txtNewLastname").val() == ""){
            alertify.error('Овог хоосон байна!!!');
            isInsert = false;
        }
        if($("#txtNewFirstname").val() == ""){
            alertify.error('Нэр хоосон байна!!!');
            isInsert = false;
        }
        if($("#cmbNewUnit").val() == "-1"){
            alertify.error('Албан хаагчийн ангиа сонгоно уу!!!');
            isInsert = false;
        }
        if($("#txtNewRank").val() == ""){
            alertify.error('Ангийн албан тушаал хоосон байна!!!');
            isInsert = false;
        }
        if($("#cmbNewCountry").val() == "-1"){
            alertify.error('Ажиллагааны улсаа сонгоно уу!!!');
            isInsert = false;
        }
        if($("#cmbNewEelj").val() == "-1"){
            alertify.error('Ажиллагааны ээлжээ сонгоно уу!!!');
            isInsert = false;
        }
        if($("#cmbNewRankType").val() == "-1"){
            alertify.error('Ажиллагааны цолоо сонгоно уу!!!');
            isInsert = false;
        }
        if($("#cmbNewRank").val() == "-1"){
            alertify.error('Ажиллагааны цолоо сонгоно уу!!!');
            isInsert = false;
        }
        if($("#cmbNewSector").val() == "-1"){
            alertify.error('Цэргийн багийн салбараа сонгоно уу!!!');
            isInsert = false;
        }
        if($("#txtNewOperationRank").val() == ""){
            alertify.error('Ажиллагааны албан тушаал хоосон байна.!!!');
            isInsert = false;
        }
        if(isInsert){
          var csrf = $('meta[name=csrf-token]').attr("content");
          $.ajax({
            type:'POST',
            url:newUrl,
            data:{
              _token: csrf,
              rd:$("#txtNewRegister").val(),
              inserOrUpdate:$("#hideInsertOrUpdate").val(),
              lastName:$("#txtNewLastname").val(),
              firstname:$("#txtNewFirstname").val(),
              unit:$("#cmbNewUnit").val(),
              rankAlbanTushaal:$("#txtNewRank").val(),
              country:$("#cmbNewCountry").val(),
              eelj:$("#cmbNewEelj").val(),
              sector:$("#cmbNewSector").val(),
              rankType:$("#cmbNewRankType").val(),
              rank:$("#cmbNewRank").val(),
              operationRank:$("#txtNewOperationRank").val()
            },
            success:function(data){
              if(data == "00"){
                alertify.error("Алдаа гарлаа!!!");
              }
              else{
                alertify.alert(data);
                refresh();
              }
              $('#hideInsertOrUpdate').val("1");
              $("#txtNewRegister").val('');
              $('#txtNewLastname').val('');
              $('#txtNewFirstname').val('');
              $("select[name='cmbNewUnit']").val('-1');
              $('#txtNewRank').val('');

              $('#cmbNewCountry').val("-1");
              $("select[name='cmbNewEelj']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbNewEelj']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $("select[name='cmbNewSector']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbNewSector']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $('#cmbNewRankType').val('-1');
              $("select[name='cmbNewRank']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbNewRank']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $('#txtNewOperationRank').val('');
              $("#newSex").html("Хүйс: ");
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
            }
          });
        }
    });
});


function checkMissionEmp(){
    if($("#cmbNewCountry").val() != '-1' && $("#cmbNewEelj").val() != '-1' && $("#txtNewRegister").val().length == 10){
        $("#error_message").empty();
        $("#error_message").append('<img width="30" src="' + loading_smallImageUrl + '" /> <label class="control-label">Уншиж байна...</label>');
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'post',
            url: checkMissionUrl,
            data: {
              _token: csrf,
              rd:$("#txtNewRegister").val(),
              country:$("#cmbNewCountry").val(),
              eelj:$("#cmbNewEelj").val()
            },
            success:function(response){
              if(response > 0){
                $("#error_message").empty();
                $("#error_message").append('<img width="30" src="' + wrongImageUrl + '" /><strong>Цэргийн багт ' + $("#txtNewRegister").val() + ' регистрийн дугаартай ЦАХ бүртгэлтэй байна</strong>');
                $("#hideIsInsertMission").val('0');
              }
              else{
                $("#error_message").empty();
                $("#error_message").append('<img width="30" src="' + correctImageUrl + '" /><strong>Бүртгэх боломжтой</strong>');
                $("#hideIsInsertMission").val('1');
              }
            }
        });
    }
    else{
      $("#hideIsInsertMission").val('0');
    }
}


$(document).ready(function(){
    $("#cmbNewEelj").change(function(){
        checkMissionEmp();
    });
});


$(document).ready(function(){
    $("#cmbEelj").change(function(){
        refresh();
    });
});


function refresh(){
  var csrf = $('meta[name=csrf-token]').attr("content");
  $('#datatable').dataTable().fnDestroy();
  var test = $('#datatable').DataTable( {
      "language": {
          "lengthMenu": "_MENU_ мөрөөр харах",
          "zeroRecords": "Хайлт илэрцгүй байна",
          "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
          "infoEmpty": "Хайлт илэрцгүй",
          "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
          "sSearch": "Хайх: ",
          "paginate": {
            "previous": "Өмнөх",
            "next": "Дараахи"
          }
      },
      "fixedColumns":   {
          "leftColumns": 1,
          "rightColumns": 1
      },
      "processing": true,
      "serverSide": true,
      "ajax":{
               "url": getMissionsUrl,
               "dataType": "json",
               "type": "POST",
               "data":{
                    _token: csrf,
                    country: $("#cmbCountry").val(),
                    eelj:$("#cmbEelj").val()
                  }
             },
      "columns": [
          { data: "country", name: "country", "visible":false },
          { data: "eelj", name: "eelj", "visible":false },
          { data: "sector", name: "sector", "visible":false },
          { data: "rankType", name: "rankType", "visible":false },
          { data: "rankCode", name: "rankCode", "visible":false },
          { data: "readMore", name: "readMore" },
          { data: "id", name: "id" },
          { data: "countryName", name: "countryName" },
          { data: "eelj", name: "eelj" },
          { data: "sectorName", name: "sectorName" },
          { data: "RD", name: "RD" },
          { data: "lastName", name: "lastName" },
          { data: "firstname", name: "firstname" },
          { data: "unit", name: "unit" },
          { data: "RankName", name: "RankName" },
          { data: "operationRank", name: "operationRank" },
          { data: "countOp", name: "countOp" },
          { data: "date", name: "date" },
          { data: "name", name: "name" }
        ]
  }).ajax.reload();
}

function thinkSex(register){
    var res = register.substring(8, 9);
    if((res%2) == 1){
        $("#newSex").html("Хүйс: эр");
    }
    else {
        $("#newSex").html("Хүйс: эм");
    }
}
