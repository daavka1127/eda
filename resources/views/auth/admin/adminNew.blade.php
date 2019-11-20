{{-- START NEW COUNTRY --}}
<div class="modal fade" id="newAmdin">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        {{-- <form id="frmNewCountry" action="{{ action('countryController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left"> --}}
        <div id="frmNewEmpMission" method="post" data-parsley-validate class="form-horizontal form-label-left">
          <input name="_token" type="hidden" value="{{ csrf_token() }}" />
          <h4>Цэргийн албан хаагч</h4>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Регистрийн дугаар: </label>
              <input type="text" id="txtNewRegister" maxlength="10" class="form-control">
              <input type="hidden" id="hideInsertOrUpdate" value="1" maxlength="10" class="form-control">
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Овог: </label>
              <input type="text" id="txtNewLastname" class="form-control">
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Нэр: </label>
              <input type="text" id="txtNewFirstname" class="form-control">
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Анги: </label>
              <select class="form-control" id="cmbNewUnit" name="cmbNewUnit">
                <option value="-1">Сонгоно уу</option>
                @foreach($units as $unit)
                  <option value="{{$unit->id}}">{{$unit->unit}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
              <label for="">Албан тушаал: </label>
              <input type="text" id="txtNewRank" class="form-control">
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
              <br><label for="" id="newSex">Хүйс:</label>
          </div>
          <div class="clearfix"></div>
          <h4>Ажиллагаа</h4>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Ажиллагааны улс: </label>
              <select class="form-control" id="cmbNewCountry">
                <option value="-1">Сонгоно уу</option>
                @foreach($countries as $country)
                  <option value="{{$country->id}}">{{$country->countryName}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Ээлж: </label>
              <select class="form-control" id="cmbNewEelj" name="cmbNewEelj">
                <option value="-1">Сонгоно уу</option>
              </select>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
            <label for="">Ажиллагааны цол: </label>
            <select class="form-control" id="cmbNewRankType">
              <option value="-1">Сонгоно уу</option>
              @foreach($rankTypes as $rankType)
                <option value="{{$rankType->rankTypeID}}">{{$rankType->TypeName}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Ажиллагааны цол: </label>
              <select class="form-control" id="cmbNewRank" name = "cmbNewRank">
                <option value="-1">Сонгоно уу</option>
              </select>
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <label for="">Салбар: </label>
              <select class="form-control" id="cmbNewSector" name="cmbNewSector">
                <option value="-1">Сонгоно уу</option>
              </select>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
              <label for="">Ажиллагааны албан тушаал: </label>
              <input type="text" id="txtNewOperationRank" class="form-control">
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
              <input type="hidden" id="hideIsInsertMission" value="0">
          </div>
          <div class="clearfix"></div>

          <div class="col-md-6" id="error_message"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button id="btnNewEmpMission" type="button" class="btn btn-success">Нэмэх</button>
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
