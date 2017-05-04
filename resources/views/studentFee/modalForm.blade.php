<div class="modal inmodal in" id="studentFee_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>Fee Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="form-horizontal" id="studentFee_form">
                    <div class="row">
                        <div class="col-xs-12 col-lg-12">
                            <div class="form-group" id="error_fee">
                                <label for="fee" class="col-sm-4 control-label">
                                  <i>Fee <span>*</span></i>
                                </label>

                                <div class="col-sm-8" id="feeGroup">
                                    <input type="hidden" name="fee_id">
                                    <select class="form-control" name="fee">
                                        @foreach( $fees as $fee )
                                        <option value="{{ $fee }}">
                                            {{ $fee->fee }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-lg-12">
                            <div class="form-group" id="error_feeAmount">
                                <label for="feeAmount" class="col-sm-4 control-label">
                                  <i>Amount <span>*</span></i>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control text-right" 
                                            type="number" 
                                            name="feeAmount"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-lg-12">
                            <div class="form-group" id="error_discount">
                                <label for="discount" class="col-sm-4 control-label">
                                  <i>Discount <span>*</span></i>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control text-right" 
                                            type="number" 
                                            name="discount"
                                    >
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
                        id="studentFeeSave" 
                        onClick="studentFeeCreate()"
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
