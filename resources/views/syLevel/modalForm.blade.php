<div class="modal inmodal in" id="sylvl_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>Level Form</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <!-- form start -->
                <form class="form-horizontal" id="sylvl_form">
                    <input type="hidden" name="school_year" value="{{ $sy->year }}">
                    <div class="row">
                        <div class="col-xs-12 col-lg-12">
                            <div class="form-group" id="error_level_id">
                                <label for="level_id" class="col-sm-4 control-label">
                                  <i>Level <span>*</span></i>
                                </label>

                                <div class="col-sm-8" >
                                    <select class="form-control" name="level_id">
                                        @foreach( $levels as $level )
                                        <option value="{{ $level->id }}">
                                            {{ $level->level }}
                                        </option>
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
                        id="sylvlSave" 
                        onClick="sylvlCreate()"
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
