$(document).ready(function(){
    $("#cmbCountry").change(function(){
        fillOperations();
    });
});

function fillOperations(){
  $('#tableEelj').dataTable().fnDestroy();
  var table = $('#tableEelj').DataTable( {
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
      "order": [[ 3, "asc" ]],
      // "stateSave": true,
      "ajax":{
               "url": getEeljUrlDatatable,
               "dataType": "json",
               "type": "post",
               "data":{
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    countryID:$("#cmbCountry").val()
                  }
             },
     "columns": [
       { data: "id", name: "id",  render: function (data, type, row, meta) {
           return meta.row + meta.settings._iDisplayStart + 1;
       }  },
       { data: "countryID", name: "countryID", "visible":false },
       { data: "countryName", name: "countryName" },
       { data: "eelj", name: "eelj" },
       { data: "leaveDate", name: "leaveDate" },
       { data: "arriveDate", name: "arriveDate" }
       ]
  });
}

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
    var csrf = $('meta[name=csrf-token]').attr("content");
    if(proceed){
      // var data = $("#frmNewOperation").serialize();
      $.ajax({
        type:'POST',
        url:newOperationUrl,
        data:{_token: csrf, country: $("#cmbCountryName").val(), eelj: $("#txtNewEelj").val(), leaveDate: $("#single_cal1").val(), arriveDate: $("#single_cal2").val()},
        success:function(data){
            if(data.status == 'success'){
                alertify.alert(data.msg);
                fillOperations();
                $("#cmbCountryName").val(-1);
                $("#txtNewEelj").val('');
                $("#single_cal1").val('');
                $("#single_cal2").val('');
                $("#error_message").empty();
            }
            else if(data.status == 'exist'){
                alertify.error(data.msg);
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


$(document).ready(function(){
    $("#btnEditEelj").click(function(){
        if(dataRow == ""){
            alertify.error("Дээрхи хүснэгтээс засахыг хүссэн ээлжээ сонгоно уу!!!");
            return;
        }
        $('option[value=' + dataRow["countryID"] + ']')
               .attr('selected',true);
         $("#txtEditEelj").val(dataRow["eelj"]);
         var splLeaveDate = dataRow["leaveDate"].split("-");;
         $("#single_cal3").val(splLeaveDate[1] + "/" + splLeaveDate[2] + "/" + splLeaveDate[0]);
         var splLeaveDate = dataRow["arriveDate"].split("-");;
         $("#single_cal4").val(splLeaveDate[1] + "/" + splLeaveDate[2] + "/" + splLeaveDate[0]);
         $("#opirationID").val(dataRow["id"]);
         $("#editOperation").modal('show');
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
        data:{
          _token: csrf,
          operationID: $('#opirationID').val(),
          country: $("#cmbEditCountry").val(),
          eelj: $("#txtEditEelj").val(),
          leaveDate: $("#single_cal3").val(),
          arriveDate: $("#single_cal4").val()
        },
        success:function(data){

          if(data.status == 'success'){
              alertify.alert(data.msg);
              fillOperations();
              $("#cmbCountryName").val(-1);
              $("#txtNewEelj").val('');
              $("#single_cal3").val('');
              $("#single_cal4").val('');
              $("#error_message").empty();
          }
          else if(data.status == 'exist'){
              alertify.error(data.msg);
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


$(document).ready(function(){
    $("#btnDeleteEelj").click(function(){
        if(dataRow == ""){
            alertify.error("Дээрхи хүснэгтээс засахыг хүссэн ээлжээ сонгоно уу!!!");
            return;
        }
        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
          if (e) {
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type: 'POST',
                url: deleteOperationUrl,
                data: {_token: csrf, operationID : dataRow["id"]},
                success:function(data){
                    if(data.status == 'success'){
                        alertify.alert(data.msg);
                        fillOperations();
                    }
                    else{
                        alertify.error(data.msg);
                    }
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


function deleteOperation(id){

}
