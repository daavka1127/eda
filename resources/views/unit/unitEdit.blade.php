{{-- START NEW UNIT --}}
<div class="modal fade" id="editUnitModal">
  <div class="modal-dialog" style="width:55%;">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title">Анги засах</h3>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        {{-- <form id="frmNewCountry" action="{{ action('countryController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left"> --}}
        <div id="frmEditUnit" data-parsley-validate class="form-horizontal form-label-left">
          <input name="_token" type="hidden" value="{{ csrf_token() }}" />
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ангийн код <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" class="form-control" name="editId" id="numbEditId" />
              <input type="hidden" class="form-control" name="editOldId" id="hidEditOldId" />
            </div>
            <div class="col-md-3" id="error_message1"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Харъяа <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="unitParent" id="cmbEditUnitParent" class="form-control">
                <option value="-1">Сонгоно уу</option>
                <option value="ЗХЖШ">ЗХЖШ</option>
                <option value="ХЗЦ">ХЗЦ</option>
                <option value="АЦК">АЦК</option>
				<option value="ЦЕГ">ЦЕГ</option>
				<option value="ШШГЕГ">ШШГЕГ</option>
				<option value="ХХЕГ">ХХЕГ</option>
				<option value="ОБЕГ">ОБЕГ</option>
				<option value="ТЕГ">ТЕГ</option>
				<option value="ДЦ">ДЦ</option>
				<option value="Бусад">Бусад</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Анги <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control" name="txtEditUnit" id="txtEditUnit" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Тайлбар <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control" name="txtEditMemo" id="txtEditMemo" />
            </div>
          </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="button" id="btnEditUnit" class="btn btn-success">Засах</button>
            </div>
          </div>
        </div>

      <div class = "modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
      </div>

    </div>
  </div>
</div>
{{-- END NEW UNIT --}}
