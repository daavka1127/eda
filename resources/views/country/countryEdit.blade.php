{{-- START NEW COUNTRY --}}
<div class="modal fade" id="editCountry">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title">Улс засах</h3>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body" id="modalEditCountry">
        <div id="frmEditCountry" data-parsley-validate class="form-horizontal form-label-left">
          <input name="_token" id="_token" type="hidden" value="{{ csrf_token() }}" />
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Улсын нэр <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="txtCountryEdit" name="txtCountryEdit" required="required" class="form-control col-md-7 col-xs-12">
              <input type="hidden" value="" name="countryID" id="countryID" />
              {{-- {{countryName}} --}}
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="button" id="btnEditCountry" class="btn btn-success">Засах</button>
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
