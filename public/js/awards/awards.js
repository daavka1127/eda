function refresh(){
  var csrf = $('meta[name=csrf-token]').attr("content");
  $('#datatable').dataTable().fnDestroy();
  $('#datatable').DataTable( {
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
               "url": getAwardsUrl,
               "dataType": "json",
               "type": "POST",
               "data":{
                    _token: csrf
                  }
             },
      "columns": [
          { data: "id", name: "id", "visible":false },
          { data: "countryName", name: "countryName" },
          { data: "eelj", name: "eelj" },
          { data: "sectorName", name: "sectorName" },
          { data: "RD", name: "RD" },
          { data: "lastName", name: "lastName" },
          { data: "firstname", name: "firstname" },
          { data: "rankTypeName", name: "rankTypeName" },
          { data: "rankName", name: "rankName" },
          { data: "operationRank", name: "operationRank" },
          { data: "tailbar", name: "tailbar" },
          { data: "date", name: "date" },
          { data: "name", name: "name" }
        ]
  }).ajax.reload();
}


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


$(document).ready(function(){
    $("#cmbEelj").change(function(){
        refresh();
    });
});

$(document).ready(function(){
    refreshEmp();
});

$(document).ready(function(){
    $("#cmbNewAwardCountry").change(function(){
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'get',
            url: getEeljUrl,
            data: {_token: csrf, country:$("#cmbNewAwardCountry").val()},
            success:function(response){
              $("select[name='cmbNewAwardEelj']").prop('disabled', false).find('option[value]').remove();
              $("select[name='cmbNewAwardEelj']")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("select[name='cmbNewAwardEelj']")
                      .append($("<option></option>")
                      .attr("value", key)
                      .text(key));
              });
            }
        });
    });
});

$(document).ready(function(){
    $("#cmbNewAwardEelj").change(function(){
        refreshEmp($("#cmbNewAwardCountry").val(), $("#cmbNewAwardEelj").val());
    });
});


function refreshEmp(country, eelj){
  var csrf = $('meta[name=csrf-token]').attr("content");
  $('#dtEmps').dataTable().fnDestroy();
  $('#dtEmps').DataTable( {
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
               "url": getAllEmpUrl,
               "dataType": "json",
               "type": "POST",
               "data":{
                    _token: csrf,
                    country: country,
                    eelj: eelj
                  }
             },
      "columns": [
          { data: "RD", name: "RD"},
          { data: "lastName", name: "lastName"},
          { data: "firstname", name: "firstname"}
        ]
  }).ajax.reload();
}



$(document).ready(function(){
    $('#dtEmps tbody').on( 'click', 'tr', function () {

        var currow = $(this).closest('tr');
        $('#dtEmps tbody tr').css("background-color", "white");
        $(this).closest('tr').css("background-color", "yellow");
        rdNew = currow.find('td:eq(0)').text();
        data = $('#dtEmps').DataTable().row(currow).data();

        // $("#txtEditRegister").val(updateRD);
        // $("#txtEditLastname").val(currow.find('td:eq(5)').text());
        // $("#txtEditFirstname").val(currow.find('td:eq(6)').text());
        // $("#cmbEditUnit").val(currow.find('td:eq(7)').text());
        // alert(currow.find('td:eq(1)').text());
    });
});


$(document).ready(function(){
    $("#btnPostNewAward").click(function(){
        var proceed = true;
        var csrf = $('meta[name=csrf-token]').attr("content");
        if($("#cmbNewAwardCountry").val() == "-1"){
          alertify.error('Ажиллагааны нэр талбарыг сонгоно уу!!!');
          proceed = false;
        }
        if($("#cmbNewAwardEelj").val() == "-1"){
          alertify.error('Ээлжийн дугаараа сонгоно уу!!!');
          proceed = false;
        }
        if(rdNew == ""){
          alertify.error('Хүснэгтнээс ЦАХ-аа сонгоно уу!!!');
          proceed = false;
        }
        if($("#memoAward").val() == ""){
          alertify.error('Шагналын утгаа оруулна уу!!!');
          proceed = false;
        }
        if(proceed){
          $.ajax({
            type:'POST',
            url:newUrl,
            data:{
              _token: csrf,
              rd:rdNew,
              country:$("#cmbNewAwardCountry").val(),
              eelj:$("#cmbNewAwardEelj").val(),
              tailbar:$("#memoAward").val(),
              date:$("#single_cal2").val()
            },
            success:function(data){
              alertify.alert(data);
              rdNew = "";
              $("#memoAward").val('');
              $("#single_cal2").val('');
              refresh();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
            }
          });
        }
    });
});


$("#btnEditEmpMission").click(function(){
  if(rdEdit == ""){
    alertify.error('Албан хаагчаа сонгоно уу!!!');
    return;
  }
    $("#EditAwardCountry option:selected").html('<strong>Ажиллагааны нэр: ' + $("#cmbCountry").text() + '</strong>');
    $("#EditAwardEelj").html('<strong>Ээлж: ' + $("#cmbEelj").val() + '</strong>');
    $("#EditAwardRD").html('<strong>Регистрийн дугаар: ' + data['RD'] + '</strong>');
    $("#EditAwardLastName").html('<strong>Овог: ' + data['lastName'] + '</strong>');
    $("#EditAwardFirstName").html('<strong>Нэр: ' + data['firstname'] + '</strong>');
    $("textarea#editMemoAward").val(data['tailbar']);
    var split = data['date'].split("-");
    $("input[name=editAwardsDate]").val(split[1] + "/" + split[2] + "/" + split[0]);
    $("#EditAward").modal('show');
});

$(document).ready(function(){
  $('#EditAward').on('hidden.bs.modal', function (e) {
    rdEdit="";
    $('#datatable tbody tr').css("background-color", "white");
  })
});


$(document).ready(function(){
  $("#btnPostEditAward").click(function(){
    var proceed = true;
    var csrf = $('meta[name=csrf-token]').attr("content");
    if($("#editMemoAward").val() == ""){
      alertify.error('Шагналын утгаа оруулна уу!!!');
      proceed = false;
    }
    if(proceed){
      $.ajax({
        type:'POST',
        url:editUrl,
        data:{
          _token: csrf,
          id:data['id'],
          tailbar:$("#editMemoAward").val(),
          date:$("input[name=editAwardsDate]").val()
        },
        success:function(data){
          alertify.alert(data);
          rdEdit = "";
          $("#EditAward").modal('hide');
          refresh();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
        }
      });
    }
  });
});


$(document).ready(function(){
    $("#btnDeleteMission").click(function(){
      if(rdDelete == ''){
        alertify.error('Та Устгах албан хаагчаа сонгоно уу!!!');
        return;
      }
      alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
        if (e) {
          var csrf = $('meta[name=csrf-token]').attr("content");
          $.ajax({
              type: 'POST',
              url: deleteUrl,
              data: {_token: csrf, id : data['id']},
              success:function(data){
                  alertify.alert("Амжилттай устлаа.");
                  data="";
                  rdDelete="";
                  refresh();
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                  alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
              }
          })
        } else {
            alertify.error('Устгах үйлдэл цуцлагдлаа.');
        }
      });
    });
});
