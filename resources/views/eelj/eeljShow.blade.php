@extends('layouts.layout_main')

@section('content')

  <!-- Datatables -->
  <link href="{{url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

  <style media="screen">
  #tableEelj tbody tr.selected {
    color: white;
    background-color: #8893f2;
  }
  #tableEelj tbody tr{
  cursor: pointer;
  }
</style>
@if(Auth::user()->permission == 0)
  <p class="search-title">Та энэ хэсэг рүү нэвтрэх боломжгүй</p>
@else
  {{-- START Country --}}
  <script>
      var correctImageUrl = "{{url('public/images/correct.png')}}";
      var wrongImageUrl = "{{url('public/images/wrong.png')}}";
      var loading_smallImageUrl = "{{url('public/images/loading_small.gif')}}";

      var newUrl = "{{ url('/new/country/') }}";
      var editUrl = "{{ url('/update/country/') }}";
      var deleteUrl = "{{ url('/delete/country/') }}";
      var showCountryUrl = "{{ url('/show/country/') }}";
      var loadingImageUrl = "{{ url('public/images/loading.gif') }}";
      var getCountriesUrl = "{{ url('/get/country') }}";
      var lastIndex = null;

      var newOperationUrl = "{{ url('/new/operation/') }}";
      var editOperationUrl = "{{ url('/update/operation/') }}";
      var deleteOperationUrl = "{{ url('/delete/operation/') }}";
      var showOperationUrl = "{{ url('/show/operation/') }}";
      var checkOperationInsert = "{{ url('/check/operation/') }}";

      var getEeljUrlDatatable = "{{url('/get/eelj/datatable')}}";
      var dataRow = "";

      $(document).ready(function() {
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
              "order": [[ 2, "asc" ]],
              // "stateSave": true,
              "ajax":{
                       "url": "{{url('/get/eelj/datatable')}}",
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

          $('#tableEelj tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#tableEelj').DataTable().row(currow).data();
          }
          });
      });
  </script>



  <div class="col-md-10">
    {{-- START OPERATION DIV --}}
    <div id="operations">
      <h3><strong>Явагдсан ажиллагаа</strong></h3>
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
        <label for="">Ээлжээ сонгоно уу</label>
        <select name="cmbCountry" id="cmbCountry" class="form-control">
          <option value="-1">Сонгоно уу</option>
          @foreach ($countries as $country)
              <option value="{{$country->id}}">{{$country->countryName}}</option>
          @endforeach
        </select>
      </div>
      <br>
      <table id="tableEelj" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
          <tr>
            <th>№</th>
            <th>uls id</th>
            <th>Улс</th>
            <th>Ээлж</th>
            <th>Явсан өдөр</th>
            <th>Ирсэн өдөр</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newOperation">Ээлж нэмэх</button>
      <button type="button" class="btn btn-warning" id="btnEditEelj" data-toggle="modal">Ээлж засах</button>
      <button type="button" class="btn btn-danger" id="btnDeleteEelj" data-toggle="modal">Ээлж устгах</button>
    </div>
    {{-- END OPERATION DIV --}}
    @include('ajillagaa.operationNew')
    @include('ajillagaa.operationEdit')
  </div>
  <div class="clearfix">

  </div>
  <script src="{{url('public/js/ajillagaa/operation.js')}}"></script>
@endif

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
