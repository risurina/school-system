@extends('layouts.master')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>School Table</h5>
            <div class="ibox-tools">
                <a href="#add-school" class="btn btn-primary btn-xs" onclick="studentCreateModal()">
                    New Student
                </a>
                <a href="#refresh-table" onclick="studentTable()">
                    <i class="fa fa-refresh"></i>
                </a>
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <!-- /.ibox-titel -->

        <div class="ibox-content">
            <!-- Search and filter form -->
            <div class="row">
                <div class="col-lg-12">
                <form id="search_form" method="post" accept-charset="utf-8">
                    <div class="pull-left form-inline">
                        <label>Show 
                            <input type="number" name="show_row" 
                                    value="8" class="form-control input-sm" 
                                    style="width:60px;" min="1" max="1000">
                        </label>


                        <label>&nbsp;&nbsp;Limit
                            <input type="number" name="limit" 
                                    value="250" class="form-control input-sm" 
                                    style="width:70px;" min="1" max="1000">
                        </label>
                    </div>

                    <div class="pull-right form-inline">
                        <label>Search:
                            <input type="text" class="form-control input-sm" name="search_key">
                        </label>&nbsp;
                    </div>
                </form>
                </div>

                <div class="col-lg-12" id="table_pagination">
                </div>
            </div>
            <!-- /.row -->

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>LRN #</th>
                        <th>Last</th>
                        <th>First</th>
                        <th>Middle</th>
                        <th class="text-center">Gender</th>
                        <th>Date of Birth</th>
                        <th>Current Age/s</th>
                        <th>Date Added</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead> 
                    <tbody id="table_body">
                        <!-- table row go here -->
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.ibox-content -->
    </div>
    <!-- /.ibox float-e-margins -->
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.wrapper wrapper-content animated fadeInRight -->

@include('student.modalForm')
@endsection

@section('js_script')

<script type="text/javascript"> 

/** Highlight Sidebard **/
$('#sidemenu_student').addClass('active');
</script>

@include('student.script')
@endsection