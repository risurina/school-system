<div class="modal inmodal in" id="uploadImage_modal">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>Upload Profile</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
              <form id="uploadImage_form"
                    method="post"
                    enctype="multipart/form-data"
              >
                {{ csrf_field() }}
                <input type="hidden" name="id" value="">

                <div id="error_image">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput" >
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="image" id="image" />
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                    <span class="help-block"></span>
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
                        onClick="uploadImage()"
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
