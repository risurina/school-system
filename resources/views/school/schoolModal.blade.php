<div class="modal inmodal" id="school_modal">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="ibox-title">
                <h5>School Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="form-horizontal" id="school_form">
                
                    <div class="form-group" id="error_code">
                        <label for="code" class="col-sm-3 control-label" for="code">
                          <i>School Code <span>*</span></i>
                        </label>

                        <div class="col-sm-9">
                            <input type="text" name="code" class="form-control col-md-7 col-xs-12" placeholder="School Code">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--/.form-group-->
                    <div class="form-group" id="error_name">
                        <label for="name" class="col-sm-3 control-label">
                          <i>School Name <span>*</span></i>
                        </label>

                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control col-md-7 col-xs-12" placeholder="School Name">
                            <span class="help-block has-error"></span>
                        </div>
                    </div>
                    <!--/.form-group-->

                    <div class="form-group" id="error_address">
                        <label for="address" class="col-sm-3 control-label">
                          <i>Address <span>*</span></i>
                        </label>

                        <div class="col-sm-9">
                            <input type="text" name="address" class="form-control col-md-7 col-xs-12" placeholder="Address">
                            <span class="help-block has-error"></span>
                        </div>
                    </div>
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
                        id="schoolSave" 
                        onClick="schoolSave('')" 
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
