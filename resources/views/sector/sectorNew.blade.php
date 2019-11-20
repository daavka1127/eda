{{-- START NEW COUNTRY --}}
<div class="modal fade" id="newSector">
  <div class="modal-dialog" style="width:55%;">
    <div class="modal-content">

      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">X</button>
        <div class="row">
          <div class="">
            <h3 class="modal-title">Салбар нэмэх</h3>
          </div>
        </div>
      </div>

      <div class="modal-body">
        {{-- <form id="frmNewCountry" action="{{ action('countryController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left"> --}}
        <div id="frmNewSecotr" method="post" data-parsley-validate class="form-horizontal form-label-left">
          <input name="_token" type="hidden" value="{{ csrf_token() }}" />
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ажиллагааны орон: <span class="required">*</span>
            </label>
            <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblCountryNameNew">
            </label>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Салбарын нэр <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="txtSectorNew" name="txtSectorNew" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button id="btnNewSector" type="button" class="btn btn-success">Нэмэх</button>
            </div>
          </div>
        </div>
      </div>

      <div class = "modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
      </div>

    </div>
  </div>
</div>
{{-- END NEW COUNTRY --}}
