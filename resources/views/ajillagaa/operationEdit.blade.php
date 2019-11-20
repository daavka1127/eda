{{-- START NEW COUNTRY --}}
<div class="modal fade" id="editOperation">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title">Ажиллагаа засах</h3>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        {{-- <form id="frmNewCountry" action="{{ action('countryController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left"> --}}
        <div id="frmEditOperation" method="post" data-parsley-validate class="form-horizontal form-label-left">
          <input name="_token" type="hidden" value="{{ csrf_token() }}" />
          <input name="opirationID" id="opirationID" type="hidden" value="" />
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Улсын нэр <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="cmbEditCountry" name="country">
                @foreach($countries as $country)
                  <option value="{{$country->id}}">{{$country->countryName}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ээлж <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" class="form-control" name="eelj" id="txtEditEelj" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Явсан өдөр <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="controls">
                <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" name="txtEditLeaveDate" id="single_cal3" aria-describedby="inputSuccess2Status">
                  <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  <span id="inputSuccess2Status" class="sr-only">(success)</span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ирсэн өдөр <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="controls">
                <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" name="txtEditArriveDate" id="single_cal4" aria-describedby="inputSuccess2Status">
                  <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  <span id="inputSuccess2Status" class="sr-only">(success)</span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button id="btnEditOperation" type="button" class="btn btn-success">Хадгалах</button>
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
