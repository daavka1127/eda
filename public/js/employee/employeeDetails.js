var dataRowMission = "";
var dtDetailsMission = "";
var dataRowDetailsMission = "";

var dtDetailsAwards = "";
var dataRowDetailsAwards = "";

dtDetailsMission = $('#dtMissionByRD').DataTable();
// start mission detailsiin datatableiin select event
dtDetailsMission.on( 'click', 'tr', function () {
  if ( $(this).hasClass('selected') ) {
      $(this).removeClass('selected');
      dataRowDetailsMission = "";
  }else {
      dtDetailsMission.$('tr.selected').removeClass('selected');
      $(this).addClass('selected');
      var currow = $(this).closest('tr');
      dataRowDetailsMission = $('#dtMissionByRD').DataTable().row(currow).data();
      $("#collapseMissionEdit").collapse("hide");
  }
});
// end mission detailsiin datatableiin select event

dtDetailsAwards = $('#dtAwardsByRD').DataTable();
// start mission detailsiin datatableiin select event
dtDetailsAwards.on( 'click', 'tr', function () {
  if ( $(this).hasClass('selected') ) {
      $(this).removeClass('selected');
      dataRowDetailsAwards = "";
  }else {
      dtDetailsAwards.$('tr.selected').removeClass('selected');
      $(this).addClass('selected');
      var currow = $(this).closest('tr');
      dataRowDetailsAwards = $('#dtAwardsByRD').DataTable().row(currow).data();
      $("#collapseAwardsEdit").collapse("hide");
  }
});
// end mission detailsiin datatableiin select event

function showReadMoreModal(register){
    $.ajax({
        type: 'post',
        url: getEmpByRDUrl,
        data: {_token: $('meta[name=csrf-token]').attr("content"), register:register},
        success:function(response){
            if(response.length > 0){
                $("#lblRd").empty();
                $("#txtDetailsEditRegister").val('');
                $("#hideDetailsEditOldRegister").val('');
                $("#lblRd").append("Регистрийн дугаар: " + register);
                $("#txtDetailsEditRegister").val(register);
                $("#hideDetailsEditOldRegister").val(register);
                $("#lblLastName").empty();
                $("#txtDetailsEditLastname").val('');
                $("#lblLastName").append("Овог: " + response[0].lastName);
                $("#txtDetailsEditLastname").val(response[0].lastName);
                $("#lblFirstName").empty();
                $("#txtDetailsEditFirstname").val('');
                $("#lblFirstName").append("Нэр: " + response[0].firstname);
                $("#txtDetailsEditFirstname").val(response[0].firstname);
                $("#lblUnit").empty();
                $("#cmbDetailsEditUnit").val('');
                $("#lblUnit").append("Анги: " + response[0].unit);
                $("#cmbDetailsEditUnit").val(response[0].unit);
                $("#lblAlbanTushaal").empty();
                $("#txtDetailsEditRank").val('');
                $("#lblAlbanTushaal").append("Албан тушаал: " + response[0].rank);
                $("#txtDetailsEditRank").val(response[0].rank);


                $("#detailsEmpMission").modal('show');
                readmoreMisstionByEmp(register);
                readmoreAwadsByRD(register);
                readmorePunishmentsByRD(register);
                // readmoreTrainingsByRD(register);
                fillAssignedCountry(register);
            }
        }
    });
}


function readmoreMisstionByEmp(register){
    var csrf = $('meta[name=csrf-token]').attr("content");

    $('#dtMissionByRD').dataTable().fnDestroy();
    dtDetailsMission = "";
    // dataTable iig fill hiij tuhain hunii yvsan ajillagaanii medeelliig haruulj bn
    dtDetailsMission = $('#dtMissionByRD').DataTable( {
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
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
                 "url": $("#dtTrainingsByRD").attr('post-url'),
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: csrf,
                      rd: register
                    }
               },
        "columns": [
            { data: "id", name: "id" },
            { data: "country", name: "country", "visible":false },
            { data: "countryName", name: "countryName" },
            { data: "eelj", name: "eelj" },
            { data: "rankCode", name: "rankCode" },
            { data: "operationRank", name: "operationRank" },
            { data: "date", name: "date" },
            { data: "name", name: "name" }
          ]
    });


}

function readmoreAwadsByRD(register){
    var csrf = $('meta[name=csrf-token]').attr("content");
    $('#dtAwardsByRD').dataTable().fnDestroy();
    $('#dtAwardsByRD').DataTable( {
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
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
        select: {
            style: 'single'
        },
        "processing": true,
        "serverSide": true,
        "ajax":{
                 "url": $("#dtAwardsByRD").attr('post-url'),
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: csrf,
                      rd: register
                    }
               },
        "columns": [
            { data: "id", name: "id" },
            { data: "country", name: "country", "visible":false  },
            { data: "countryName", name: "countryName" },
            { data: "eelj", name: "eelj" },
            { data: "tailbar", name: "tailbar" },
            { data: "date", name: "date" },
            { data: "name", name: "name" }
          ]
    });
}

function readmorePunishmentsByRD(register){
    var csrf = $('meta[name=csrf-token]').attr("content");
    $('#dtPunishmentsByRD').dataTable().fnDestroy();
    $('#dtPunishmentsByRD').DataTable( {
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
        "language": {
            "lengthMenu": "_MENU_ мөрөөр харах",
            "zeroRecords": "Шийтгэл байхгүй байна",
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
                 "url": getPunishmentsReadmore,
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: csrf,
                      rd: register
                    }
               },
        "columns": [
            { data: "countryName", name: "countryName" },
            { data: "eelj", name: "eelj" },
            { data: "tailbar", name: "tailbar" },
            { data: "date", name: "date" },
            { data: "name", name: "name" }
          ]
    });
}

function readmoreTrainingsByRD(register){
  $('#dtTrainingsByRD').dataTable().fnDestroy();
  var csrf = $('meta[name=csrf-token]').attr("content");
  $('#dtTrainingsByRD').DataTable( {
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
      "language": {
          "lengthMenu": "_MENU_ мөрөөр харах",
          "zeroRecords": "Сургалт дамжаанд хамрагдаагүй",
          "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
          "infoEmpty": "Сургалт дамжаанд хамрагдаагүй",
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
               "url": getTraningsReadmore,
               "dataType": "json",
               "type": "POST",
               "data":{
                    _token: csrf,
                    rd: register
                  }
             },
      "columns": [
          { data: "trainingTypeName", name: "trainingTypeName" },
          { data: "trainingCoutnry", name: "trainingCoutnry" },
          { data: "trainingName", name: "trainingName" },
          { data: "leaveDate", name: "leaveDate" },
          { data: "arriveDate", name: "arriveDate" },
          { data: "date", name: "date" },
          { data: "name", name: "name" }
        ]
    });
}

$('#detailsEmpMission').on('hidden.bs.modal', function () {
    $("#collapseEmpInfo").collapse('hide');
    $("#collapseMissionNew").collapse('hide');
});


$(document).ready(function(){
    $("#btnPrintEmpMissionDetails").click(function(){
        var newWin = window.open(printReportUrl + register, 'Print-Window');
        // newWin.document.close();
        // setTimeout(function(){newWin.close();},10);
    });
});

function readmoreClick(){
    alert(data["RD"]);
}

// START SECTION EDIT EMP
$(document).ready(function(){

    $("#btnDetailsEditEmpMissionPost").click(function(e){
        e.preventDefault();
        if($('#txtDetailsEditRegister').val() != $("#hideDetailsEditOldRegister").val() && $('#txtDetailsEditRegister').val().length < 10){
            alertify.error("Таны оруулсан регистрийн дугаар буруу байна!!!");
            return;
        }
        if($("#txtDetailsEditRegister").val() == ""){
            alertify.error("Засах регистрийн дугаараа оруулна уу!!!");
            return;
        }
        if($("#txtDetailsEditLastname").val() == ""){
            alertify.error("Нэрээ оруулна уу!!!");
            return;
        }
        if($("#txtDetailsEditFirstname").val() == ""){
            alertify.error("Овогоо оруулна уу!!!");
            return;
        }
        $.ajax({
            type: 'post',
            url: $("#btnDetailsEditEmpMissionPost").attr("post-url"),
            data:{
                _token: $('meta[name=csrf-token]').attr("content"),
                rd: $("#txtDetailsEditRegister").val(),
                old_rd: $("#hideDetailsEditOldRegister").val(),
                lastName: $("#txtDetailsEditLastname").val(),
                firstname: $("#txtDetailsEditFirstname").val(),
                unit: $("#cmbDetailsEditUnit").val(),
                rankAlbanTushaal: $("#txtDetailsEditRank").val()
            },
            success: function(res){
                if(res.status == "success"){
                    $("#lblRd").empty();
                    $("#lblRd").append("Регистрийн дугаар: " + $("#txtDetailsEditRegister").val());
                    $("#lblLastName").empty();
                    $("#lblLastName").append("Овог: " + $("#txtDetailsEditLastname").val());
                    $("#lblFirstName").empty();
                    $("#lblFirstName").append("Нэр: " + $("#txtDetailsEditFirstname").val());
                    $("#lblUnit").empty();
                    $("#lblUnit").append("Анги: " + $("#cmbDetailsEditUnit").val());
                    $("#lblAlbanTushaal").empty();
                    $("#lblAlbanTushaal").append("Албан тушаал: " + $("#txtDetailsEditRank").val());

                    readmoreMisstionByEmp($("#txtDetailsEditRegister").val());
                    readmoreAwadsByRD($("#txtDetailsEditRegister").val());
                    readmorePunishmentsByRD($("#txtDetailsEditRegister").val());
                    readmoreTrainingsByRD($("#txtDetailsEditRegister").val());
                    $("#collapseEmpInfo").collapse('hide');
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
// END SECTION EDIT EMP


// START SECTION MISSION
$(document).ready(function(){

    $("#btnOnlyMissionNew").click(function(){
        if ($("#collapseMissionEdit").hasClass("in")) {
            $("#collapseMissionEdit").collapse("hide");
        }
    });

    $("#btnOnlyMissionEdit").click(function(){
        if(dataRowDetailsMission == ""){
            alertify.error("Та засах мөрөө дарж сонгоно уу!!!");
            $("#collapseMissionEdit").collapse("hide");
            return;
        }
        if ($("#collapseMissionNew").hasClass("in")) {
            $("#collapseMissionNew").collapse("hide");
        }
        if ($("#collapseMissionEdit").hasClass("in")) {
            $("#collapseMissionEdit").collapse("hide");
        }
        else{
            $("#cmbDetailsCountryEdit").val(dataRowDetailsMission["country"]);
            $.ajax({
                type: 'get',
                url: getEeljUrl,
                data: {country:dataRowDetailsMission["country"]},
                success:function(response){
                  $("#cmbDetailsEeljEdit").prop('disabled', false).find('option[value]').remove();
                  $("#cmbDetailsEeljEdit")
                      .append($("<option></option>")
                      .attr("value", "-1")
                      .text("Сонгоно уу"));
                  $.each(response, function (key, value) {
                      $("#cmbDetailsEeljEdit")
                          .append($("<option></option>")
                          .attr("value", key)
                          .text(key));
                  });
                  $("#cmbDetailsEeljEdit").val(dataRowDetailsMission["eelj"]);
                  $("#txtDetailsRankEdit").val(dataRowDetailsMission["rankCode"]);
                  $("#txtDetailsPositionEdit").val(dataRowDetailsMission["operationRank"]);
                  $("#collapseMissionEdit").collapse("show");
                }
            });
        }

    });

    // start mission details mission zasah hesgiin uls songuul eelj fill hiih heseg
    $("#cmbDetailsCountryEdit").change(function(){
        $.ajax({
            type: 'get',
            url: getEeljUrl,
            data: {country:$("#cmbDetailsCountryEdit").val()},
            success:function(response){
              $("#cmbDetailsEeljEdit").prop('disabled', false).find('option[value]').remove();
              $("#cmbDetailsEeljEdit")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("#cmbDetailsEeljEdit")
                      .append($("<option></option>")
                      .attr("value", key)
                      .text(key));
              });
            }
        });
    });
    // end mission details mission zasah hesgiin uls songuul eelj fill hiih heseg

    // start mission details mission nemeh hesgiin uls songuul eelj fill hiih heseg
    $("#cmbDetailsCountryNew").change(function(){
        $.ajax({
            type: 'get',
            url: getEeljUrl,
            data: {country:$("#cmbDetailsCountryNew").val()},
            success:function(response){
              $("#cmbDetailsEeljNew").prop('disabled', false).find('option[value]').remove();
              $("#cmbDetailsEeljNew")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("#cmbDetailsEeljNew")
                      .append($("<option></option>")
                      .attr("value", key)
                      .text(key));
              });
            }
        });
    });
    // end mission details mission nemeh hesgiin uls songuul eelj fill hiih heseg

    // start mission nemeh heseg
    $("#btnDetailsMissionNew").click(function(e){
        e.preventDefault();
        $("#cmbDetailsCountryNew").css('border-color', '');
        $("#cmbDetailsEeljNew").css('border-color', '');
        if($("#cmbDetailsCountryNew").val() == "-1"){
            $("#cmbDetailsCountryNew").css('border-color', 'red');
            alertify.error("Ажиллагааны нэрээ сонгоно уу!!!");
            return;
        }
        if($("#cmbDetailsEeljNew").val() == "-1"){
          $("#cmbDetailsEeljNew").css('border-color', 'red');
            alertify.error("Ээлжээ сонгоно уу!!!");
            return;
        }

        $.ajax({
            type: 'post',
            url: $("#btnDetailsMissionNew").attr("post-url"),
            data:{
                _token: $('meta[name=csrf-token]').attr("content"),
                rd: $("#txtDetailsEditRegister").val(),
                country: $("#cmbDetailsCountryNew").val(),
                eelj: $("#cmbDetailsEeljNew").val(),
                rank: $("#txtDetailsRankNew").val(),
                operationRank: $("#txtDetailsPositionNew").val()
            },
            success: function(res){
                if(res.status == "success"){
                    emptyMissionNew();
                    readmoreMisstionByEmp($("#txtDetailsEditRegister").val());
                    // dtDetailsMission.row.add([
                    //     res.id,
                    //     $("#cmbDetailsCountryNew").val(),
                    //     $("#cmbDetailsCountryNew option:selected").val(),
                    //     $("#cmbDetailsEeljNew").val(),
                    //     $("#txtDetailsRankNew").val(),
                    //     $("#txtDetailsPositionNew").val(),
                    //     res.date,
                    //     res.admin
                    // ]).draw(false);
                    $("#collapseMissionNew").collapse('hide');
                    alertify.alert(res.msg);
                    search();
                }
                else{
                    alertify.alert(res.msg);
                }
            }
        });


    });
    // end mission nemeh heseg

    // start mission zasah heseg
    $("#btnDetailsMissionEdit").click(function(e){
        e.preventDefault();
        $("#cmbDetailsCountryEdit").css('border-color', '');
        $("#cmbDetailsEeljEdit").css('border-color', '');
        if($("#cmbDetailsCountryEdit").val() == "-1"){
            $("#cmbDetailsCountryEdit").css('border-color', 'red');
            alertify.error("Ажиллагааны нэрээ сонгоно уу!!!");
            return;
        }
        if($("#cmbDetailsEeljEdit").val() == "-1"){
          $("#cmbDetailsEeljEdit").css('border-color', 'red');
            alertify.error("Ээлжээ сонгоно уу!!!");
            return;
        }

        $.ajax({
            type: 'post',
            url: $("#btnDetailsMissionEdit").attr("post-url"),
            data:{
                _token: $('meta[name=csrf-token]').attr("content"),
                id: dataRowDetailsMission["id"],
                country: $("#cmbDetailsCountryEdit").val(),
                eelj: $("#cmbDetailsEeljEdit").val(),
                rank: $("#txtDetailsRankEdit").val(),
                operationRank: $("#txtDetailsPositionEdit").val()
            },
            success: function(res){
                if(res.status == "success"){
                    $("#collapseMissionEdit").collapse('hide');
                    alertify.alert(res.msg);
                    // dtDetailsMission.row('.selected').cell(':eq(1)').data($("#cmbDetailsCountryEdit").val()).draw();
                    // dtDetailsMission.row('.selected').cell(':eq(2)').data($("#cmbDetailsCountryEdit option:selected").val()).draw();
                    // dtDetailsMission.row('.selected').cell(':eq(3)').data($("#cmbDetailsEeljEdit").val()).draw();
                    // dtDetailsMission.row('.selected').cell(':eq(4)').data($("#txtDetailsRankEdit").val()).draw();
                    // dtDetailsMission.row('.selected').cell(':eq(5)').data($("#txtDetailsPositionEdit").val()).draw();
                    // dtDetailsMission.row('.selected').cell(':eq(6)').data(res.date).draw();
                    // dtDetailsMission.row('.selected').cell(':eq(7)').data(res.admin).draw();
                    readmoreMisstionByEmp($("#txtDetailsEditRegister").val());
                }
                else{
                    alertify.alert(res.msg);
                }
            }
        });

    });
    // end mission zasah heseg

    // start mission delete hiih heseg
    $("#btnOnlyMissionDelete").click(function(){
        if(dataRowDetailsMission == ""){
            alertify.error("Та устгах мөрөө дарж сонгоно уу!!!");
            $("#collapseMissionEdit").collapse("hide");
            return;
        }

        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
            if (e) {
                $.ajax({
                    type: 'post',
                    url: $("#btnOnlyMissionDelete").attr("post-url"),
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id:dataRowDetailsMission["id"]
                    },
                    success:function(res){
                        if(res.status == 'success'){
                            alertify.alert(res.msg);
                            // var row = dtDetailsMission.row( $(this).parents('tr') );
                            dtDetailsMission.rows( '.selected' ).remove().draw();
                        }
                        else{
                            alertify.error(res.msg);
                        }
                    }
                });
            }
        });
    });
    // end mission delete hiih heseg
});
// END SECTION MISSION



// START SECTION AWARDS
$(document).ready(function(){
    $("#btnOnlyAwardsNew").click(function(){
        if ($("#collapseAwardsEdit").hasClass("in")) {
            $("#collapseAwardsEdit").collapse("hide");
        }
    });

    $("#btnOnlyAwardsEdit").click(function(){
        if(dataRowDetailsAwards == ""){
            alertify.error("Та засах мөрөө дарж сонгоно уу!!!");
            $("#collapseAwardsEdit").collapse("hide");
            return;
        }
        if ($("#collapseAwardsNew").hasClass("in")) {
            $("#collapseAwardsNew").collapse("hide");
        }
        if ($("#collapseAwardsEdit").hasClass("in")) {
            $("#collapseAwardsEdit").collapse("hide");
        }
        else{
            $("#cmbDetailsAwardsCountryEdit").val(dataRowDetailsAwards["country"]);
            $.ajax({
                type: 'post',
                url: $("#cmbDetailsAwardsEeljEdit").attr("post-url"),
                data: {
                    _token: $('meta[name=csrf-token]').attr("content"),
                    country:dataRowDetailsAwards["country"],
                    rd: $("#txtDetailsEditRegister").val()
                },
                success:function(response){
                  console.log(response);
                  $("#cmbDetailsAwardsEeljEdit").prop('disabled', false).find('option[value]').remove();
                  $("#cmbDetailsAwardsEeljEdit")
                      .append($("<option></option>")
                      .attr("value", "-1")
                      .text("Сонгоно уу"));
                  $.each(response, function (key, value) {
                      $("#cmbDetailsAwardsEeljEdit")
                          .append($("<option></option>")
                          .attr("value", value.eelj)
                          .text(value.eelj));
                  });
                  $("#cmbDetailsAwardsEeljEdit").val(dataRowDetailsAwards["eelj"]);
                  $("#txtDetailsAwardsMemoEdit").val(dataRowDetailsAwards["tailbar"]);
                  $("#collapseAwardsEdit").collapse("show");
                }
            });
        }

    });

    // start awards details mission zasah hesgiin uls songuul eelj fill hiih heseg
    $("#cmbDetailsAwardsCountryEdit").change(function(){
        $.ajax({
            type: 'post',
            url: $("#cmbDetailsAwardsEeljEdit").attr('post-url'),
            data: {
              _token: $('meta[name=csrf-token]').attr("content"),
              country:$("#cmbDetailsAwardsCountryEdit").val(),
              rd: $("#txtDetailsEditRegister").val()
            },
            success:function(response){
              $("#cmbDetailsAwardsEeljEdit").prop('disabled', false).find('option[value]').remove();
              $("#cmbDetailsAwardsEeljEdit")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("#cmbDetailsAwardsEeljEdit")
                      .append($("<option></option>")
                      .attr("value", value.eelj)
                      .text(value.eelj));
              });
            }
        });
    });
    // end awards details mission zasah hesgiin uls songuul eelj fill hiih heseg

    // start mission details mission nemeh hesgiin uls songuul eelj fill hiih heseg
    $("#cmbDetailsAwardsCountryNew").change(function(){
        $.ajax({
            type: 'post',
            url: $("#cmbDetailsAwardsEeljEdit").attr("post-url"),
            data: {
              _token: $('meta[name=csrf-token]').attr("content"),
              country:$("#cmbDetailsAwardsCountryNew").val(),
              rd: $("#txtDetailsEditRegister").val()
            },
            success:function(response){
              $("#cmbDetailsAwardsEeljNew").prop('disabled', false).find('option[value]').remove();
              $("#cmbDetailsAwardsEeljNew")
                  .append($("<option></option>")
                  .attr("value", "-1")
                  .text("Сонгоно уу"));
              $.each(response, function (key, value) {
                  $("#cmbDetailsAwardsEeljNew")
                      .append($("<option></option>")
                      .attr("value", value.eelj)
                      .text(value.eelj));
              });
            }
        });
    });
    // end mission details mission nemeh hesgiin uls songuul eelj fill hiih heseg
});
// END SECTION AWARDS


function fillAssignedCountry(register){
    $.ajax({
        type: 'post',
        url: $("#cmbDetailsAwardsCountryEdit").attr('post-url'),
        data: {
          _token: $('meta[name=csrf-token]').attr("content"),
          rd: register,
        },
        success:function(response){
          $("#cmbDetailsAwardsCountryNew").prop('disabled', false).find('option[value]').remove();
          $("#cmbDetailsAwardsCountryNew")
              .append($("<option></option>")
              .attr("value", "-1")
              .text("Сонгоно уу"));
          $.each(response.msg, function (key, value) {
              $("#cmbDetailsAwardsCountryNew")
                  .append($("<option></option>")
                  .attr("value", value.country)
                  .text(value.countryName));
          });

          $("#cmbDetailsAwardsCountryEdit").prop('disabled', false).find('option[value]').remove();
          $("#cmbDetailsAwardsCountryEdit")
              .append($("<option></option>")
              .attr("value", "-1")
              .text("Сонгоно уу"));
          $.each(response.msg, function (key, value) {
              $("#cmbDetailsAwardsCountryEdit")
                  .append($("<option></option>")
                  .attr("value", value.country)
                  .text(value.countryName));
          });
        }
    });
}


// Empty inputs
function emptyMissionNew(){
    $("#cmbDetailsCountryNew").val('-1');
    $("#cmbDetailsEeljNew").val('-1');
    $("#txtDetailsRankNew").val('');
    $("#txtDetailsPositionNew").val('');
}

function emptyMissionEdit(){
    $("#cmbDetailsCountryEdit").val('-1');
    $("#cmbDetailsEeljEdit").val('-1');
    $("#txtDetailsRankEdit").val('');
    $("#txtDetailsPositionEdit").val('');
}
