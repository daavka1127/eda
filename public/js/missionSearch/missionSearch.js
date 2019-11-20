$(document).ready(function(){
    $("#cmbOperationName").change(function(){
        refreshEelj();
        refreshSection();
        search();
    });
});
$(document).ready(function(){
    $("#cmbEelj").change(function(){
        search();
    });
});
$(document).ready(function(){
    $("#cmbSection").change(function(){
        search();
    });
});
$(document).ready(function(){
  $("#txtRegister").keyup(function(){
    search();
  });
});
$(document).ready(function(){
  $("#txtLastname").keyup(function(){
    search();
  });
});
$(document).ready(function(){
  $("#txtFirstname").keyup(function(){
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
          { data: "readMore", name: "readMore" },
          { data: "RD", name: "RD"},
          { data: "lastName", name: "lastName" },
          { data: "firstname", name: "firstname"},
          { data: "countOp", name: "countOp" }
        ]
  }).ajax.reload();
}
