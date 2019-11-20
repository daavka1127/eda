{{-- START NEW COUNTRY --}}
<div class="modal fade" id="editTrainingMission">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        {{-- <form id="frmNewCountry" action="{{ action('countryController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left"> --}}
        <div id="frmEditTraining" method="post" data-parsley-validate class="form-horizontal form-label-left">
          <input name="_token" type="hidden" value="{{ csrf_token() }}" />
          <h4>Цэргийн албан хаагч</h4>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Регистрийн дугаар: </label>
              <input type="text" id="txtEditRegister" maxlength="10" class="form-control">
              <input type="hidden" id="hideOldRegister" value="1" maxlength="10" class="form-control">
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Овог: </label>
              <input type="text" id="txtEditLastname" class="form-control">
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Нэр: </label>
              <input type="text" id="txtEditFirstname" class="form-control">
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Анги: </label>
              <select class="form-control" id="cmbEditUnit" name="cmbEditUnit">
                <option value="-1">Сонгоно уу</option>
                @foreach($units as $unit)
                  <option value="{{$unit->id}}">{{$unit->unit}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
              <label for="">Албан тушаал: </label>
              <input type="text" id="txtEditRank" class="form-control">
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
              <br><label for="" id="EditSex">Хүйс:</label>
          </div>
          <div class="clearfix"></div>


          <h4>Сургалт</h4>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Сургалтын төрөл: </label>
              <select class="form-control" id="cmbEditTrainingType">
                <option value="-1">Сонгоно уу</option>
                <option value="1">Сургууль</option>
                <option value="2">Дамжаа</option>
                <option value="3">Сургалт</option>
                <option value="4">Семинар</option>
              </select>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Улс: </label>
              <select class="form-control" id="cmbEditTrainingCountry" name="cmbEditTrainingCountry">
                <option value="-1">Сонгоно уу</option>
                @foreach ($trainingCountries as $trainingCountry)
                    <option value="{{$trainingCountry->countryName}}">{{$trainingCountry->countryName}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Явсан огноо: </label>
              <div>
                <div class="controls">
                  <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" name="editLeaveDate" autocomplete="off" id="single_cal3" aria-describedby="inputSuccess2Status">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    <span id="inputSuccess2Status" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
            <label>Ирсэн өдөр</label><br>
            <div>
              <div class="controls">
                <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" name="editArriveDate" autocomplete="off" id="single_cal4" aria-describedby="inputSuccess2Status">
                  <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  <span id="inputSuccess2Status" class="sr-only">(success)</span>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-12">
              <label for="">Юунд: </label>
              <input type="text" id="txtEditSurgaltName" class="form-control">
          </div>
          <div class="clearfix"></div>

          <div class="col-md-6" id="error_message"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
              <button id="btnEditTraining" type="button" class="btn btn-success">Засах</button>
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
