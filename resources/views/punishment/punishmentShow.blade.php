@extends('layouts.layout_main')

@section('content')
    <!-- Datatables -->
    <link href="public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <script>

        $(document).ready(function(){
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
                         "url": "{{ url('/get/punishments/by/eelj') }}",
                         "dataType": "json",
                         "type": "POST",
                         "data":{
                              _token: "{{ csrf_token() }}"
                            }
                       },
                "columns": [
                    { data: "id", name: "id", "visible":false },
                    { data: "countryName", name: "countryName" },
                    { data: "eelj", name: "eelj" },
                    { data: "sectorName", name: "sectorName" },
                    { data: "RD", name: "RD" },
                    { data: "lastName", name: "lastName" },
                    { data: "firstname", name: "firstname" },
                    { data: "rankTypeName", name: "rankTypeName" },
                    { data: "rankName", name: "rankName" },
                    { data: "operationRank", name: "operationRank" },
                    { data: "tailbar", name: "tailbar" },
                    { data: "date", name: "date" },
                    { data: "name", name: "name" }
                  ]
            });
        });
        var data = "";
        var getPunishmentsUrl="{{ url('/get/punishments/by/eelj') }}";
        var getEeljUrl = "{{ url('/get/eelj') }}";
        var getAllEmpUrl = "{{ url('/get/emp/nameRd') }}";
        var newUrl = "{{url('/new/punishment')}}";
        var editUrl = "{{url('/update/punishment')}}";
        var deleteUrl = "{{url('/delete/punishment')}}";
        var rdNew = "";
        var rdEdit = "";
        var rdDelete = "";


        $(document).ready(function(){
            $('#datatable tbody').on( 'click', 'tr', function () {

                var currow = $(this).closest('tr');
                $('#datatable tbody tr').css("background-color", "white");
                $(this).closest('tr').css("background-color", "yellow");
                data = $('#datatable').DataTable().row(currow).data();
                rdEdit = data["RD"];
                rdDelete = data["RD"];
            });
        });

    </script>

    <div class="clearfix"></div>
    <h3><strong>Энхийг дэмжих ажиллагааны шийтгэлийн байдал</strong></h3>
    <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th rowspan="2">ID</th>
          <th rowspan="2">Ажиллагааны нэр</th>
          <th rowspan="2">Ээлж</th>
          <th rowspan="2">Салбар</th>
          <th rowspan="2">РД</th>
          <th rowspan="2">Овог</th>
          <th rowspan="2">Нэр</th>
          <th colspan="2">Ажиллагааны</th>
          <th rowspan="2">Ажиллагааны албан тушаал</th>
          <th rowspan="2">Шийтгэл</th>
          <th rowspan="2">Бүртгэл хийсэн огноо</th>
          <th rowspan="2">Админ</th>
        </tr>
        <tr>
          <th>Цол</th>
          <th>Цол</th>
        </tr>
      </thead>

    </table>

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newPunishment" id="btnNewPunishment">Нэмэх</button>
    <button type="button" class="btn btn-warning" id="btnEditPunishment">Засах</button>
    <button type="button" class="btn btn-danger" id="btnDeletePunishment">Устгах</button>
    <div class="clearfix"></div>
    <br>
    <!-- <iframe src="{{url('/public/pdf/showPdf.pdf')}}" style="width: 100%;height: 500px;border: none;"></iframe> -->
<script src="{{url('public/js/punishment/punishment.js')}}"></script>
    @include('punishment.punishmentNew')
    @include('punishment.punishmentEdit')

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
