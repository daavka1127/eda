@extends('layouts.layout_main')

@section('content')

  <!-- Datatables -->
  {{-- <script src="{{url('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script> --}}


    <!-- Datatables -->
    <link href="public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <script>

  var data = "";

  $(document).ready(function(){
      $('#datatable').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax":{
                   "url": "{{ url('/sda/getSspClass') }}",
                   "dataType": "json",
                   "type": "GET"
                 },
          "columns": [
              { json: "country", name: "country", "visible":false },
              { json: "eelj", name: "eelj", "visible":false },
              { json: "sector", name: "sector", "visible":false },
              { json: "rankType", name: "rankType", "visible":false },
              { json: "rankCode", name: "rankCode", "visible":false },
              { json: "readMore", name: "readMore" },
              { json: "id", name: "id" },
              { json: "countryName", name: "countryName" },
              { json: "eelj", name: "eelj" },
              { json: "sectorName", name: "sectorName" },
              { json: "RD", name: "RD" },
              { json: "lastName", name: "lastName" },
              { json: "firstname", name: "firstname" },
              { json: "unit", name: "unit" },
              { json: "TypeName", name: "TypeName" },
              { json: "RankName", name: "RankName" },
              { json: "operationRank", name: "operationRank" },
              { json: "countOp", name: "countOp" },
              { json: "date", name: "date" },
              { json: "name", name: "name" }
            ]
      });
  });


$(document).ready(function(){
    $('#datatable tbody').on( 'click', 'tr', function () {

        var currow = $(this).closest('tr');
        $('#datatable tbody tr').css("background-color", "white");
        $(this).closest('tr').css("background-color", "yellow");
        updateRD = currow.find('td:eq(4)').text();
        data = $('#datatable').DataTable().row(currow).data();

        // $("#txtEditRegister").val(updateRD);
        // $("#txtEditLastname").val(currow.find('td:eq(5)').text());
        // $("#txtEditFirstname").val(currow.find('td:eq(6)').text());
        // $("#cmbEditUnit").val(currow.find('td:eq(7)').text());
        // alert(currow.find('td:eq(1)').text());
    });
});

    var newUrl = "{{ url('/new/mission') }}";
    var editUrl = "{{ url('/update/mission') }}";
    var deleteUrl = "{{ url('/delete/mission') }}";
    var getEeljUrl = "{{ url('/get/eelj') }}";
    var getRankUrl = "{{ url('/get/ranks') }}";
    var getSectorUrl = "{{ url('/get/sectors/combobox') }}";
    var getEmpByRDUrl = "{{ url('get/emp/byRD') }}";
    var checkMissionUrl = "{{ url('/check/mission') }}";
    var getMissionsUrl = "{{ url('/get/mission') }}";
    var getMissionByRD = "{{ url('/get/mission/rd') }}";

    var correctImageUrl = "{{url('public/images/correct.png')}}";
    var wrongImageUrl = "{{url('public/images/wrong.png')}}";
    var loading_smallImageUrl = "{{url('public/images/loading_small.gif')}}";
</script>

<div class="form-group col-md-12">
      <div class="clearfix"></div>

      <h3><strong>Энхийг дэмжих ажиллагааны ЦАХ</strong></h3>
      <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>ID</th>
            <th>Ажиллагааны улс</th>
            <th>Ээлж</th>
            <th>Салбар</th>
            <th>Регистрийн дугаар</th>
            <th>Овог</th>
            <th>Нэр</th>
            <th>Анги</th>
            <th>Ажиллагааны цол</th>
            <th>Ажиллагааны цол</th>
            <th>Ажиллагааны албан тушаал</th>
            <th>Ажиллагаанд явсан тоо</th>
            <th>Бүртгэл хийсэн огноо</th>
            <th>Админ</th>
          </tr>
          <tr id="datatableSearch">
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>

      </table>
      <div class="text-left">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newEmpMission">Нэмэх</button>
          <button type="button" class="btn btn-warning" id="btnEditEmpMission">Засах</button>
          <button type="button" class="btn btn-danger" id="btnDeleteMission">Устгах</button>
          <button type="button" class="btn btn-danger pull-right" id="">Шийтгэл</button>
          <button type="button" class="btn btn-success pull-right" id="">Шагнал</button>
      </div>
</div>


    <!-- Datatables -->
    <script src="public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="public/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="public/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="public/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="public/vendors/jszip/dist/jszip.min.js"></script>
    <script src="public/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="public/vendors/pdfmake/build/vfs_fonts.js"></script>

@endsection
