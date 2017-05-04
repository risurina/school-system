<div class="modal inmodal in" id="progress_modal">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>Registration Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <div class="row">
                  <div class=" form-group col-lg-6">
                    <label class="m-t-none m-b">
                      Name : 
                      <span class="text-navy" id="fullName">{{ $student->fullName }}</span>
                    </label>
                  </div>

                  <div class=" form-group col-lg-2">
                    <label class="m-t-none m-b">
                      Gender : 
                      <span class="text-navy" id="sex">{{ $student->sex }}</span>
                    </label>
                  </div>

                  <div class=" form-group col-lg-4">
                    <label class="m-t-none m-b">
                      Age : 
                      <span class="text-navy" id="currentAge">
                        {{ $student->currentAge }}
                      </span>
                    </label>
                  </div>
                </div>
                <!-- /.row -->

                <!-- form start -->
                <form id="progress_form" action="#" class="wizard-big">
                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                    <div class="hr-line-dashed" style="margin-top: -15px;margin-bottom: 10px;"></div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group" id="error_enrolledDate">
                                <label for="enrolledDate">Date Enrolled *</label> 
                                <input type="date"
                                       class="form-control"
                                       name="enrolledDate"
                                       value="{{ date('Y-m-d') }}" 
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group" id="error_isCash">
                                <label for="isCash">Payment Option *</label>
                                <select class="form-control" name="isCash">
                                  <option value="1">CASH</option>
                                  <option value="0">INSTALLMENT</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed" style="margin-top: -0px;margin-bottom: 10px;"></div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="error_address">
                                <label for="address">Address *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="address"
                                       value="Bagong Silang, Cal. City"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group" id="error_mobileNo">
                                <label for="mobileNo">Mobile No. *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="mobileNo"
                                       placeholder="0932-123-4567"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group" id="error_landlineNo">
                                <label for="landlineNo">Landline No. *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="landlineNo"
                                       placeholder="(02) 123-4567"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed" style="margin-top: -0px;margin-bottom: 10px;"></div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group" id="error_guardianName">
                                <label for="guardianName">Parent/Guardian Name *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="guardianName"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group" id="error_guardianRelationship">
                                <label for="guardianRelationship">
                                    Relationship w/ the Pupil *
                                </label> 
                                <input type="text"
                                       class="form-control"
                                       name="guardianRelationship"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="error_healthProblem">
                                <label for="healthProblem">State any pupil health problem. *</label> 
                                <input type="text"
                                       class="form-control"
                                       name="healthProblem"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed" style="margin-top: -0px;margin-bottom: 10px;"></div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="error_school_year">
                                <label for="school_year">School Year *</label> 
                                <select class="form-control" name="school_year">
                                  @foreach($school_years as $sy)
                                    <option value="{{ $sy->id }}">
                                      {{ $sy->year }}
                                    </option>
                                  @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="error_level">
                                <label for="level">Level *</label>
                                <select class="form-control" name="level">
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="error_section">
                                <label for="section">Section *</label> 
                                <select class="form-control"
                                       name="section" 
                                       readonly 
                                >
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </form>
                <!-- End Test form -->
            </div>
            <!-- /.ibox-content -->
            <div class="ibox-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-white btn-sm " data-dismiss="modal">
                  Close
                </button>

                <button type="button" 
                        id="progressSave"
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


