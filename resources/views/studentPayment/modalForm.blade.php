<div class="modal inmodal in" id="studentPayment_modal">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>Payment Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="" id="studentPayment_form">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group" id="error_invNo">
                                <label for="invNo" class="control-label">
                                  <i>Receipt No. <span>*</span></i>
                                </label>
                                <input class="form-control text-right" 
                                        type="text" 
                                        name="invNo"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="feeGroup1">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group" id="error_fee">
                                <label for="fee" class="control-label">
                                  <i>Fee <span>*</span></i>
                                </label>

                                <input type="hidden" name="student_fee_id">
                                <select class="form-control" name="fee">
                                    @foreach( $currentFee as $fee )
                                        @if($fee->balance > 0)
                                        <option value="{{ $fee }}">
                                            {{ $fee->fee->fee }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group" id="error_balance">
                                <label for="balance" class="control-label">
                                  <i>Balance <span>*</span></i>
                                </label>
                                <input class="form-control text-right" 
                                        type="number" 
                                        name="balance"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="feeGroup2">
                        <div class="col-xs-12 col-lg-6">
                            <div class="form-group" id="error_fee">
                                <label for="fee" class="control-label">
                                <i>Fee <span>*</span></i>
                                </label>
                                <input type="hidden" name="id">
                                <input class="form-control" name="feeName" disabled>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <div class="form-group" id="error_payment_by">
                                <label for="payment_by" class="control-label">
                                  <i>Payment By <span>*</span></i>
                                </label>
                                <input class="form-control" 
                                        type="text" 
                                        name="payment_by"
                                        value="" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-lg-6">
                            <div class="form-group" id="error_payment_date">
                                <label for="payment_date" class="control-label">
                                  <i>Payment Date <span>*</span></i>
                                </label>
                                <input class="form-control text-right" 
                                        type="date" 
                                        name="payment_date"
                                        value="{{ date('Y-m-d') }}"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-lg-6">
                            <div class="form-group" id="error_amount">
                                <label for="amount" class="control-label">
                                  <i>Amount <span>*</span></i>
                                </label>
                                <div class="">
                                    <input class="form-control text-right" 
                                            type="number" 
                                            name="amount"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-12 col-lg-6"></div>
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
                        id="studentPaymentSave" 
                        onClick="studentPaymentCreate()"
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
