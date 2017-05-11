<div class="modal inmodal in" id="fee_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>School Fee Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="form-horizontal" id="fee_form" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-lg-12 hidden" id="feeID"></div>

                    <div class="col-xs-12 col-lg-12">
                        <div class="form-group" id="error_code">
                            <label for="code" class="col-sm-5 control-label">
                              <i>Code <span>*</span></i>
                            </label>

                            <div class="col-sm-7">
                                <input type="text" name="code"
                                        class="form-control" 
                                        placeholder="Fee Code">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-lg-12">
                        <div class="form-group" id="error_fee">
                            <label for="level" class="col-sm-5 control-label">
                              <i>Fee <span>*</span></i>
                            </label>

                            <div class="col-sm-7">
                                <input type="text" name="fee"
                                        class="form-control col-md-7 col-xs-12" 
                                        placeholder="Fee">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-lg-12">
                        <div class="form-group" id="error_amount">
                            <label for="amount" class="col-sm-5 control-label">
                              <i>Amount <span>*</span></i>
                            </label>

                            <div class="col-sm-7">
                                <input type="number" name="amount"
                                        class="form-control col-md-7 col-xs-12 text-right">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-lg-12">
                        <div class="form-group" id="error_isDefault">
                            <label for="isDefault" class="col-sm-5 control-label">
                              <i>Is Default <span>*</span></i>
                            </label>

                            <div class="col-sm-7">
                                <select class="form-control" name="isDefault">
                                    <option value="0">NO</option>
                                    <option value="1">YES</option>
                                </select>
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
                        id="feeSave" 
                        onClick="feeCreate()"
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
