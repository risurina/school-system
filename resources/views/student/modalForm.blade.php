<div class="modal inmodal in" id="student_modal">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>Student Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form id="student_form">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="error_lrnNo">
                                <label for="lrnNo">LRN No. *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="lrnNo" 
                                       placeholder="lrn-01-1234" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="error_lastName">
                                <label for="lastName">Last Name *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="lastName" 
                                       placeholder="Last Name" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="error_firstName">
                                <label for="firstName">First Name *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="firstName" 
                                       placeholder="First Name" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="error_middleName">
                                <label for="middleName">Middle Name *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="middleName" 
                                       placeholder="Middle Name" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="error_dateOfBirth">
                                <label for="dateOfBirth">Date Of Birth *</label> 
                                <input type="date"
                                       class="form-control"
                                       name="dateOfBirth" 
                                       placeholder="lrn-01-1234" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="error_sex">
                                <label for="sex">Gender *</label>
                                <select name="sex" class="form-control">
                                  <option value="M">MALE</option>
                                  <option value="F">FEMALE</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
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
                        id="studentSave" 
                        onClick="studentCreate()" 
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
