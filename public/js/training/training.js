$(document).ready(function(){
    $("#txtNewRegister").keyup(function(){
        if($("#txtNewRegister").val().length == 10){
            // alert(getEmpUrl);
            thinkSex($("#txtNewRegister").val());
            var csrf1 = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type:'POST',
                url:getEmpUrl,
                data:{
                    _token: csrf1,
                    register:$("#txtNewRegister").val()
                },
                success:function(data){
                    if(data.length > 0){
                        $("#txtNewLastname").val(data[0].lastName);
                        $("#txtNewFirstname").val(data[0].firstname);
                        $("select[name='cmbNewUnit']").val(data[0].unit);
                        $('#txtNewRank').val(data[0].rank);
                        $('#hideInsertOrUpdate').val("0");
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
        $("#newSex").html("Хүйс: эр");
        $("#EditSex").html("Хүйс: эр");
        huis = "Эр";
    }
    else {
        $("#newSex").html("Хүйс: эм");
        $("#EditSex").html("Хүйс: эм");
        huis = "Эм";
    }
}


$(document).ready(function(){
    $("#btnNewTraining").click(function(){
        var csrf = $('meta[name=csrf-token]').attr("content");
        var isInsert = true;
        if($("#txtNewRegister").val() == ""){
            alertify.error('Регистрийн дугаар хоосон байна!!!');
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
        if($("#cmbNewTrainingType").val() == "-1"){
            alertify.error('Сургалтын төрлөө сонгоно уу!!!');
            isInsert = false;
        }
        if($("#cmbNewTrainingCountry").val() == "-1"){
            alertify.error('Улсаа сонгоно уу!!!');
            isInsert = false;
        }
        if($("#txtNewSurgaltName").val() == ""){
            alertify.error('Юунд талбар хоосон байна!!!');
            isInsert = false;
        }
        if(isInsert){
            $.ajax({
                type: 'POST',
                url: newTrainingUrl,
                data: {
                    _token: csrf,
                    isInsert:$('#hideInsertOrUpdate').val(),
                    rd:$("#txtNewRegister").val(),
                    lastname:$("#txtNewLastname").val(),
                    firstname:$("#txtNewFirstname").val(),
                    unit:$("#cmbNewUnit").val(),
                    rank:$("#txtNewRank").val(),
                    huis:huis,
                    trainingType:$("#cmbNewTrainingType").val(),
                    trainingCountry:$("#cmbNewTrainingCountry").val(),
                    leaveDate:$("#single_cal1").val(),
                    arriveDate:$("#single_cal2").val(),
                    tailbar:$("#txtNewSurgaltName").val()
                },
                success:function(response){
                    if(response.success){
                      alertify.alert(response.message);
                    }
                    else{
                      alertify.error(response.message);
                    }
                    emptyNew();
                    refresh();
                }
            });
        }
    });
});

function emptyNew(){
  $('#hideInsertOrUpdate').val('');
  $("#txtNewRegister").val('');
  $("#txtNewLastname").val('');
  $("#txtNewFirstname").val('');
  $("#cmbNewUnit").val('');
  $("#txtNewRank").val('');
  $("#newSex").html("Хүйс:");
  $("#cmbNewTrainingType").val('');
  $("#cmbNewTrainingCountry").val('');
  $("#single_cal1").val('');
  $("#single_cal2").val('');
  $("#txtNewSurgaltName").val('');
}

function refresh(){
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
        "processing": true,
        "serverSide": true,
        "ajax":{
                 "url": getTrainingsUrl,
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: csrf
                    }
               },
        "columns": [
            { data: "id", name: "id" },
            { data: "RD", name: "RD"},
            { data: "lastName", name: "lastName"},
            { data: "firstname", name: "firstname" },
            { data: "unit", name: "unit" },
            { data: "trainingTypeName", name: "trainingTypeName" },
            { data: "trainingCoutnry", name: "trainingCoutnry" },
            { data: "trainingName", name: "trainingName" },
            { data: "leaveDate", name: "leaveDate" },
            { data: "arriveDate", name: "arriveDate" },
            { data: "date", name: "date" },
            { data: "name", name: "name" },
            { data: "unitID", name: "unitID", "visible":false },
            { data: "rank", name: "rank", "visible":false },
            { data: "trainingTypeID", name: "trainingTypeID", "visible":false }
          ]
      }).ajax.reload();
}

$(document).ready(function(){
    $("#btnShowEditTrainingModal").click(function(){
        if(rgEdit == "" || rgEdit == null){
            alertify.alert("Засах мөр дээр дарна уу!!!");
        }
        else{
            $("#txtEditRegister").val(data["RD"]);
            $("#txtEditLastname").val(data["lastName"]);
            $("#txtEditFirstname").val(data["firstname"]);
            $("#cmbEditUnit").val(data["unitID"]);
            $("#txtEditRank").val(data["rank"]);
            $("#cmbEditTrainingType").val(data["trainingTypeID"]);
            $("#cmbEditTrainingCountry").val(data["trainingCoutnry"]);
            $("#txtEditSurgaltName").val(data["trainingName"]);
            $("#single_cal3").val(changeDateFormat(data["leaveDate"]));
            $("#single_cal4").val(changeDateFormat(data["arriveDate"]));
            thinkSex(data["RD"]);
            $('#editTrainingMission').modal('show');
        }
    });
});


$(document).ready(function(){
    $("#btnEditTraining").click(function(){
        var csrf = $('meta[name=csrf-token]').attr("content");
        var isInsert = true;
        if($("#txtEditRegister").val() == ""){
            alertify.error('Регистрийн дугаар хоосон байна!!!');
            isInsert = false;
        }
        if($("#txtEditLastname").val() == ""){
            alertify.error('Овог хоосон байна!!!');
            isInsert = false;
        }
        if($("#txtEditFirstname").val() == ""){
            alertify.error('Нэр хоосон байна!!!');
            isInsert = false;
        }
        if($("#cmbEditUnit").val() == "-1"){
            alertify.error('Албан хаагчийн ангиа сонгоно уу!!!');
            isInsert = false;
        }
        if($("#txtEditRank").val() == ""){
            alertify.error('Ангийн албан тушаал хоосон байна!!!');
            isInsert = false;
        }
        if($("#cmbEditTrainingType").val() == "-1"){
            alertify.error('Сургалтын төрлөө сонгоно уу!!!');
            isInsert = false;
        }
        if($("#cmbEditTrainingCountry").val() == "-1"){
            alertify.error('Улсаа сонгоно уу!!!');
            isInsert = false;
        }
        if($("#txtEditSurgaltName").val() == ""){
            alertify.error('Юунд талбар хоосон байна!!!');
            isInsert = false;
        }
        if(isInsert){
            $.ajax({
                type: 'POST',
                url: editTrainingUrl,
                data: {
                    _token: csrf,
                    id:data["id"],
                    rd:$("#txtEditRegister").val(),
                    lastname:$("#txtEditLastname").val(),
                    firstname:$("#txtEditFirstname").val(),
                    unit:$("#cmbEditUnit").val(),
                    rank:$("#txtEditRank").val(),
                    huis:huis,
                    trainingType:$("#cmbEditTrainingType").val(),
                    trainingCountry:$("#cmbEditTrainingCountry").val(),
                    leaveDate:$("#single_cal3").val(),
                    arriveDate:$("#single_cal4").val(),
                    tailbar:$("#txtEditSurgaltName").val()
                },
                success:function(response){
                    if(response.success){
                      alertify.alert(response.message);
                    }
                    else{
                      alertify.error(response.message);
                    }
                    emptyNew();
                    refresh();
                }
            });
        }
    });
});

function changeDateFormat(date){
    var parts = date.split("-");
    var year = parts[0];
    var month = parts[1];
    var day = parts[2];
    var inputDateFormat = month + "/" + day + "/" + year;
    return inputDateFormat;
}

$(document).ready(function(){
    $("#btnDeleteTraining").click(function(){
        if(rdDelete == ''){
          alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
          return;
        }
        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
          if (e) {
            $.ajax({
                type: 'POST',
                url: deleteTrainingUrl,
                data: {_token: csrf, id : data['id']},
                success:function(response){
                  if(response.success){
                    alertify.alert(response.message);
                  }
                  else{
                    alertify.error(response.message);
                  }
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
