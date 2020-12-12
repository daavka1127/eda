function editCountry(id, name){
     $("#txtCountryEdit").val(name);
     $("#countryID").val(id);
     $("#editCountry").modal('show');
}

function fillCountries(){
  $('#tableCountries').dataTable().fnDestroy();
  var table = $('#tableCountries').DataTable( {
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
      "order": [[ 1, "asc" ]],
      "stateSave": true,
      "ajax":{
               "url": getCountriesUrlDatatable,
               "dataType": "json",
               "type": "post",
               "data":{
                    _token: $('meta[name="csrf-token"]').attr('content')
                  }
             },
      "columns": [
        { data: "id", name: "id",  render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }  },
        { data: "countryName", name: "countryName" }
        ]
  });
}

$(document).ready(function(){
  $("#btnNewCountry").click(function(){
    var proceed = true;
    if($("#txtCountryNew").val() == ""){
      alertify.error('Улсын нэр талбар хоосон байна.');
      proceed = false;
    }
    if(proceed){
      var csrf = $('meta[name=csrf-token]').attr("content");
      $.ajax({
        type:'POST',
        url:newUrl,
        data:{
          _token: csrf,
          txtCountryNew:$("#txtCountryNew").val()
        },
        success:function(data){
            if(data.status == "success"){
                alertify.alert(data.msg);
                fillCountries();
                $("#txtCountryNew").val("");
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
    $("#btnEditModalShow").click(function(){
        if(dataRow == ""){
            alertify.error("Та засах мөрөө дээрхи хүснэгтээс сонгоно уу!!!");
            return;
        }
        $("#txtCountryEdit").val(dataRow["countryName"]);
        $("#countryID").val(dataRow["id"]);
        $("#editCountry").modal('show');
    });
});


$(document).ready(function(){
  $("#btnEditCountry").click(function(e){
    e.preventDefault();
    var proceed = true;
    if($("#txtCountryEdit").val() == ""){
      alertify.error('Улсын нэр талбар хоосон байна.');
      proceed = false;
    }
    if(proceed){
      // var data = $("#frmEditCountry").serialize();
      // alert(data);
      //var data = $('#frmEditCountry').find('input').serialize();
      var csrf = $('meta[name=csrf-token]').attr("content");
      $.ajax({
        type:'POST',
        url:editUrl,
        data:{_token: csrf, countryID : $("#countryID").val(), txtCountryEdit:$("#txtCountryEdit").val()},
        success:function(data){
          if(data.status == "success"){
              $("#editCountry").modal('hide');
              alertify.alert(data.msg);
              fillCountries();
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
    $("#btnDeleteCountry").click(function(){
        if(dataRow == ""){
            alertify.error("Та устгах мөрөө дээрхи хүснэгтээс сонгоно уу!!!");
            return;
        }
        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
          if (e) {
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type: 'POST',
                url: deleteUrl,
                data: {_token: csrf, countryID : dataRow['id']},
                success:function(data){
                    if(data.status == "success"){
                      alertify.alert("Амжилттай устлаа.");
                      fillCountries();
                    }
                    else{
                        alertify.error(data.msg);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                }
            })
          }
        });
    });
});
