<div class="modal inmodal in" id="section_modal">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>Section Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="form-horizontal" id="section_form">
                    <div class="row">
                        <div class="col-xs-12 col-lg-12">
                            <div class="form-group" id="error_level">
                                <label for="level" class="col-sm-4 control-label">
                                  <i>Level <span>*</span></i>
                                </label>

                                <div class="col-sm-8">
                                    <input type="text" name="level"
                                            class="form-control col-md-7 col-xs-12">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-lg-12">
                            <div class="form-group" id="error_section">
                                <label for="section" class="col-sm-4 control-label">
                                  <i>Section <span>*</span></i>
                                </label>

                                <div class="col-sm-8">
                                    <input type="text" name="section"
                                            class="form-control col-md-7 col-xs-12" 
                                            placeholder="Section">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-lg-12">
                            <div class="form-group" id="error_level">
                                <label for="level" class="col-sm-4 control-label">
                                  <i>Schedule <span>*</span></i>
                                </label>

                                <div class="col-sm-8">
                                    <select class="form-control" name="schedule_id">
                                        @foreach( $schedules as $sched )
                                        <option value="{{ $sched->id }}">
                                            {{ $sched->schedule }} | 
                                            {{ date('h:i A',strtotime($sched->startTime)) }} - 
                                            {{ date('h:i A',strtotime($sched->endTime)) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-lg-12">
                            <div class="form-group" id="error_level">
                                <label for="level" class="col-sm-4 control-label">
                                  <i>Adviser <span>*</span></i>
                                </label>

                                <div class="col-sm-8">
                                    <select class="form-control" name="employee_id">
                                        @foreach( $employees as $emp )
                                        <option value="{{ $emp->id }}">{{ $emp->fullName }}</option>
                                        @endforeach
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
                        id="sectionSave" 
                        onClick="sectionCreate()"
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
