@extends('layouts.layout_main')

@section('content')

  <!-- Datatables -->
  <link href="public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <style media="screen">
  #tableCountries tbody tr.selected {
    color: white;
    background-color: #8893f2;
  }
  #tableCountries tbody tr{
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

      var getCountriesUrlDatatable = "{{url('/get/country/datatable')}}";
      var dataRow = "";

      $(document).ready(function() {
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
                       "url": "{{url('/get/country/datatable')}}",
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

          $('#tableCountries tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#tableCountries').DataTable().row(currow).data();
          }
          });
      });
  </script>
  <script src="{{url('public/js/country/country.js')}}"></script>
  <script src="{{url('public/js/ajillagaa/operation.js')}}"></script>

  <div class="col-md-10">
    <div id="countries">
      <h3><strong>Ажиллагааны улс</strong></h3>
      <table id="tableCountries" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
          <tr>
            <th>№</th>
            <th>Улс</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newCountry">Улс нэмэх</button>
      <button type="button" class="btn btn-warning" id="btnEditModalShow" data-toggle="modal">Улс засах</button>
      <button type="button" class="btn btn-danger" id="btnDeleteCountry" data-toggle="modal">Улс устгах</button>
    </div>
    {!!session('success_message')!!}
    {!!session('error_message')!!}
    {{session(['success_message' => ''])}}
    {{session(['error_message' => ''])}}
    @include('country.countryNew')
    @include('country.countryEdit')
  </div>
  {{-- END Country --}}
@endif

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
