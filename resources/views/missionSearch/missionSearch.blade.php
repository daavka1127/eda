@extends('layouts.layout_main')

@section('content')

  <!-- Datatables -->
  {{-- <script src="{{url('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script> --}}


    <!-- Datatables -->
    <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

  <script>

  var data = "";
  var register = "";

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
          "columns": [
            { data: "readMore", name: "readMore" },
            { data: "RD", name: "RD"},
            { data: "lastName", name: "lastName" },
            { data: "firstname", name: "firstname"},
            { data: "countOp", name: "countOp" }
            ]
      });
  });



$(document).ready(function(){
    $('#datatable tbody').on( 'click', 'tr', function () {

        var currow = $(this).closest('tr');
        $('#datatable tbody tr').css("background-color", "white");
        $(this).closest('tr').css("background-color", "yellow");
        register = currow.find('td:eq(4)').text();
        data = $('#datatable').DataTable().row(currow).data();
    });
});

    var getEeljUrl = "{{ url('/get/eelj') }}";
    var getSectionUrl = "{{ url('/get/sectors/combobox') }}";
    var searchUrl = "{{ url('/mission/search1') }}";
    var getEmpByRDUrl = "{{ url('/get/emp/byRD') }}";
    var getMissionByRD = "{{ url('/get/mission/rd') }}";
    var getAwardsReadmore = "{{ url('/readmore/awards/rd') }}";
    var getPunishmentsReadmore = "{{ url('/readmore/punishments/rd') }}";
    var getTraningsReadmore = "{{ url('/readmore/training/rd') }}";
    var printReportUrl = "{{url('/report/employee/details')}}" + "/";

</script>


<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
  <label>Регистрийн дугаар</label>
  <input type="text" id="txtRegister" maxlength="10" class="form-control">
</div>
<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
  <label>Овог</label>
  <input type="text" id="txtLastname" maxlength="50" class="form-control">
</div>
<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
  <label>Нэр</label>
  <input type="text" id="txtFirstname" maxlength="50" class="form-control">
</div>
<div class="clearfix"></div>
<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
  <label>Ажиллагааны нэр</label>
  <select class="form-control" name="cmbOperationName" id="cmbOperationName">
      <option value="-1">Сонгоно уу</option>
      @foreach($countries as $country)
        <option value="{{$country->id}}">{{$country->countryName}}</option>
      @endforeach
  </select>
</div>
<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
  <label>Ээлжийн дугаар</label>
  <select class="form-control" name="cmbEelj" id="cmbEelj">
      <option value="-1">Сонгоно уу</option>
  </select>
</div>
<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
  <label>Салбар</label>
  <select class="form-control" name="cmbSection" id="cmbSection">
      <option value="-1">Сонгоно уу</option>
  </select>
</div>


<div class="clearfix"></div>

<h3><strong>Үр дүн</strong></h3>
<table id="datatable" class="table table-striped table-bordered" style="width:100%;">
  <thead>
    <tr>
      <th></th>
      <th>Регистрийн дугаар</th>
      <th>Овог</th>
      <th>Нэр</th>
      <th>Ажиллагаанд явсан тоо</th>
    </tr>
  </thead>

</table>
<div class="clearfix"></div>
<br>
<!-- <iframe src="{{url('/public/pdf/showPdf.pdf')}}" style="width: 100%;height: 500px;border: none;"></iframe> -->
    @include('mission.missionDetails')
    <script src="{{url('public/js/missionSearch/missionSearch.js')}}"></script>
    <script src="{{url('public/js/employee/employeeDetails.js')}}"></script>

    <!-- Datatables -->
    <script src="{{ url('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{url('public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{url('public/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{url('public/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('public/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

@endsection
