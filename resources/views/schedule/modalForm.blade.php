<div class="modal inmodal in" id="schedule_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>Schedule Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="form-horizontal" id="schedule_form" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-lg-12 hidden" id="scheduleID"></div>

                    <div class="col-xs-12 col-lg-12">
                        <div class="form-group" id="error_schedule">
                            <label for="schedule" class="col-sm-5 control-label">
                              <i>Schedule <span>*</span></i>
                            </label>

                            <div class="col-sm-7  col-md-7 col-xs-12">
                                <input type="text" name="schedule"
                                        class="form-control" 
                                        placeholder="Schedule name">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-lg-12">
                        <div class="form-group" id="error_startTime">
                            <label for="startTime" class="col-sm-5 control-label">
                              <i>Start Time <span>*</span></i>
                            </label>

                            <div class="col-sm-7  col-md-7 col-xs-12">
                                <input type="time" name="startTime"
                                        class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-lg-12">
                        <div class="form-group" id="error_endTime">
                            <label for="endTime" class="col-sm-5 control-label">
                              <i>End Time <span>*</span></i>
                            </label>

                            <div class="col-sm-7  col-md-7 col-xs-12">
                                <input type="time" name="endTime"
                                        class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div>
                <!-- /.row -->
                </form>
                <!--/.form -->
            </div>
            <!-- /.ibox-content -->
            <div class="ibox-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-white btn-sm " data-dismiss="modal">
                  Close
                </button>

                <button type="button" 
                        id="scheduleSave" 
                        onClick="scheduleCreate()"
                        class="btn btn-flat btn-primary btn-sm"> 
                    Save
                </button>
              </div>
              <div>&nbsp;<br>&nbsp;</div>
            </div>
            <!-- /.ibox-footer -->
        </div>
        <!-- /.modal-content animated flipInY -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal inmodal -->
