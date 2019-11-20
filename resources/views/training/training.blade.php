@extends('layouts.layout_main')

@section('content')
    <!-- Datatables -->
    <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

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
                "processing": true,
                "serverSide": true,
                "ajax":{
                         "url": "{{url('/get/trainings')}}",
                         "dataType": "json",
                         "type": "POST",
                         "data":{
                              _token: "{{ csrf_token() }}"
                            }
                       },
                "columns": [
                    { data: "id", name: "id" },
                    { data: "RD", name: "RD"},
                    { data: "lastName", name: "lastName"},
                    { data: "firstname", name: "firstname" },
                    { data: "unit", name: "unit" },
                    { data: "trainingTypeName", name: "trainingTypeName" },
                    { data: "trainingCoutnry", name: "trainingCoutnry" },
                    { data: "trainingName", name: "trainingName" },
                    { data: "leaveDate", name: "leaveDate" },
                    { data: "arriveDate", name: "arriveDate" },
                    { data: "date", name: "date" },
                    { data: "name", name: "name" },
                    { data: "unitID", name: "unitID", "visible":false },
                    { data: "rank", name: "rank", "visible":false },
                    { data: "trainingTypeID", name: "trainingTypeID", "visible":false }
                  ]
            });
        });
    </script>

    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <h3><strong>Цэргийн албан хаагчдын сургалт, дамжаа</strong></h3>
        </div>
    </div>

    <div class="row">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Регистрийн дугаар</th>
                    <th>Овог</th>
                    <th>Нэр</th>
                    <th>Анги</th>
                    <th>Сургалтын төрөл</th>
                    <th>Улс</th>
                    <th>Тайлбар</th>
                    <th>Явсан огноо</th>
                    <th>Ирсэн огноо</th>
                    <th>Бүртгэсэн огноо</th>
                    <th>Админ</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="text-left">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newTrainingMission">Нэмэх</button>
        <button type="button" class="btn btn-warning" id="btnShowEditTrainingModal">Засах</button>
        <button type="button" class="btn btn-danger" id="btnDeleteTraining">Устгах</button>
    </div>

<script>
    var getEmpUrl = "{{url('get/emp/byRD')}}";
    var getTrainingsUrl = "{{url('/get/trainings')}}";
    var newTrainingUrl = "{{url('/training/new')}}";
    var editTrainingUrl = "{{url('/training/update')}}";
    var deleteTrainingUrl = "{{url('/training/delete')}}";
    var huis = "";
    var csrf = "{{ csrf_token() }}";
    var data="";
    var rgEdit = "";
    var rdDelete = "";

    $(document).ready(function(){
        $('#datatable tbody').on( 'click', 'tr', function () {

            var currow = $(this).closest('tr');
            $('#datatable tbody tr').css("background-color", "white");
            $(this).closest('tr').css("background-color", "yellow");
            data = $('#datatable').DataTable().row(currow).data();
            rgEdit = data["RD"];
            rdDelete = data["RD"];
        });
    });
</script>
<script src="{{url('public/js/training/training.js')}}"></script>
@include('training.trainingNew')
@include('training.trainingEdit')

<!-- Datatables -->
<script src="{{url('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
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
