@extends('layouts.master')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight" 
     style="margin-top: -30px; margin-bottom: -90px;"
>

	<div class="row m-b-lg m-t-lg">
    	<div class="col-md-6">
            <div class="profile-image">
                <img src="{{ asset('storage/school/logo.png') }}" 
                    class="img-circle circle-border m-b-md" alt="profile">
            </div>
            <div class="profile-info">
                <div class="">
                    <div>
                        <h2 class="no-margins">
                        	{{ $school->name }}
                        </h2>
                        <h4>Add. : <span> {{ $school->address }} </span></h4>
                        <h4>Code : <span> {{ $school->code }} </span></h4>
                        <a onClick='schoolUpdate({{ $school }})'>Edit </a>
                    </div>
                </div>
            </div><!-- /.profile-info -->
        </div>
        <!-- /.col-md-6-->
	</div>
	<!-- /.row m-b-lg m-t-lg -->
	
</div>
<!-- /.wrapper wrapper-content animated fadeInRight -->

<div class="wrapper wrapper-content">
    <div class="row">
        <!-- Level Table -->
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Levels</h5>
                    <div class="ibox-tools pull-right">
                        <a class="btn btn-primary btn-xs" 
                           onclick="lvlCreateModal()">
                           <i class="fa fa-plus"></i>
                        </a>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                    <input type="text" 
                        class="form-control input-sm pull-right" 
                        name="lvlSearch_key" 
                        placeholder="Search here!" 
                        style="margin-top:-5px; width: 50%">

                </div>
                <div class="ibox-content">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 1%" class="text-center">#</th>
                                    <th>Code</th>
                                    <th>Level</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="lvlTable_body">
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-lg-12" id="lvlTable_pagination">
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <!-- End Level Table -->

        <!-- Fee's Table -->
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>School Fees</h5>
                    <div class="ibox-tools pull-right">                                
                        <a class="btn btn-primary btn-xs" 
                           onclick="feeCreateModal()">
                           <i class="fa fa-plus"></i>
                        </a>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                    
                    <input type="text" 
                        class="form-control input-sm pull-right" 
                        name="feeSearch_key" 
                        placeholder="Search here!" 
                        style="margin-top:-5px; width: 30%">

                </div>
                <div class="ibox-content">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 1%" class="text-center">#</th>
                                    <th>Code</th>
                                    <th>Fee</th>
                                    <th>Default</th>
                                    <th>Amount</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="testSample">
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-lg-12" id="feeTable_pagination">
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <!-- End Fee's Table -->
    </div>

    <div class="row">
        <!-- Schedule Table -->
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Schedules</h5>
                    <div class="ibox-tools pull-right">
                        <a class="btn btn-primary btn-xs" 
                           onclick="scheduleCreateModal()">
                           <i class="fa fa-plus"></i>
                        </a>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                    <input type="text" 
                        class="form-control input-sm pull-right" 
                        name="scheduleSearch_key" 
                        placeholder="Search here!" 
                        style="margin-top:-5px; width: 50%">

                </div>
                <div class="ibox-content">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 1%" class="text-center">#</th>
                                    <th>Schedule</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="scheduleTable_body">
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-lg-12" id="scheduleTable_pagination">
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <!-- End Level Table -->
    </div>
</div>

@include('school.schoolModal')
@include('level.modalForm')
@include('fee.modalForm')
@include('schedule.modalForm')
@endsection

@section('js_script')

<script type="text/javascript"> 
/** Highlight Sidebard **/
$('#sidemenu_settings').addClass('active');
</script>

@include('school.schoolScript')

@include('fee.script')
@include('level.script')
@include('schedule.script')
@endsection
