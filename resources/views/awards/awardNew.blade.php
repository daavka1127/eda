{{-- START NEW COUNTRY --}}
<div class="modal fade" id="newAward">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        <form id="frmNewCountry" action="{{ action('awardsController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div id="frmNewAward" method="post" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-2">
                  <label class="fore-red" for="">Ажиллагааны нэр => </label>
              </div>
              <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
                  <select class="form-control" name="cmbNewAwardCountry" id="cmbNewAwardCountry">
                    <option value="-1">Сонгоно уу</option>
                    @foreach($countries as $country)
                      <option value="{{$country->id}}">{{$country->countryName}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-1">
                  <label class="fore-red" for="">Ээлж => </label>
              </div>
              <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-3">
                  <select class="form-control" name="cmbNewAwardEelj" id="cmbNewAwardEelj">
                    <option value="-1">Сонгоно уу</option>
                  </select>
              </div>
              <div class="clearfix"></div>
              <h4 class="fore-red" >ЦАХ сонгоно уу</h4>
              <table id="dtEmps" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                  <tr>
                    <th>РД</th>
                    <th>Овог</th>
                    <th>Нэр</th>
                  </tr>
                </thead>
              </table>
          </div>

          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-5">
              <label for="">Тайлбар: </label>
              <textarea id="memoAward" class="form-control" name="memoAward"></textarea>
          </div>
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-5">
              <label for="">Огноо: </label>
              <div class="controls">
                <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" name="arriveDate" autocomplete="off" id="single_cal2" aria-describedby="inputSuccess2Status">
                  <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  <span id="inputSuccess2Status" class="sr-only">(success)</span>
                </div>
              </div>
          </div>
          <div class="clearfix"></div>
          <button type="button" class="btn btn-success" id="btnPostNewAward">Хадгалах</button>
      </div>
    </form>
<div class="clearfix"></div>
      <div class = "modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
      </div>

    </div>
  </div>
</div>
{{-- END NEW COUNTRY --}}
