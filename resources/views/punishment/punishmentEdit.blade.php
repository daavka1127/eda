{{-- START NEW COUNTRY --}}
<div class="modal fade" id="EditPunishment">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <strong>Цэргийн албан хаагчийн шийтгэл засах</strong><button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        <form id="frmEditCountry" action="{{ action('punishmentController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div id="frmEditPunishment" method="post" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4" id="EditPunishmentCountry">
                  <strong>Ажиллагааны нэр: Өмнөд Судан</strong>
              </div>
              <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4" id="EditPunishmentEelj">
                  <strong>Ээлж: 6</strong>
              </div>
              <div class="clearfix"></div>

              <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4" id="EditPunishmentRD">
                  <strong>Регистрийн дугаар: ЖК89112712</strong>
              </div>
              <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4" id="EditPunishmentLastName">
                  <strong>Овог: йыбйыбйыбйыбйыбйыбйыбйыб</strong>
              </div>
              <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4" id="EditPunishmentFirstName">
                  <strong>Нэр: йыбйыбйыбйыбйыбйыбйыбйыб</strong>
              </div>
              <div class="clearfix"></div>
          </div>

          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-5">
              <label for="">Тайлбар: </label>
              <textarea id="editMemoPunishment" class="form-control" name="EditMemoPunishment"></textarea>
          </div>

          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-5">
              <label for="">Огноо: </label>
              {{-- <input type="date" id="editAwardsDate" class="form-control"/> --}}
              <div class="controls">
                <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" name="editPunishmentsDate" autocomplete="off" id="single_cal1" aria-describedby="inputSuccess2Status">
                  <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  <span id="inputSuccess2Status" class="sr-only">(success)</span>
                </div>
              </div>

          </div>
          <div class="clearfix"></div>
          <button type="button" class="btn btn-success" id="btnPostEditPunishment">Засах</button>
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
