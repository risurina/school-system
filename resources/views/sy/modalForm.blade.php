<div class="modal inmodal in" id="sy_modal">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>School Year <span id="year"></span> </h5>
                <span class="label label-info pull-right" id="code"></span>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="" id="sy_form">
                    <input type="hidden" name="id">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group" id="error_start">
                                <label for="start" class="control-label">
                                  <i>Start <span>*</span></i>
                                </label>
                                <input type="date" name="start" 
                                        class="form-control" 
                                        value="">
                                <span class="help-block has-error"></span>
                            </div>
                            <!--/.form-group-->
                        </div><!-- /.col -->

                        <div class="col-lg-6">
                            <div class="form-group" id="error_end">
                                <label for="end" class="control-label">
                                  <i>End <span>*</span></i>
                                </label>
                                <input type="date" name="end" 
                                        class="form-control" 
                                        value="{{ (date('Y')+1) . date('-04-d') }}">
                                <span class="help-block has-error"></span>
                            </div>
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group" id="error_firstGrading">
                                <label for="firstGrading" class="control-label">
                                  <i>1st Grading <span>*</span></i>
                                </label>
                                <input type="date" name="firstGrading" 
                                        class="form-control" 
                                        value="{{ date('Y-06-d') }}">
                                <span class="help-block has-error"></span>
                            </div>
                            <!--/.form-group-->
                        </div><!-- /.col -->

                        <div class="col-lg-6">
                            <div class="form-group" id="error_secondGrading">
                                <label for="secondGrading" class="control-label">
                                  <i>2nd Grading<span>*</span></i>
                                </label>
                                <input type="date" name="secondGrading" 
                                        class="form-control" 
                                        value="{{ (date('Y')+1) . date('-04-d') }}">
                                <span class="help-block has-error"></span>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-lg-6">
                            <div class="form-group" id="error_thirdGrading">
                                <label for="thirdGrading" class="control-label">
                                  <i>3rd Grading <span>*</span></i>
                                </label>
                                <input type="date" name="thirdGrading" 
                                        class="form-control" 
                                        value="{{ date('Y-06-d') }}">
                                <span class="help-block has-error"></span>
                            </div>
                            <!--/.form-group-->
                        </div><!-- /.col -->

                        <div class="col-lg-6">
                            <div class="form-group" id="error_fourthGrading">
                                <label for="fourthGrading" class="control-label">
                                  <i>4th Grading <span>*</span></i>
                                </label>
                                <input type="date" name="fourthGrading" 
                                        class="form-control" 
                                        value="{{ (date('Y')+1) . date('-04-d') }}">
                                <span class="help-block has-error"></span>
                            </div>
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group" id="error_monthlyExam">
                                <label for="monthlyExam" class="control-label">
                                  <i>Monthly Exam<span>*</span></i>
                                </label>
                                <input type="number" name="monthlyExam" 
                                        class="form-control" 
                                        value="1">
                                <span class="help-block has-error"></span>
                            </div>
                            <!--/.form-group-->
                        </div><!-- /.col -->

                        <div class="col-lg-6">
                            <div class="form-group" id="error_monthlyDue">
                                <label for="monthlyDue" class="control-label">
                                  <i>Monthly Due <span>*</span></i>
                                </label>
                                <input type="number" name="monthlyDue" 
                                        class="form-control" 
                                        value="5">
                                <span class="help-block has-error"></span>
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
