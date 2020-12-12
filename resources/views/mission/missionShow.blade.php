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

  $(document).ready(function() {
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
          "stateSave": true,
          "columns": [
            { data: "country", name: "country", "visible":false },
            { data: "eelj", name: "eelj", "visible":false },
            { data: "readMore", name: "readMore" },
            { data: "id", name: "id",  render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }  },
            { data: "countryName", name: "countryName" },
            { data: "eelj", name: "eelj" },
            { data: "RD", name: "RD" },
            { data: "lastName", name: "lastName" },
            { data: "firstname", name: "firstname" },
            { data: "unit", name: "unit" },
            { data: "rankCode", name: "rankCode" },
            { data: "operationRank", name: "operationRank" },
            { data: "countOp", name: "countOp" },
            { data: "date", name: "date" },
            { data: "name", name: "name" }
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
    var getAwardsReadmore = "{{ url('/readmore/awards/rd') }}";
    var getPunishmentsReadmore = "{{ url('/readmore/punishments/rd') }}";

    var correctImageUrl = "{{url('public/images/correct.png')}}";
    var wrongImageUrl = "{{url('public/images/wrong.png')}}";
    var loading_smallImageUrl = "{{url('public/images/loading_small.gif')}}";
</script>

<div class="form-group col-md-12">
      <div class="form-group">
          <div class="col-md-2">
              <h5 class="fore-red"><strong>Ажиллагааны нэр -> </strong></h5>
          </div>
          <div class="col-md-3">
            <select class="form-control" id="cmbCountry">
                <option value="-1">Сонгоно уу</option>
              @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->countryName}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-1">
              <h5 class="fore-red"><strong>Ээлж -> </strong></h5>
          </div>
          <div class="col-md-3">
            <select class="form-control" id="cmbEelj" name="cmbEelj">

            </select>
          </div>
          <div class="col-md-2">
            <input type="button" class="btn btn-danger" post-url="{{url("/delete/all/emp/eelj")}}" id="btnDeleteAllPeopleThisEelj" name="" value="Энэ ээлжийн хүмүүсийг устгах">
          </div>
      </div>
      <div class="clearfix"></div>

      <h3><strong>Энхийг дэмжих ажиллагааны ЦАХ</strong></h3>
      <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th>Команд</th>
            <th>ID</th>
            <th>Ажиллагааны улс</th>
            <th>Ээлж</th>
            <th>Регистрийн дугаар</th>
            <th>Овог</th>
            <th>Нэр</th>
            <th>Анги</th>
            <th>Үндсэн цол</th>
            <th>Ажиллагааны албан тушаал</th>
            <th>Ажиллагаанд явсан тоо</th>
            <th>Бүртгэл хийсэн огноо</th>
            <th>Админ</th>
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
      <div class="clearfix"></div>
      <br>
      <!-- <iframe src="{{url('/public/pdf/showPdf.pdf')}}" style="width: 100%;height: 500px;border: none;"></iframe> -->
</div>
    @include('mission.missionNew')
    @include('mission.missionEdit')
    @include('mission.missionDetails')
    <script src="{{url('public/js/employee/employee.js')}}"></script>
    <script src="{{url('public/js/employee/employeeEdit.js')}}"></script>
    <script src="{{url('public/js/employee/employeeDelete.js')}}"></script>
    <script src="{{url('public/js/employee/employeeDetails.js')}}"></script>

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
