

$(document).ready(function(){
    $("#lblCountryNameNew").empty();
    $("#lblCountryNameNew").append($( "#cmbCountry option:selected" ).text());
    $("#lblCountryNameEdit").empty();
    $("#lblCountryNameEdit").append($( "#cmbCountry option:selected" ).text());
    $("#cmbCountry").change(function(){
        $("#lblCountryNameNew").empty();
        $("#lblCountryNameNew").append($( "#cmbCountry option:selected" ).text());
        $("#lblCountryNameEdit").empty();
        $("#lblCountryNameEdit").append($( "#cmbCountry option:selected" ).text());
        refresh();
    });
});


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
      "processing": true,
      "serverSide": true,
      "ajax":{
               "url": getSector,
               "dataType": "json",
               "type": "POST",
               "data":{ _token: csrf, id: $("#cmbCountry").val()}
             },
      "columns": [
          { data: "id", name: "id" },
          { data: "countryName", name: "countryID" },
          { data: "sectorName", name: "sectorName" },
          { data: "action", name: "action" }
          ]
  }).ajax.reload();
}


$(document).ready(function(){
    $("#btnNewSector").click(function(){
        var proceed = true;
        if($("#txtSectorNew").val() == ''){
            proceed = false;
            alertify.error('Салбараа оруулна уу!!!');
        }
        if(proceed){
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type:'POST',
                url:newUrl,
                data:{
                    _token: csrf,
                    countryID:$("#cmbCountry").val(),
                    sectorName:$("#txtSectorNew").val()
                },
                success:function(data){
                    alertify.alert(data);
                    $("#txtSectorNew").val('');
                    refresh();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                }
            });
        }
    });
});



function editSector(sectorID){
  var sectorname = $("#editSector"+sectorID).closest("tr").find('td:eq(2)').text();
  $("#txtSectorEdit").val(sectorname);
  $("#hideSectorID").val(sectorID);
  $("#editSectorModal").modal('show');
}


$(document).ready(function(){
    $("#btnPostEditSector").click(function(){
        var proceed = true;
        if($("#txtSectorEdit").val() == ''){
            proceed = false;
            alertify.error('Салбараа оруулна уу!!!');
        }
        if(proceed){
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type:'POST',
                url:editUrl,
                data:{
                    _token: csrf,
                    id:$("#hideSectorID").val(),
                    sectorName:$("#txtSectorEdit").val()
                },
                success:function(data){
                    alertify.alert(data);
                    refresh();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                }
            });
        }
    });
});



function deleteSector(sectorID){
    var id = $(this).closest("tr").find('td:eq(0)').text();
    alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
      if (e) {
        var csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: 'POST',
            url: deleteUrl,
            data: {_token: csrf, id : sectorID},
            success:function(data){
                alertify.alert("Амжилттай устлаа.");
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
}
