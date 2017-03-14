<div class="modal inmodal in" id="sy_modal">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>School Year Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="form-horizontal" id="sy_form">
                <input type="hidden" name="id">
                <div class="row">
                    <div class="col-xs-12 col-lg-6">
                        <div class="form-group" id="error_year">
                            <label for="year" class="col-sm-4 control-label">
                              <i>Year <span>*</span></i>
                            </label>

                            <div class="col-sm-8">
                                <input type="number" name="year" 
                                        class="form-control col-md-7 col-xs-12" 
                                        value="{{ date('Y') }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-lg-6">
                        <div class="form-group" id="error_year">
                            <label for="year" class="col-sm-4 control-label">
                              <i>Code <span>*</span></i>
                            </label>

                            <div class="col-sm-8">
                                <input type="text" name="code" 
                                        class="form-control col-md-7 col-xs-12" 
                                        value="{{ date('Y') }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group" id="error_start">
                            <label for="start" class="col-sm-4 control-label">
                              <i>Start <span>*</span></i>
                            </label>

                            <div class="col-sm-8">
                                <input type="date" name="start" 
                                        class="form-control col-md-7 col-xs-12" 
                                        value="{{ date('Y-06-d') }}">
                                <span class="help-block has-error"></span>
                            </div>
                        </div>
                        <!--/.form-group-->
                    </div><!-- /.col -->

                    <div class="col-lg-6">
                        <div class="form-group" id="error_end">
                            <label for="end" class="col-sm-4 control-label">
                              <i>End <span>*</span></i>
                            </label>

                            <div class="col-sm-8">
                                <input type="date" name="end" 
                                        class="form-control col-md-7 col-xs-12" 
                                        value="{{ (date('Y')+1) . date('-04-d') }}">
                                <span class="help-block has-error"></span>
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
                        id="sySave" 
                        onClick="syUpdate()" 
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
