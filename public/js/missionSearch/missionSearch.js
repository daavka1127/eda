$(document).ready(function(){
    $("#cmbOperationName").change(function(){
        refreshEelj();
        refreshSection();
    });
});

$(document).ready(function(){
    $("#btnSearchMission").click(function(e){
        e.preventDefault();
        if($("#txtRegister").val().length > 3 || $("#txtLastname").val().length > 3 || $("#txtFirstname").val().length > 3){

            search();
        }
    });
});

$(document).ready(function(){
    $("#cmbEelj").change(function(){
        search();
    });
});

function refreshEelj(){
    var csrf = $('meta[name=csrf-token]').attr("content");
    $.ajax({
        type: 'get',
        url: getEeljUrl,
        data: {country:$("#cmbOperationName").val()},
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
}


function refreshSection(){
    var csrf = $('meta[name=csrf-token]').attr("content");
    $.ajax({
        type: 'post',
        url: getSectionUrl,
        data: {_token: csrf, countryID:$("#cmbOperationName").val()},
        success:function(response){
          $("select[name='cmbSection']").prop('disabled', false).find('option[value]').remove();
          $("select[name='cmbSection']")
              .append($("<option></option>")
              .attr("value", "-1")
              .text("Сонгоно уу"));
          $.each(response, function (key, value) {
              $("select[name='cmbSection']")
                  .append($("<option></option>")
                  .attr("value", value)
                  .text(key));
          });
        }
    });
}


function search(){
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
      searching: false,
      "ajax":{
               "url": searchUrl,
               "dataType": "json",
               "type": "POST",
               "data":{
                    _token: csrf,
                    rd: $("#txtRegister").val(),
                    lastName: $("#txtLastname").val(),
                    firstname: $("#txtFirstname").val(),
                    opName: $("#cmbOperationName").val(),
                    eelj:$("#cmbEelj").val(),
                    sector:$("#cmbSection").val()
                  }
             },
      "columns": [
          {data: "RD1" , render : function ( data, type, row, meta ) {
              return type === 'display'  ?
                '<input type="button" class="btn btn-info" onclick=readmoreMisstionByEmp("' + data + '") id="btnReaderMore" value="Дэлгэрэнгүй" />' :
                data;
            }},
          { data: "RD1", name: "RD1"},
          { data: "lastName", name: "lastName" },
          { data: "firstname", name: "firstname"},
          { data: "countOp", name: "countOp" },
          { data: "unit", name: "unit" },
          { data: "rank", name: "rank" },
          { data: "sex", name: "sex" }
        ]
  }).ajax.reload();
}

$(document).ready(function(){
    $("#editEmpInfo").click(function(){
        if(data == ""){
            alertify.error("Дээрхи  хүснэгтээс засахыг хүссэн мөрөө сонгоно уу!!!");
            return;
        }
        $("#txtEditRegister").val(data["RD1"]);
        $("#hideEditOldRegister").val(data["RD1"]);
        $("#txtEditLastname").val(data["lastName"]);
        $("#txtEditFirstname").val(data["firstname"]);
        $("#cmbEditUnit").val(data["unit"]);
        $("#txtEditRank").val(data["rank"]);
        $('#editEmpInfoModal').modal('show');
    });
});

$(document).ready(function(){
    $("#btnEditEmpMissionPost").click(function(e){
        e.preventDefault();
        if($("#txtEditRegister").val() == ""){
            alertify.error("Засах регистрийн дугаараа оруулна уу!!!");
            return;
        }
        if($("#txtEditLastname").val() == ""){
            alertify.error("Нэрээ оруулна уу!!!");
            return;
        }
        if($("#txtEditFirstname").val() == ""){
            alertify.error("Овогоо оруулна уу!!!");
            return;
        }
        $.ajax({
            type: 'post',
            url: $("#btnEditEmpMissionPost").attr("post-url"),
            data:{
                _token: $('meta[name=csrf-token]').attr("content"),
                rd: $("#txtEditRegister").val(),
                old_rd: $("#hideEditOldRegister").val(),
                lastName: $("#txtEditLastname").val(),
                firstname: $("#txtEditFirstname").val(),
                unit: $("#cmbEditUnit").val(),
                rankAlbanTushaal: $("#txtEditRank").val()
            },
            success: function(res){
                if(res.status == "success"){
                    alertify.alert(res.msg);
                    search();
                }
                else{
                    alertify.alert(res.msg);
                }
            }
        });
    });
});

function getEmpInfo(){
    $.ajax({
        type: 'post',
        url: getEmpByRDUrl,
        data: {_token: csrf, register:$("#txtNewRegister").val()},
        success:function(response){
            if(response.length > 0){
                alert('angi n ' + response[0].unit);
                $('#txtEditLastname').val(response[0].lastName);
                $('#txtEditFirstname').val(response[0].firstname);
                $("#cmbEditUnit").val(response[0].unit);
                $('#txtEditRank').val(response[0].rank);
                $('#editSex').val("0");
                // $('#txtNewLastname').prop('disabled','disabled');
                // $('#txtNewFirstname').prop('disabled','disabled');
                // $("select[name='cmbNewUnit']").prop('disabled','disabled');
                // $('#txtNewRank').prop('disabled','disabled');
            }
            else{

            }
        }
    });
}
