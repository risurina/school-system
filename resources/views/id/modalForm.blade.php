<div class="modal inmodal in" id="id_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>ID Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form id="id_form">
                    <input type="hidden" name="id">
                    <div class="row">
                    <div class="col-lg-8  b-r">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>Personel Type *</label>
                                    <select class="form-control"
                                        name="type"
                                    >
                                        <option value="STUDENT">STUDENT</option>
                                        <option value="STAFF">STAFF</option>
                                        <option value="ADMIN">ADMIN</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group" id="error_student_id_no">
                                    <label for="lrnNo">Student ID. *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="student_id_no"
                                        placeholder="Student ID"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group" id="error_lrn">
                                    <label for="lrnNo">LRN No. *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="lrn"
                                        placeholder="lrn-01-1234"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group" id="error_card_id_no">
                                    <label>RFID Card # *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="card_id_no"
                                        placeholder="RFID Card #"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group" id="error_last_name">
                                    <label>Last Name *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="last_name"
                                        placeholder="Last Name"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group" id="error_first_name">
                                    <label>First Name *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="first_name"
                                        placeholder="First Name"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group" id="error_middle_name">
                                    <label>Middle Name *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="middle_name"
                                        placeholder="Middle Name"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div><!-- /.row -->

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group" id="error_year_level">
                                    <label>Level or Position*</label>
                                    <input type="text"
                                        class="form-control"
                                        name="year_level"
                                        placeholder="Level or Position"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group" id="error_section">
                                    <label>Section *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="section"
                                        placeholder="Section"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group" id="error_phone_number">
                                    <label for="phone_number">Phone Number *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="phone_number"
                                        placeholder="0932123456"
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div><!-- /.row -->
                        <hr>

                        <!-- Address -->
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group" id="error_address">
                                    <label for="address">Address *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="address"
                                        placeholder=""
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group" id="error_address_two">
                                    <label for="address_two">City *</label>
                                    <input type="text"
                                        class="form-control"
                                        name="address_two"
                                        placeholder=""
                                    >
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row col-lg-4">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="error_adviser">
                                <label for="adviser">Adviser *</label>
                                <input type="text"
                                    class="form-control"
                                    name="adviser"
                                    placeholder="Adviser"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="error_dateOfBirth">
                                <label for="dateOfBirth">Date Of Birth *</label>
                                <input type="date"
                                    class="form-control"
                                    name="dateOfBirth"
                                    value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="error_sex">
                                <label for="sex">Gender *</label>
                                <select name="sex" class="form-control">
                                <option value="M">MALE</option>
                                <option value="F">FEMALE</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="error_father_name">
                                <label>Father Name *</label>
                                <input type="text"
                                    class="form-control"
                                    name="father_name"
                                    placeholder="Father Name"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="error_mother_name">
                                <label>Mother Name *</label>
                                <input type="text"
                                    class="form-control"
                                    name="mother_name"
                                    placeholder="Mother Name"
                                >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="error_guardian">
                                <label>Guardian *</label>
                                <input type="text"
                                    class="form-control"
                                    name="guardian"
                                    placeholder="Guardian"
                                >
                                <span class="help-block"></span>
                            </div>
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
                        id="idSave"
                        onClick="idCreate()"
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
