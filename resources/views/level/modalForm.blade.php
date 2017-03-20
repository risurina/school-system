<div class="modal inmodal in" id="lvl_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>School Year Level Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="form-horizontal" id="lvl_form" method="POST">
                <input type="hidden" name="id">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <div class="form-group" id="error_year">
                            <label for="year" class="col-sm-5 control-label">
                              <i>SY <span>*</span></i>
                            </label>

                            <div class="col-sm-7">
                                <select  name="year" class="form-control col-md-7 col-xs-12">
                                    @foreach($yearList as $year)
                                    <option value="{{ $year->year }}">
                                        {{ $year->year }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->

                    <div class="col-xs-12 col-lg-12">
                        <div class="form-group" id="error_name">
                            <label for="name" class="col-sm-5 control-label">
                              <i>Level <span>*</span></i>
                            </label>

                            <div class="col-sm-7">
                                <input type="text" name="name" 
                                        class="form-control col-md-7 col-xs-12" 
                                        placeholder="Level">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row" id="sectionAppend">
                    
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
                        id="lvlSave" 
                        onClick="lvlUpdate()" 
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
