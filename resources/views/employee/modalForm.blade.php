<div class="modal fade" id="emp_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <h3 class="m-t-none m-b text-navy"><strong>Employee Form</strong></h3>
                <legend></legend>
                <!-- Form -->
                <form id="emp_form">

                    <input type="hidden" name="id" id="id">

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_number">
                                <label for="number">Number *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="number" 
                                       placeholder="012-3456" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_eeNum">
                                <label for="eeNum">EE no. *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="eeNum" 
                                       placeholder="3-123456-34" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_mobileNo">
                                <label for="mobileNo">Mobile no. *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="mobileNo" 
                                       placeholder="0932123456" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="dateOfBirth">Age *</label> 
                                <input type="number"
                                       class="form-control readonly"
                                       name="age"
                                       disabled="" 
                                >
                            </div>
                        </div>
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3 b-r">
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

                        <div class="col-sm-12 col-md-12 col-lg-3">
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

                        <div class="col-sm-12 col-md-12 col-lg-3">
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

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_dateOfBirth">
                                <label for="dateOfBirth">Date Of Birth *</label> 
                                <input type="date"
                                       class="form-control"
                                       name="dateOfBirth" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_status">
                                <label for="status">Status *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="status" 
                                       placeholder="Status" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_position">
                                <label for="position">Position *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="position" 
                                       placeholder="Position" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3 b-r">
                            <div class="form-group" id="error_level">
                                <label for="level">Level *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="level" 
                                       placeholder="Level" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_hiredDate">
                                <label for="hiredDate">Date Hired *</label> 
                                <input type="date"
                                       class="form-control"
                                       name="hiredDate"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_basicSalary">
                                <label for="basicSalary">Basic Salary *</label> 
                                <input type="number" min="0" 
                                       class="form-control text-right"
                                       name="basicSalary"
                                       placeholder="0.00"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_allowance">
                                <label for="allowance">Allowance *</label> 
                                <input type="number" min="0" 
                                       class="form-control text-right"
                                       name="allowance" 
                                       placeholder="0.00" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3 b-r">
                            <div class="form-group" id="error_takeHome">
                                <label for="takeHome">Take Home *</label> 
                                <input type="number" min="0"  
                                       class="form-control text-right"
                                       name="takeHome" 
                                       placeholder="0.00" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_lengthOfService">
                                <label for="lengthOfService">Length Of Service *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="lengthOfService"
                                       disabled 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-2">
                            <div class="form-group" id="error_percent">
                                <label for="percent">% *</label> 
                                <input type="number" min="0" 
                                       class="form-control text-right"
                                       name="percent"
                                       placeholder="0.0"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-2">
                            <div class="form-group" id="error_bonus">
                                <label for="bonus">Bonus *</label> 
                                <input type="number" min="0" 
                                       class="form-control text-right"
                                       name="bonus" 
                                       placeholder="0.00" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_declare">
                                <label for="declare">Declare *</label> 
                                <input type="number" min="0"  
                                       class="form-control text-right"
                                       name="declare" 
                                       placeholder="0.00" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-2 b-r">
                            <div class="form-group" id="error_daysOfWork">
                                <label for="daysOfWork">Days Of Work *</label> 
                                <input type="number" min="0" 
                                       class="form-control text-right"
                                       name="daysOfWork" 
                                       placeholder="0.00" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_endDate">
                                <label for="endDate">Date End *</label> 
                                <input type="date"
                                       class="form-control"
                                       name="endDate"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_er">
                                <label for="er">ER *</label> 
                                <input type="number" min="0" 
                                       class="form-control text-right"
                                       name="er" 
                                       placeholder="0.00" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group" id="error_ee">
                                <label for="ee">EE *</label> 
                                <input type="number" min="0"  
                                       class="form-control text-right"
                                       name="ee" 
                                       placeholder="0.00" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3 b-r">
                            <div class="form-group" id="error_tc">
                                <label for="tc">TC *</label> 
                                <input type="number" min="0" 
                                       class="form-control text-right"
                                       name="tc" 
                                       placeholder="0.00" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3 b-r">
                            <div class="form-group i-checks">
                                <label for="isActive"> 
                                  <input type="checkbox"
                                         name="isActive"
                                         checked="true" 
                                  >
                                  Is Active ?
                                </label>
                            </div>
                        </div>

                    </div><!-- /.row -->
                </form>
                <!-- End Form -->

                <!-- Footer -->
                <legend></legend>
                <div style="margin-bottom: 30px;">
                    <button type="button" 
                            id="empSave" 
                            onClick="empSave()" 
                            class="btn btn-flat btn-primary btn-sm pull-right m-t-n-xs"> 
                      Save
                    </button>

                    <span class="pull-right m-t-n-xs">&nbsp;</span>

                    <button type="button" 
                            class="btn btn-white btn-sm pull-right m-t-n-xs" 
                            data-dismiss="modal">
                      Close
                    </button>
                </div>
                <!-- End Footer -->
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog modal-lg -->
</div>
<!-- /.modal fade -->
